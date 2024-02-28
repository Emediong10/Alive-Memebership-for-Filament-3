<?php

namespace App\Filament\Resources\MissionResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\MissionResource;

class EditMission extends EditRecord
{
    protected static string $resource = MissionResource::class;

    protected function getSaveNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Mission updated')
        ->body('The Misssion has been successfully updated.');
}

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
