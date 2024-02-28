<?php

namespace App\Filament\Resources\SpiritualGiftResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\SpiritualGiftResource;

class CreateSpiritualGift extends CreateRecord
{
    protected static string $resource = SpiritualGiftResource::class;

    protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Spiritual Gift Created')
        ->body('The Spiritual Gift has been created successfully.');
}
}
