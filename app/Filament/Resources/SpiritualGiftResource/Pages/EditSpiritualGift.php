<?php

namespace App\Filament\Resources\SpiritualGiftResource\Pages;

use App\Filament\Resources\SpiritualGiftResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpiritualGift extends EditRecord
{
    protected static string $resource = SpiritualGiftResource::class;

    protected function getSaveNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Spiritual Gift Updated')
        ->body('The Spiritual Gift has been successfully upated.');
}

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
