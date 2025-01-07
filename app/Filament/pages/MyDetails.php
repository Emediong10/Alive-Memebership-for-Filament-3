<?php

namespace App\Filament\Pages;
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

    protected static string $view = 'filament.users.pages.my-details';

    public static function shouldRegisterNavigation(): bool
    {
        if(auth()->user()->hasRole(['admin'])){
            return false;
        }
        return  true;
    }

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
              Textentry::make('firstname')
              ->color('success'),
              Textentry::make('middlename')
              ->color('success'),
              Textentry::make('lastname')
              ->color('success')
              ,
              Textentry::make('phone')
              ->color('success'),
              Textentry::make('email')
              ->color('success'),

              Textentry::make('chapter.name')
              ->color('success'),
              Textentry::make('member_type.type')
              ->color('success'),

                Textentry::make('gender')
                ->color('success'),
                Textentry::make('dob')
                ->color('success'),
                Textentry::make('course_of_study')
                ->color('success'),
                Textentry::make('degree')
                ->color('success'),
                Textentry::make('occupation')
                ->color('success'),
                Textentry::make('professional_abilities')
                ->color('success'),

                RepeatableEntry::make('missions')
                ->schema([
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


                ])->columns(4),


                           ]);
                     // ->statePath('users')
                 // ->model(auth()->users())

    }
    public function clearState(): void {
        $this->state(null);
    }


};



