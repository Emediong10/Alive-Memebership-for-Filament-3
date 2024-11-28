<?php

namespace App\Filament\Users\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Payment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Users\Resources\PaymentResource\Pages;
use App\Filament\Users\Resources\PaymentResource\RelationManagers;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationGroup = 'Payments';
    
    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                TextInput::make('amount')
                ->label('Amount')
                ->prefix('₦')
                ->readOnly() 
                ->afterStateHydrated(function ($state, $set) {
                    if ($state) {
                        $set('amount', number_format($state / 100, 0));
                    }
                }),

                TextInput::make('trans_reference'),
                TextInput::make('trans_status'),
                TextInput::make('created_at')
                ->label('Created At')
                ->readOnly()
                ->afterStateHydrated(function ($state, $set) {
                    if ($state) {
                        $set('created_at', \Carbon\Carbon::parse($state)->format('F j, Y, g:i A'));
                    }
                })
            
                // ->dateTime('l M j, Y: h:i:A'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(fn () => Payment::where('user_id', auth()->id()))
            ->columns([

            TextColumn::make('user.name')
            ->label('Your Name') 
            ->icon('heroicon-m-user')
            ->iconColor('success'),
            TextColumn::make('user.email')
            ->label('Your Email') 
            ->searchable()
            ->sortable()
             ->copyable()
             ->copyMessage('email copied')
             ->copyMessageDuration(1500)
             ->icon('heroicon-m-envelope')
             ->iconColor('success'),


                TextColumn::make('amount')
                ->label('Amount Paid')
                ->searchable()
             ->sortable()
            //    ->icon('heroicon-o-check-badge')
                // ->iconColor('success')
                ->getStateUsing(function ($record) {
                    $payment = Payment::where('user_id', auth()->id())->first();
                    if ($payment) {
                        return '₦' . number_format($payment->amount / 100, 0);
                    }
                    return null;
                }),
            
            TextColumn::make('description')
                ->label('Payment Description')
                ->searchable()
                ->sortable()
                ->getStateUsing(function ($record) {
                    $payment = Payment::where('user_id', auth()->id())->first();
                    return $payment ? $payment->description : null;
                }),

            TextColumn::make('trans_reference')
                ->label('Transaction Reference')
                ->searchable()
                ->sortable()
                 ->copyable()
                 ->icon('heroicon-m-clipboard')
                 ->iconColor('success')
                 ->copyMessage('Transaction Reference copied')
                 ->copyMessageDuration(1500)
                ->getStateUsing(function ($record) {
                    $payment = Payment::where('user_id', auth()->id())->first();
                    return $payment ? $payment->trans_reference : null;
                }),

            // TextColumn::make('metadata')
            //     ->label('Metadata Reference')
            //     ->searchable()
            //     ->sortable()
            //     ->getStateUsing(function ($record) {
            //         $payment = Payment::where('user_id', auth()->id())->first();
            //         return $payment ? $payment->metadata : null;
                // }),

            TextColumn::make('trans_status')
                ->label('Payment Status')
                ->searchable()
                ->sortable()
                ->getStateUsing(function ($record) {
                    $payment = Payment::where('user_id', auth()->id())->first();
                    return $payment ? $payment->trans_status : null;
                })
                ->sortable()
                ->formatStateUsing(function ($state) {
                    return $state === 'success' ? 'Successful Transaction' : 'Failed Transaction';
                })
                ->icon(function ($state) {
                    return $state === 'success'
                        ? 'heroicon-o-check-badge'
                        : 'heroicon-o-x-circle';
                })
                ->iconColor(function ($state) {
                    return $state === 'success'
                        ? 'success'
                        : 'danger';
                })
                ->color(function ($state) {
                    return $state === 'success'
                        ? 'success'
                        : 'danger';
                }),

                TextColumn::make('created_at')
                ->label('Payment Date')
                ->searchable()
                ->sortable()
                ->dateTime('l M j, Y: h:i:A')
                ->getStateUsing(function ($record) {
                    $payment = Payment::where('user_id', auth()->id())->first();
                    return $payment ? $payment->created_at : null;
                }),

            ])
            ->filters([
                //
            ])
            ->actions([
               Tables\Actions\ViewAction::make(),
               Tables\Actions\Action::make('pdf') 
               ->label('Download Payment Receipt')
               ->color('success')
               ->icon('heroicon-o-arrow-down-tray')
               ->url(fn (Payment $record) => route('pdf', $record))
               ->openUrlInNewTab(), 

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPayments::route('/'),
            // 'create' => Pages\CreatePayment::route('/create'),
            // 'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
