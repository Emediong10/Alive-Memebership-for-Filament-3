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
use Filament\Forms\Components\FileUpload;
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
                Section::make('')
                    ->schema([
                Section::make('Heading')
                    ->description('')
                    ->schema([
                        TextInput::make('transaction_reference'),
                        TextInput::make('amount'),
                        Textarea::make('comments'),
                        FileUpload::make('payment_evidence')
                        ->label('Payment Evidence')
                        ->downloadable()
                        ->directory('images/payment_evidence'),
                    ])
                    ->columns(2),

                    ]),


                    // Toggle::make('confirm_attendance'),
                    // ToggleButtons::make('attendance_confirmed')
                    // ->label('Confirm that the member attendend the program')
                    // ->boolean()
                    // ->grouped()
                          ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name')->searchable(),
                TextColumn::make('chapter.name')->searchable()->label('Chapter'),
                TextColumn::make('event.name')->searchable()->sortable(),
                TextColumn::make('approval_status')
                ->formatStateUsing(function ($record) {
                    if ($record->approval_status == 1) {
                        return '<span style="color: green;"><x-heroicon-o-check-circle class="w-5 h-5 inline" /> Approved</span>';
                    } elseif ($record->approval_status == 0) {
                        return '<span style="color: orange;"><x-heroicon-o-clock class="w-5 h-5 inline" /> Pending</span>';
                    } else {
                        return '<span style="color: red;"><x-heroicon-o-x-circle class="w-5 h-5 inline" /> Declined</span>';
                    }
                })
                ->html(), // Places the icon before the text.
            
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
