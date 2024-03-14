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
                    TextEntry::make('name')->label('Attended Missions')
                 ]),

                RepeatableEntry::make('spiritual_gifts')
                ->schema([
                    TextEntry::make('name')->label('Spiritual Gifts')
                    ]),


            TextEntry::make('skills')
            ->label('My Skills')
            ->getStateUsing(function ($record) {
                $skillIds = json_decode($record->skill_id);
                return collect($skillIds)
                 ->map(function ($skillId) {
                  return Skill::find($skillId)->name ?? null;
              })
             ->filter()
             ->values()
            ->all();
            }),
            TextEntry::make('area_interests')
            ->label('My areas Of Interest')
            ->getStateUsing(function ($record) {
                $areaInterestIds = json_decode($record->area_interest_id);
                return collect($areaInterestIds)
                    ->map(function ($areaInterestId) {
                        return AreaInterest::find($areaInterestId)->name ?? null;
                    })
                    ->filter()
                    ->values()
                    ->all();
            }),
            TextEntry::make('spiritual_gifts')
            ->label('My Sprirtual Gifts')
    ->getStateUsing(function ($record) {
        $spiritualGiftIds = is_array($record->spiritual_gift_id) ? $record->spiritual_gift_id : json_decode($record->spiritual_gift_id);
        return collect($spiritualGiftIds)
            ->map(function ($spiritualGiftId) {
                return SpiritualGift::find($spiritualGiftId)->name ?? null;
            })
            ->filter()
            ->values()
            ->all();
    }),

        

                        
                ])->columns(3),
               
                
                           ]);
                     // ->statePath('users')
                 // ->model(auth()->users()) 
            
    }
    public function clearState(): void {
        $this->state(null);
    }
 

};

    

