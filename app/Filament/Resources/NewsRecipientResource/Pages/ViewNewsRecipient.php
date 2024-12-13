<?php

namespace App\Filament\Resources\NewsRecipientResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
// use Parallax\FilamentComments\Actions\CommentsAction;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\NewsRecipientResource;
use Parallax\FilamentComments\Actions\CommentsAction;
use Parallax\FilamentComments\Infolists\Components\CommentsEntry;

class ViewNewsRecipient extends ViewRecord
{
    protected static string $resource = NewsRecipientResource::class;

    protected static ?string $title ='';


    protected function getHeaderActions(): array
    {
        return [

           Actions\EditAction::make()->visible(function($record){
        if(auth()->user()->hasRole(['admin'])){
            return true;
        }
        else{
            return false;
        }
           }),
        //   CommentsAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        $this->record->update(['read'=>1]);

        return $infolist
        ->record($this->record)
        ->schema([
           Section::make('Heading')
            ->description('')
            ->schema([
                TextEntry::make('news.title')->label('News title'),
                TextEntry::make('news.content')->html()->label('News Content')
                ->columnSpan(2)
            ]),
                // CommentsEntry::make('filament_comments')

            ])->columns(1);

            // CommentsEntry::make('filament_comments'),
    }

}
