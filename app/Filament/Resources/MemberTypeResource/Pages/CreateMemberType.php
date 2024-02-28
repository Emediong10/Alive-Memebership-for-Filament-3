<?php

namespace App\Filament\Resources\MemberTypeResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\MemberTypeResource;

class CreateMemberType extends CreateRecord
{
    protected static string $resource = MemberTypeResource::class;

        protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Membertype registered')
        ->body('New Membertype created successfully.');
}
}
