<?php

namespace App\Filament\Resources\AreaInterestResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\AreaInterestResource;

class EditAreaInterest extends EditRecord
{
    protected static string $resource = AreaInterestResource::class;

    protected function getSaveNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Area of interest updated')
        ->body('The Area of interest has been successfully updated.');
}

    protected function getRedirectUrl(): string
{
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
}



    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
