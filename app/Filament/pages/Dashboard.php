<?php

namespace App\Filament\Pages;


use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Components\Textarea;
// use Filament\Infolists\Components\Section;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.users.pages.dashboard';


    // public function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Section::make('Heading')
    //                 ->schema([

    //                     Textarea::make('comment'),



    //                         ])
    //                         ]);
    // }





}
