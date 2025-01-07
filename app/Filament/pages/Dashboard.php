<?php

namespace App\Filament\Pages;


use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Helpers\MessageHelper;
use Filament\Forms\Components\Textarea;
// use Filament\Infolists\Components\Section;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.users.pages.dashboard';

     public $showMessage;
    // public $message;

    public function mount()
    {
        $this->showMessage = MessageHelper::shouldDisplayMessage();

        
    }





}
