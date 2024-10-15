<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\MemberType;
use Filament\Tables\Table;
use App\Models\NewsRecipient;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NewsRecipientResource\Pages;
use App\Filament\Resources\NewsRecipientResource\RelationManagers;
use Parallax\FilamentComments\Tables\Actions\CommentsAction;

use Filament\Forms\Components\Section;

class NewsRecipientResource extends Resource
{
    protected static ?string $model = NewsRecipient::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'News Navigation';

    protected static ?string $navigationLabel = 'Inbox';

    protected static ?string $slug = 'inbox';

    protected static ?string $breadcrumb = 'Inbox';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('NewsRecipient')->schema([
                    Select::make('news_id')->relationship('news','title')->searchable()->preload(),
                    Select::make('recipient_type')->options([
                        '1'=>'Individual',
                        '2'=>'Group'
                    ])->reactive(),
                    Select::make('recipients')->options(function(callable $get){
                          $type=$get('recipient_type');
                          if($type==1)
                          {
                            return User::all()->pluck('name','id');
                          }
                          elseif($type==2)
                          {
                            return MemberType::all()->pluck('type','id');
                          }
                    })->multiple(),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('news.title'),
                TextColumn::make('created_at')->label('Time Sent')->since()->sortable(),

            ])
            ->recordClasses(function(NewsRecipient $record){
                if($record->read)
                {
                    return "font-light";
                }
                else
                {
                    return "font-bold";
                }
            }) ->actions([
             CommentsAction::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsRecipients::route('/'),
            'create' => Pages\CreateNewsRecipient::route('/create'),
            'view' => Pages\ViewNewsRecipient::route('/{record}'),
            'edit' => Pages\EditNewsRecipient::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return NewsRecipient::where(['read'=>0])->where(function($query){
            $query->where('user_id',auth()->user()->id)
            ->orWhere('member_types_id',auth()->user()->member_type)->whereNotNull('member_types_id')
            ->orWhere('member_types_id',10);
        })->whereHas('news',function($query){
            $query->where('active',1);
        })->count();
    }
}
