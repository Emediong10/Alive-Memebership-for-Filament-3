<?php

namespace App\Filament\Users\Resources;

use Filament\Tables;
use App\Models\Payment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\EventApplicants;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use App\Filament\Users\Resources\EventApplicationResource\Pages;

class EventApplicationResource extends Resource
{
    protected static ?string $model = EventApplicants::class;

    protected static ?string $navigationGroup = 'Event Registration';

    public static function shouldRegisterNavigation(): bool
    {
        if(auth()->user()->hasRole(['admin'])){
            return false;
        }
        return  true;
    }

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $title = 'Event Application';

    protected static ?string $navigationLabel = 'Event Application';
    //protected static ?string $description = 'Event Application';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

          Textarea::make('description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event_type.name')->label('Event Type')->sortable()->searchable(),
                TextColumn::make('name')->label('Event Name')->searchable(),
                TextColumn::make('venue')->label('Venue')->searchable(),
                TextColumn::make('start_date')->label('Start Date')->sortable()->searchable(),
                TextColumn::make('end_date')->label('End Date')->sortable()->searchable(),
               // ToggleColumn::make('confirm_attendance')->label('Confirm your attendance after the event??'),
               ImageColumn::make('event_flyer'),
                TextColumn::make('event_fees')->label('Fees')->getStateUsing(function ($record) {
                    return $record->event_fees.' '.$record->event_fees_currency;
                }),
                TextColumn::make('status')
                ->label('Status')
                ->getStateUsing(function ($record) {
                    $event_id = $record->id;
                    $applicant_id = auth()->user()->id;
                    $event = EventApplicants::where(['event_id' => $event_id, 'user_id' => $applicant_id])->first();
                    if ($event) {
                        if ($event->approval_status == 0) {
                            return 'Application Pending';
                        } elseif ($event->approval_status == 1) {
                            return 'Application Approved';
                        } elseif ($event->approval_status == 2) {
                            return 'Application Denied';
                        }
                    }
                })
                ->badge() // Enable badges for the column
                ->color(function ($state) {
                    // Assign colors based on the state
                    return match ($state) {
                        'Application Pending' => 'warning',
                        'Application Approved' => 'success',
                        'Application Denied' => 'danger',
                        default => 'secondary',
                    };
                })
                ->icon(function ($state) {
                    // Assign icons based on the state
                    return match ($state) {
                        'Application Pending' => 'heroicon-o-clock',
                        'Application Approved' => 'heroicon-o-check-circle',
                        'Application Denied' => 'heroicon-o-x-circle',
                        default => null,
                    };
                })
            
               ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Action::make('Apply')
                ->action(function ($record, $data) {
                    EventApplicants::create([
                        'event_id' => $record->id,
                        'user_id' => auth()->user()->id,
                        'approval_status' => 0,
                        'comments' => $data['comments'],
                        'confirm_attendance' => 0,
                        'attendance_confirmed' => 0,
                    ]);
                    Notification::make()->title('Application made Successfully')->send()->success();
                })
                ->requiresConfirmation()
                ->form([
                    Textarea::make('comments'),
                ])
                ->visible(function ($record) {
                    $event_id = $record->id;
                    $applicant_id = auth()->user()->id;
                    return !EventApplicants::where(['event_id' => $event_id, 'user_id' => $applicant_id])->exists();
                }),

                Action::make('decline_reason')
                ->icon('heroicon-o-eye')
                ->color('danger')
                ->action(function ($record) {
                    $eventApplicant = EventApplicants::where([
                        ['event_id', $record->id],
                        ['user_id', auth()->user()->id],
                    ])->first();
            
                    if ($eventApplicant && $eventApplicant->approval_status === 2) {
                        $declineReason = $eventApplicant->decline_reason ?? 'No reason provided';
                        Notification::make()
                            ->title('Payment Declined')
                            ->body($declineReason)
                            ->danger()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('No Decline Information Found')
                            ->danger()
                            ->send();
                    }
                })
                ->visible(function ($record) {
                    // Make the action visible only if the profile's approval status is 2 (denied)
                    $eventApplicant = EventApplicants::where([
                        ['event_id', $record->id],
                        ['user_id', auth()->user()->id],
                    ])->first();
            
                    return $eventApplicant && $eventApplicant->approval_status === 2;
                }),


                            Action::make('Restart Application')
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->requiresConfirmation()
                ->modalHeading('Restart Application')
                ->modalSubheading('Are you sure you want to restart your application? This will reset the application and payment data.')
                ->modalButton('Restart')
                ->action(function ($record) {
                    $eventApplicant = EventApplicants::where([
                        ['event_id', $record->id],
                        ['user_id', auth()->user()->id],
                    ])->first();

                    if ($eventApplicant) {
                        // Reset the application details
                        $eventApplicant->update([
                            'approval_status' => 0, // Reset to pending
                            'decline_reason' => null, // Clear decline reason
                            'transaction_reference' => null, // Clear any payment data
                            'payment_evidence' => null, // Clear payment evidence
                        ]);

                        Notification::make()
                            ->title('Application Restarted Successfully')
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('No Application Record Found')
                            ->danger()
                            ->send();
                    }
                })
                ->visible(function ($record) {
                    $eventApplicant = EventApplicants::where([
                        ['event_id', $record->id],
                        ['user_id', auth()->user()->id],
                    ])->first();

                    // Make button visible only if the application is denied
                    return $eventApplicant && $eventApplicant->approval_status === 2;
                }),

            
            
                Action::make('Payment')
                ->icon('heroicon-o-credit-card')
                ->action(function ($record, $data) {
                    $eventApplicant = EventApplicants::where([
                        ['event_id', $record->id],
                        ['user_id', auth()->user()->id],
                    ])->first();
            
                    if ($eventApplicant) {
                        if ($data['payment_choice'] === 'existing') {
                            $eventApplicant->update([
                                'transaction_reference' => $data['transaction_reference'],
                                'payment_evidence' => $data['payment_evidence'],
                            ]);
                            Notification::make()->title('Payment Details Updated Successfully')->send()->success();
                        } else {
                            try {
                                $paystack = new \Unicodeveloper\Paystack\Paystack();
                                $user = auth()->user();
            
                                $transactionData = [
                                    'amount' => $record->event_fees * 100, // Amount in kobo (multiply by 100)
                                    'email' => $user->email,
                                    'metadata' => [
                                        'user_id' => $user->id,
                                        'description' => 'Payment for Event #' . $record->id,
                                    ],
                                ];
            
                                $response = $paystack->getAuthorizationUrl($transactionData)->redirectNow();
            
                                return $response;
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->title('Failed to initiate payment: ' . $e->getMessage())
                                    ->danger()
                                    ->send();
                            }
                        }
                    } else {
                        Notification::make()->title('No Event Applicant Record Found')->send()->danger();
                    }
                })
                ->form([
                    Select::make('payment_choice')
                        ->options([
                            'existing' => 'Have you already paid?',
                            'new' => 'Proceed with Payment',
                        ])
                        ->reactive()
                        ->required(),
                    TextInput::make('amount_paid')
                        ->label('Amount paid')
                        ->required(),
                    TextInput::make('transaction_reference')
                        ->label('Transaction Reference')
                        ->required()
                        ->visible(fn($get) => $get('payment_choice') === 'existing'),
                    FileUpload::make('payment_evidence')
                        ->label('Payment Evidence')
                        ->directory('images/payment_evidence')
                        ->required()
                        ->visible(fn($get) => $get('payment_choice') === 'existing'),
                ])
                ->modalHeading('Payment')
                ->modalIcon('heroicon-o-credit-card')
                ->modalButton('Submit')
                ->requiresConfirmation()
                ->visible(function ($record) {
                    // Get the applicant's event application record
                    $applicant_id = auth()->user()->id;
                    $eventApplicant = EventApplicants::where([
                        ['event_id', $record->id],
                        ['user_id', $applicant_id],
                    ])->first();
            
                    // Check if event_fees is null or zero
                    if (is_null($record->event_fees) || $record->event_fees == 0) {
                        return false; // Disable button if event_fees is null or zero
                    }
            
                    // Check if the application status is approved
                    if ($eventApplicant && $eventApplicant->approval_status === 1) {
                        return false; // Disable button if the application is approved
                    }
            
                    return true; // Otherwise, show payment button
                }),
            

            ])
        //
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function processPaystackPayment(array $data)
    {
        try {
            $paystack = new \Unicodeveloper\Paystack\Paystack();
            $user = auth()->user();
    
            $transactionData = [
                'amount' => $data['amount'] * 100, // Amount in kobo
                'email' => $user->email,
                'metadata' => [
                    'user_id' => $user->id,
                    'description' => $data['description'],
                ],
            ];
    
            // Generate authorization URL
            $response = $paystack->getAuthorizationUrl($transactionData)->redirectNow();
    
            return $response;
        } catch (\Exception $e) {
            // Handle API errors or exceptions
            return redirect()->back()->with('error', 'Failed to initiate payment: ' . $e->getMessage());
        }
    }
    
    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventApplications::route('/'),
            // 'create' => Pages\CreateEventApplication::route('/create'),
            'view' => Pages\CreateEventApplication::route('/view'),
           // 'edit' => Pages\EditEventApplication::route('/{record}/edit'),
        ];
    }


}
