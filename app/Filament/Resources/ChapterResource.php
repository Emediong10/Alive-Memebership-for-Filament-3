<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Chapter;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ChapterResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ChapterResource\RelationManagers;

class ChapterResource extends Resource
{
    protected static ?string $model = Chapter::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Chapters';

     public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('New Chapter')->schema([
                    TextInput::make('name')->required()->unique(),
                    Toggle::make('active')->required()
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                IconColumn::make('active')->options([
                    'heroicon-o-x-circle' => fn($state, $record): bool => $record->active ==false,
                    'heroicon-o-check-circle' => fn($state, $record): bool => $record->active ==true,
                    ])
                    ->colors([
                        'danger'=> fn($state, $record): bool => $record->active ==false,
                        'success' => fn($state, $record): bool => $record->active ==true
                    ]),
                TextColumn::make('applications_count')->counts('applications')
                ->getStateUsing(function($record){
                    $count = User::where('chapter_id',$record->id)->count();
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChapters::route('/'),
            'create' => Pages\CreateChapter::route('/create'),
            'view' => Pages\ViewChapter::route('/{record}'),
            'edit' => Pages\EditChapter::route('/{record}/edit'),
        ];
    }
}
