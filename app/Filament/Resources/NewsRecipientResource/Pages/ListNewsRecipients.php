<?php

namespace App\Filament\Resources\NewsRecipientResource\Pages;

use App\Filament\Resources\NewsRecipientResource;
use App\Models\NewsRecipient;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;

class ListNewsRecipients extends ListRecords
{
    protected static string $resource = NewsRecipientResource::class;
    
    protected static ?string $title = 'Inbox';

    protected function getHeaderActions(): array
    {
        return [
           // Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
       return NewsRecipient::where(function($query){
            $query->where('user_id',auth()->user()->id)
            ->orWhere('member_types_id',auth()->user()->member_type)->whereNotNull('member_types_id');
        })->whereHas('news',function($query){
            $query->where('active',1);
        })->latest();
    }

   
}
