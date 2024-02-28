<?php

namespace App\Filament\Resources\AreaInterestResource\Pages;

use App\Filament\Resources\AreaInterestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAreaInterest extends ViewRecord
{
    protected static string $resource = AreaInterestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
