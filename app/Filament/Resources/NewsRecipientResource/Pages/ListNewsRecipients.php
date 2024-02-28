<?php

namespace App\Filament\Resources\NewsRecipientResource\Pages;

use App\Filament\Resources\NewsRecipientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsRecipients extends ListRecords
{
    protected static string $resource = NewsRecipientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
