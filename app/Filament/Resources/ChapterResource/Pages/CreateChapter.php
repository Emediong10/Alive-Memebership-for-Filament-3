<?php

namespace App\Filament\Resources\ChapterResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ChapterResource;

class CreateChapter extends CreateRecord
{
    protected static string $resource = ChapterResource::class;
   
 protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

    protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Chapter Created')
        ->body('New Chapter created successfully.');
}
}
