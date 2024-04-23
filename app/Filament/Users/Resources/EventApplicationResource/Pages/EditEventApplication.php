<?php

namespace App\Filament\Users\Resources\EventApplicationResource\Pages;

use App\Filament\Users\Resources\EventApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventApplication extends EditRecord
{
    protected static string $resource = EventApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
