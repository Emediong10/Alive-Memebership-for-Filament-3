<?php

namespace App\Filament\Resources\AreaInterestResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AreaInterestResource;

class CreateAreaInterest extends CreateRecord
{
    protected static string $resource = AreaInterestResource::class;



    protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Area of Interest created')
        ->body('New Area of interest created successfully.');
}

    protected function getRedirectUrl(): string
{
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
}



    
}
