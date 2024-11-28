<?php

namespace App\Filament\Users\Resources\PaymentResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Unicodeveloper\Paystack\Paystack;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Users\Resources\PaymentResource;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
          Action::make('Pay with Paystack')
                    ->label('Make Payment')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-credit-card')
                    ->form([
                        TextInput::make('amount')
                            ->numeric()
                            ->required()
                             ->prefix('NGN')
                            ->label('Payment Amount'),

                       TextInput::make('description')
                            ->required()
                            ->maxLength(255)
                            ->minLength(5)
                            ->label('Payment Description'),
                    ])
                    ->action(function (array $data) {
                        $this->processPaystackPayment($data);
                    })
                    ->modalHeading('Make a Payment')
                    ->modalIcon('heroicon-o-credit-card')
                    ->modalButton('Proceed to Paystack'),

                ];


    }


    public function processPaystackPayment(array $data)
    {
        $paystack = new \Unicodeveloper\Paystack\Paystack();

        $user = auth()->user();


        $transactionData = [
            'amount' => $data['amount'] * 100,
            'email' => $user->email,
            'metadata' => [
                'user_id' => $user->id,
                'description' => $data['description'],
            ],
        ];

        
        $response = $paystack->getAuthorizationUrl($transactionData)->redirectNow();

        return $response;
    }

}
