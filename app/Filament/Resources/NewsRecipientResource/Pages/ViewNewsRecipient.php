<?php

namespace App\Filament\Resources\NewsRecipientResource\Pages;

use App\Filament\Resources\NewsRecipientResource;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewNewsRecipient extends ViewRecord
{
    protected static string $resource = NewsRecipientResource::class;

    protected static ?string $title = 'jhhj';

    
    protected function getHeaderActions(): array
    {
        return [
           // Actions\EditAction::make(),
        ];
    }
   
    public function infolist(Infolist $infolist): Infolist
    {
        self::$title=ucwords($this->record->title);
        $this->record->update(['read'=>1]);

        return $infolist
        ->record($this->record)
        ->schema([
            TextEntry::make('news.title')->label('Title'),
            TextEntry::make('news.content')->html()->label('Content')
        ])->columns(1);
    }

}
