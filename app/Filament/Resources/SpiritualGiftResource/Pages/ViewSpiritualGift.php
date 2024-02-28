<?php

namespace App\Filament\Resources\SpiritualGiftResource\Pages;

use App\Filament\Resources\SpiritualGiftResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSpiritualGift extends ViewRecord
{
    protected static string $resource = SpiritualGiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
