<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\EventApplicants;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventApplicantsResource\Pages;
use App\Filament\Resources\EventApplicantsResource\RelationManagers;

class EventApplicantsResource extends Resource
{


    protected static ?string $model = EventApplicants::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Heading')
                    ->schema([
                        Select::make('approval_status')
                        ->options([

                            0 => 'Application Pending',
                             1 => 'Application Approved',
                            2 => 'Application Denied',
                        ])->default(0),

                        Toggle::make('confirm_attendance'),
                       // Toggle::make('confirm_attendance'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name')->searchable(),
                TextColumn::make('chapter.name')->searchable()->label('Chapter'),
                TextColumn::make('event.name')->searchable()->sortable(),
                TextColumn::make('comments')->searchable()->sortable(),
                TextColumn::make('amount_paid')->searchable()->label('Total Payment Made')->getStateUsing(function($record){
                    $supplementary_payments= gettype($record->supplementary_payments)=="array"?array_sum(array_column($record->supplementary_payments,'amount_paid')):0;
                    return $supplementary_payments+$record->amount_paid;
                }),
                TextColumn::make('event.event_fees')->searchable()->label('Expected Amount'),

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
