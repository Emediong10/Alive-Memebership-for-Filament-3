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
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventApplicantsResource\Pages;
use App\Filament\Resources\EventApplicantsResource\RelationManagers;

class EventApplicantsResource extends Resource
{


    protected static ?string $model = EventApplicants::class;

    protected static ?string $navigationIcon = 'heroicon-o-cloud';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Heading')
                    ->schema([
                        // Select::make('approval_status')
                        // ->options([

                        //     0 => 'Application Pending',
                        //      1 => 'Application Approved',
                        //     2 => 'Application Denied',
                        // ])->default(0),


                        Textarea::make('comments'),

                    ]),


                    // Toggle::make('confirm_attendance'),
                    ToggleButtons::make('attendance_confirmed')
                    ->label('Confirm that the member attendend the program')
                    ->boolean()
                    ->grouped()
                            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name')->searchable(),
                TextColumn::make('chapter.name')->searchable()->label('Chapter'),
                TextColumn::make('event.name')->searchable()->sortable(),
                BadgeColumn::make('approval_status')
                    ->formatStateUsing(function($record){
                        if($record->approval_status == true){
                            return 'Approved';
                        }
                        elseif($record->approval_status == false){
                            return 'Pending';
                        }
                    else{

                        return 'Declined';
                    }
                    })


                    ->colors ([
                        'primary' => 'Approved',
                        'warning' => 'Pending',
                        'danger' => 'Declined',
                    ]),


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

                    Tables\Actions\ViewAction::make(),
                    // Tables\Actions\EditAction::make(),
                    // Tables\Actions\DeleteAction::make(),

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
            'view' => Pages\ViewEventApplicants::route('/{record}/view'),
        ];
    }
}
