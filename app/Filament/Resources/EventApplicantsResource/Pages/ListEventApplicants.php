<?php

namespace App\Filament\Resources\EventApplicantsResource\Pages;

use App\Filament\Resources\EventApplicantsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventApplicants extends ListRecords
{
    protected static string $resource = EventApplicantsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
