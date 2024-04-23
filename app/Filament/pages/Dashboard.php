<?php

namespace App\Filament\Pages;


use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.users.pages.dashboard';
    
    public static function shouldRegisterNavigation(): bool
        {
            if(auth()->user()->hasRole(['admin'])){
                return false;
            }
            return  true;
        }
}
