<?php

namespace App\Filament\Users\Resources\EventApplicationResource\Pages;

use App\Filament\Users\Resources\EventApplicationResource;
use App\Models\Event;
use App\Models\EventApplicants;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListEventApplications extends ListRecords
{
    protected static string $resource = EventApplicationResource::class;



    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->visible(function(){
                if(auth()->user()->hasRole('admin')){
                    return true;
                }else{
                    return false;
                }
            }),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return Event::where('active',1);
    }
}
