<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AreaInterest;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AreaInterestResource\Pages;
use App\Filament\Resources\AreaInterestResource\RelationManagers;

class AreaInterestResource extends Resource
{
    protected static ?string $model = AreaInterest::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $navigationGroup = 'Extra Details';

    public static function form(Form $form): Form
    {
        return $form->schema([
        Section::make('New Area Of Interest')
        // ->description('AREA of INTEREST In MINISTRY (You can choose more than 1 option)')
        ->schema([
                TextInput::make('name'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Areas of Interest'),
                TextColumn::make('user.firstname')->label('Firstname')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
               // Tables\Actions\ViewAction::make(),
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
