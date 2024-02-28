<?php

namespace App\Filament\Resources\SpiritualGiftResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\SpiritualGiftResource;

class EditSpiritualGift extends EditRecord
{
    protected static string $resource = SpiritualGiftResource::class;

    protected function getSaveNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Spiritual Gift Updated')
        ->body('Spiritual Gift successfully upated.');
}

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
