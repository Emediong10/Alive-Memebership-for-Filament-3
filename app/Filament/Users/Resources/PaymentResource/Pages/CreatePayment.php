<?php

namespace App\Filament\Users\Resources\PaymentResource\Pages;

use App\Filament\Users\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;
}
