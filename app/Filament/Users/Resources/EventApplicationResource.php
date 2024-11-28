<?php

namespace App\Filament\Users\Resources;

use Filament\Tables;
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

            // Toggle::make('confirmconfirm_attendance')->label('Did you attend the Event??')
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
                TextColumn::make('')->label('Status')->getStateUsing(function ($record) {
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
                })->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([

                Action::make('confirm')
                    ->label('Confirm Attendant')
                    ->requiresConfirmation()
                    ->modalSubHeading('Are you sure you attended the event?')
                    ->modalSubmitActionLabel('Yes, i attended')
                    ->action(function($record){
                        $user = EventApplicants::where([['event_id',$record->id],['user_id',auth()->user()->id],['approval_status',true]])->first();
                        $user->confirm_attendance = true;
                        $user->update();

                    })
                    ->button()
                    ->visible(function($record){
                        $value = EventApplicants::where([['event_id',$record->id],['user_id',auth()->user()->id]])->first();
                        if($value?->approval_status == true && $value->confirm_attendance == false){
                            return true;
                        }
                    }),
                Action::make('Apply')->action(function ($record, $data) {
                    EventApplicants::create([
                        'event_id' => $record->id,
                        'user_id' => auth()->user()->id,
                        'approval_status' => 0,
                        'comments' => $data['comments'],
                        'confirm_attendance' => 0,
                         'attendance_confirmed' => 0,
                    ]);
                    Notification::make()->title('Application made Successfully')->send()->success();
                })->requiresConfirmation()->form([
                    Textarea::make('comments'),
                ])->visible(
                    function ($record) {
                        $event_id = $record->id;
                        $applicant_id = auth()->user()->id;
                        $event_exists = EventApplicants::where(['event_id' => $event_id, 'user_id' => $applicant_id])->first();
                        if ($event_exists) {
                            return false;
                        }

                        return true;
                    }
                ),
                Action::make('Pay')->action(function($record, $data){
                    $event_id=$record->id;
                    $applicant_id=auth()->user()->id;
                    $event=EventApplicants::where(['event_id'=>$event_id,'user_id'=>$applicant_id])->first();
                    $supplementary_payments = isset($event->supplementary_payments) ? array_sum(array_column($event->supplementary_payments, 'amount_paid')) : 0;

                    // $supplementary_payments = dd($event->supplementary_payments);
                    $amount_paid = $event->amount_paid+$supplementary_payments;
                    //dd($amount_paid);
                    if($event &&( $event->amount_paid == null || $event->amount_paid== 0)){
                        $event->update([
                            'transaction_reference'=>$data['transaction_reference'],
                            'amount_paid'=>$data['amount_paid'],
                            'payment_method'=>$data['payment_method'],
                            'payment_evidence'=>$data['payment_evidence'],
                        ]);
                        Notification::make()->title('Payment Details updated')->send()->success();
                    }
                    elseif($event && $amount_paid > 0 && $amount_paid < $event->event->event_fees){
                        $supplementary_payment_data = $event->supplementary_payments ?: [];
                        array_push($supplementary_payment_data,[
                            'transaction_reference'=>$data['transaction_reference'],
                            'amount_paid'=>$data['amount_paid'],
                            'payment_method'=>$data['payment_method'],
                            'payment_evidence'=>$data['payment_evidence'],
                        ]);
                        $event->update([
                        'supplementary_payments'=>$supplementary_payment_data,
                        ]);
                        Notification::make()->title('Payment Details updated')->send()->success();
                    }



                })->visible(function($record){
                    $event_id=$record->id;
                    $applicant_id=auth()->user()->id;
                    $event_exists=EventApplicants::where(['event_id'=>$event_id,'user_id'=>$applicant_id])->first();
                    $supplementary_payment_data = isset($event_exists->supplementary_payments) && !empty($event_exists->supplementary_payments)? $event_exists->supplementary_payments : 0;
                    $supplementary_payments = gettype($supplementary_payment_data)=="array"?array_sum(array_column($supplementary_payment_data,'amount_paid')):0;
                   $amount_paid = isset($event_exists) && isset($event_exists->amount_paid)
                    ? $event_exists->amount_paid + $supplementary_payments : $supplementary_payments;

                    if($event_exists && $event_exists->event->is_paid_event==true && (int)$amount_paid<(int)$event_exists->event->event_fees && $event_exists->approval_status!=2){
                        return true;
                    }
                    elseif($event_exists && (int)$amount_paid>=(int)$event_exists->event->event_fees){

                        return false;
                    }

                    return false;
                })->form([
                       TextInput::make('transaction_reference')->helperText('Code For Referencing transaction')->hint('This could be the transaction reference number generated after transfer or the bank teller number on a bank deposit slip')->required(),
                       TextInput::make('amount_paid')->required()->numeric(),
                       Select::make('payment_method')->options([
                        'Transfer'=>'Transfer',
                        'Bank Deposit'=>'Bank Deposit',
                       ])->required(),
                       FileUpload::make('payment_evidence')->directory('images/payment_evidence')->required(),
                ])
                ])

        //
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
            'index' => Pages\ListEventApplications::route('/'),
            'create' => Pages\CreateEventApplication::route('/create'),
           // 'edit' => Pages\EditEventApplication::route('/{record}/edit'),
        ];
    }


}
