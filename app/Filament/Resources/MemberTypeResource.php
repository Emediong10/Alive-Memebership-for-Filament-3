<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberTypeResource\Pages;
use App\Filament\Resources\MemberTypeResource\RelationManagers;
use App\Models\MemberType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberTypeResource extends Resource
{
    protected static ?string $model = MemberType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Membertype Navigation';

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
            'index' => Pages\ListMemberTypes::route('/'),
            'create' => Pages\CreateMemberType::route('/create'),
            'view' => Pages\ViewMemberType::route('/{record}'),
            'edit' => Pages\EditMemberType::route('/{record}/edit'),
        ];
    }
}
