<?php

namespace App\Filament\Resources\NewsRecipientResource\Pages;

use App\Filament\Resources\NewsRecipientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewsRecipient extends EditRecord
{
    protected static string $resource = NewsRecipientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
