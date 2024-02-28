<?php

namespace App\Filament\Resources\MissionResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\MissionResource;

class CreateMission extends CreateRecord
{
    protected static string $resource = MissionResource::class;

    protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Mission Created')
        ->body('The Mission has been successfully created.');
}
}
