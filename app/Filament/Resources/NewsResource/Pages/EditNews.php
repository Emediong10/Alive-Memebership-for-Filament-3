<?php

namespace App\Filament\Resources\NewsResource\Pages;

use Filament\Actions;
use App\Filament\Resources\NewsResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getSaveNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('News update')
        ->body('The News has been successfully updated.');
}

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
