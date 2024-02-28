<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpiritualGiftResource\Pages;
use App\Filament\Resources\SpiritualGiftResource\RelationManagers;
use App\Models\SpiritualGift;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpiritualGiftResource extends Resource
{
    protected static ?string $model = SpiritualGift::class;

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
            'index' => Pages\ListSpiritualGifts::route('/'),
            'create' => Pages\CreateSpiritualGift::route('/create'),
            'view' => Pages\ViewSpiritualGift::route('/{record}'),
            'edit' => Pages\EditSpiritualGift::route('/{record}/edit'),
        ];
    }
}
