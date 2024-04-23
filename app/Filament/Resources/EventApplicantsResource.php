<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventApplicantsResource\Pages;
use App\Filament\Resources\EventApplicantsResource\RelationManagers;
use App\Models\EventApplicants;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventApplicantsResource extends Resource
{
    protected static ?string $model = EventApplicants::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                TextColumn::make('event.name')->searchable()->sortable(),
                TextColumn::make('user.name')->searchable(),
                TextColumn::make('user.chapter.name')->searchable()->label('Chapter'),
                TextColumn::make('amount_paid')->searchable()->label('Total Payment Made')->getStateUsing(function($record){
                    $supplementary_payments= gettype($record->supplementary_payments)=="array"?array_sum(array_column($record->supplementary_payments,'amount_paid')):0;
                    return $supplementary_payments+$record->amount_paid;
                }),
                TextColumn::make('event.event_fees')->searchable()->label('Expected Amount')
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListEventApplicants::route('/'),
            'create' => Pages\CreateEventApplicants::route('/create'),
            'edit' => Pages\EditEventApplicants::route('/{record}/edit'),
        ];
    }
}
