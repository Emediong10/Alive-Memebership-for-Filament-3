<?php

namespace App\Filament\Users\Pages;
// namespace App\Filament\Pages;
use App\Models\User;
use App\Models\Skill;
use App\Models\Mission;
use Filament\Pages\Page;
use App\Models\AreaInterest;
//use Component\Section;
use App\Models\SpiritualGift;
use Filament\Infolists\Infolist;
use Filament\Pages\Actions\Action;
use Filament\Infolists\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;


class MyDetails extends Page implements HasInfolists


{
     protected static ?string $navigationLabel = 'Profile';

    Use InteractsWithInfolists;

    protected static ?string $navigationGroup = 'My Profile';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static string $view = 'filament.pages.testing';

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
              Card::make()
              ->icon('heroicon-o-user')
              ->collapsible()
              ->description('My Profile') 
              ->schema([
              Textentry::make('firstname'),
              Textentry::make('middlename'),
              Textentry::make('lastname'),
              Textentry::make('phone'),
              Textentry::make('email'),
              Textentry::make('chapter.name'), 
         
                Textentry::make('gender'),
                Textentry::make('dob'),
                Textentry::make('course_of_study'),
                Textentry::make('degree'),
                Textentry::make('occupation'),
                Textentry::make('professional_abilities'),
            
                RepeatableEntry::make('missions')
                ->schema([
<<<<<<< HEAD
                    TextEntry::make('name')
                    ->color('success')
                    ->label('')
                 ]),

                RepeatableEntry::make('spiritual_gifts')
                ->schema([
                    TextEntry::make('name')
                    ->label('')
                    ->color('success')
                    ]),
                RepeatableEntry::make('area_interests')
                ->schema([
                    TextEntry::make('name')
                    ->color('success')
                    ->label('')
                    ]),
                RepeatableEntry::make('skills')
                ->schema([
                    TextEntry::make('name')
                    ->label('')
                    ->color('success')
                    ]),
=======
                    TextEntry::make('name')->label('Attended Missions')
                    
                ]),
                RepeatableEntry::make('spirituals')
                ->schema([
                    TextEntry::make('name')->label('Attended Missions')
                    
                ]),
>>>>>>> da3bc174107ec4f54593673eb9d1dff802d27116

        
                ])->columns(4),
               
                
                           ]);
                     // ->statePath('users')
                 // ->model(auth()->users()) 
            
    }
    public function clearState(): void {
        $this->state(null);
    }
 

};

    

