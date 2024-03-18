<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\MemberType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
// use RelationManagers\UsersRelationManager;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MemberTypeResource\Pages;
use App\Filament\Resources\MemberTypeResource\RelationManagers;
use App\Filament\Resources\MemberTypeResource\RelationManagers\UserRelationManager;

class MemberTypeResource extends Resource
{
    protected static ?string $model = MemberType::class;

    protected static ?string $navigationIcon = 'heroicon-o-sun';

    protected static ?string $navigationGroup = 'Membertype Navigation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('New Member Type')->schema([
                    TextInput::make('type')->required()
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type'),
                TextColumn::make('applications_count')
                ->counts('applications')
                ->getStateUsing(function($record){
                    $count = User::where('member_type_id',$record->id)->count();
                    return $count;
                })
                ->label('Number of Applications')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            RelationManagers\UsersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMemberTypes::route('/'),
            'create' => Pages\CreateMemberType::route('/create'),
            'view' => Pages\ViewMemberType::route('/{record}'),
            'edit' => Pages\EditMemberType::route('/{record}/edit'),
        ];
    }
}
