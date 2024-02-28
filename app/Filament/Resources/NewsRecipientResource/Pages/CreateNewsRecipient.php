<?php

namespace App\Filament\Resources\NewsRecipientResource\Pages;

use App\Filament\Resources\NewsRecipientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsRecipient extends CreateRecord
{
    protected static string $resource = NewsRecipientResource::class;

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
