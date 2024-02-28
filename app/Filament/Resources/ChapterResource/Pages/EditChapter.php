<?php

namespace App\Filament\Resources\ChapterResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ChapterResource;

class EditChapter extends EditRecord
{
    protected static string $resource = ChapterResource::class;
    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

    protected function getSaveNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Chapter Update')
        ->body('Chapter successfully Updated.');
}

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
