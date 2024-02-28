<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AreaInterestResource\Pages;
use App\Filament\Resources\AreaInterestResource\RelationManagers;
use App\Models\AreaInterest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AreaInterestResource extends Resource
{
    protected static ?string $model = AreaInterest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Extra Details';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListAreaInterests::route('/'),
            'create' => Pages\CreateAreaInterest::route('/create'),
            'view' => Pages\ViewAreaInterest::route('/{record}'),
            'edit' => Pages\EditAreaInterest::route('/{record}/edit'),
        ];
    }
}
