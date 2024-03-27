<?php

namespace App\Filament\Resources\NewsRecipientResource\Pages;

use App\Filament\Resources\NewsRecipientResource;
//use Parallax\FilamentComments\Actions\CommentsAction;
use Parallax\FilamentComments\Infolists\Components\CommentsEntry;
use Parallax\FilamentComments\Actions\CommentsAction;

use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewNewsRecipient extends ViewRecord
{
    protected static string $resource = NewsRecipientResource::class;

    protected static ?string $title ='';

   
    protected function getHeaderActions(): array
    {
        return [
           // Actions\EditAction::make()
           CommentsAction::make(),
        ];
    }
   
    public function infolist(Infolist $infolist): Infolist
    {
        $this->record->update(['read'=>1]);
        
        return $infolist
        ->record($this->record)
        ->schema([
            TextEntry::make('news.title')->label('Title'),
            TextEntry::make('news.content')->html()->label('Content'),
             CommentsEntry::make('filament_comments'),
            
        ])->columns(1);
    }

}
