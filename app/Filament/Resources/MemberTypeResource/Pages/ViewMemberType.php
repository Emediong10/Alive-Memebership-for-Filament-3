<?php

namespace App\Filament\Resources\MemberTypeResource\Pages;

use App\Filament\Resources\MemberTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMemberType extends ViewRecord
{
    protected static string $resource = MemberTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
