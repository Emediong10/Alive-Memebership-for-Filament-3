<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Payment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PaymentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PaymentResource\RelationManagers;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationGroup = 'Payments';
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                TextInput::make('description'),
                TextInput::make('currency'),
                TextInput::make('payment_type'),
                TextInput::make('created_at')
                ->label('Created At')
                ->readOnly()
                ->afterStateHydrated(function ($state, $set) {
                    if ($state) {
                        $set('created_at', \Carbon\Carbon::parse($state)->format('F j, Y, g:i A'));
                    }
                })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.firstname')
                ->label('firstname')
                 ->searchable()
                ->sortable() 
                ->icon('heroicon-m-user')
                 ->iconColor('success'),
                
                TextColumn::make('user.lastname')
                   ->label('lastname')
                 ->searchable()
                ->sortable(),
                
                TextColumn::make('user.email') 
                ->searchable()
                ->label('Email')
                ->sortable()
                 ->copyable()
                 ->copyMessage('email copied')
                 ->copyMessageDuration(1500)
                 ->icon('heroicon-m-envelope')
                 ->iconColor('success'),

                TextColumn::make('amount')
                ->label('Amount') 
                ->searchable()
                ->sortable()
                ->getStateUsing(function ($record) {
                    if ($record->amount) {
                        return '₦' . number_format($record->amount / 100, 2);
                    }
                    return null;
                }),
                TextColumn::make('trans_reference') 
                ->searchable()
                ->searchable()
                ->sortable()
                 ->copyable()
                 ->icon('heroicon-m-clipboard')
                 ->iconColor('success')
                 ->copyMessage('Transaction Reference copied')
                 ->copyMessageDuration(1500),
                 
                 TextColumn::make('payment_type') 
                ->searchable()
                ->sortable()->searchable()
                ->sortable(),
                 TextColumn::make('currency') 
                ->searchable()
                ->sortable()->searchable()
                ->sortable(),
                //  ->copyable()
                //  ->copyMessage('payment')
                //  ->copyMessageDuration(1500),

                TextColumn::make('trans_status') 
                ->label('Transaction Status')
                ->searchable()
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
            ])
            ->filters([
                //
            ])
            ->actions([
                 Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPayments::route('/'),
            // 'create' => Pages\CreatePayment::route('/create'),
            // 'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
