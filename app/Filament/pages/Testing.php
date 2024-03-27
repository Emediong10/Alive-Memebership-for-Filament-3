<?php

namespace App\Filament\Pages;
use App\Models\User;
//use Component\Section;
use Filament\Pages\Page;
use Filament\Infolists\Infolist;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Concerns\InteractsWithInfolists;

class Testing extends Page implements HasInfolists
{
    Use InteractsWithInfolists;

    protected static ?string $navigationLabel = 'Profe';

    protected static ?string $navigationGroup = 'My ';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static string $view = 'filament.pages.testing';

    protected static bool $shouldRegisterNavigation = false;

    public $user;

    public function mount(): void
    {
        // $user = auth()->user()->id;
        // $this->user_id = $user;
        $this->form->fill(
            auth()->user()->attributesToArray()
        );

        $this->record = User::where('id',auth()->user()->id)->first();
    }
   
    public function infolist(Infolist $infolist): Infolist
    {
        // dd($this->record->id);
        return $infolist
        ->record($this->record)
            ->schema([
              Section::make()
              ->description('My Profile') 
              ->schema([
              Textentry::make('firstname'),
              Textentry::make('middlename'),
              Textentry::make('lastname'),
              Textentry::make('phone'),
              Textentry::make('email'),
              Textentry::make('chapter.name'),
              
                         ])->columns(3)
                   // ->statePath('users')
               // ->model(auth()->users()) 
            ]);
    }
    public function clearState(): void {
        $this->state(null);
    }
 

}