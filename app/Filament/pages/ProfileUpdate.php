<?php

namespace App\Filament\Users\Pages;
use App\Models\User;
use App\Models\Skill;
use App\Models\Mission;
use Filament\Pages\Page;
use App\Models\AreaInterest;
use App\Models\SpiritualGift;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Redirect;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
//use Filament\Pages\Page;

// class ProfileUpdate extends Page
// {
//     protected static ?string $navigationIcon = 'heroicon-o-document-text';

//     protected static string $view = 'filament.users.pages.profile-update';
// }


class ProfileUpdate extends Page implements HasForms
{
    use InteractsWithForms;

    public function mount(): void
    {
        $user = auth()->user()->id;
        $this->user_id = $user;
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

   protected static string $view = 'filament.users.pages.profile-update';
 
    //...
 
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
 public $course_of_study;
public $professional_abilities;
public $mission_id;
public $area_interest_id;
public $spiritual_gift_id;
public $skill_id;
public $occupation;
public $degree;
public $name = [];
   
 
protected function getFormSchema(): array{
    return[
        Card::make()->schema([
            TextInput::make('course_of_study')
            ->label('Course of study')
            ->required(),
           // ->rules('strings'),
            TextInput::make('degree')
            ->label('Enter your degree')
            ->required(),
           // ->rules('strings'),
            TextInput::make('occupation')
            ->label('Occupation')
            ->required(),
           // ->rules('strings'),
           TextInput::make('professional_abilities')
            ->label('Professional_abilities')
            ->required(),
            //->rules('strings'),

        Select::make('mission_id')
        ->label('Missions Attended')
        ->options(Mission::all()->pluck('name', 'id'))
        ->searchable()
        ->multiple()
        ->required()
        ->preload(),

        Select::make('spiritual_gift_id')
        ->label('What gifts have you noticed the Lord has endowed you with? Your top 3 ')
        ->options(SpiritualGift::all()->pluck('name', 'id'))
        ->multiple()
        ->required()
        ->searchable(),
        Select::make('area_interest_id')
        ->label('Area of interest in ministry (You can choose more than 1 option)')
        ->options(AreaInterest::all()->pluck('name', 'id'))
        ->searchable()
        ->multiple()
        ->preload(),

        Select::make('skill_id')
        ->label('Select Your talents or special Skills the Lord has blessed you with')
        ->options(Skill::all()->pluck('name', 'id'))
        ->searchable()
        ->multiple(),
        ])->columns(2),

    ];

}
public function update()
{
    auth()->user()->update(
        $this->form->getState()
    );
}

public function submit()
    {
    // dd($this->form->getState());
        $data = $this->form->getState();
        $mission_id = $data['mission_id'];
        $spiritual_gift = $data['spiritual_gift_id'];
        $spiritual_gift = $data['area_interest_id'];
        $spiritual_gift = $data['skill_id'];
       // Skill::DB::table('users');
        $user = User::where('id',auth()->user()->id)->first();
        $user ->course_of_study =  $data['course_of_study'];
        $user -> degree = $data['degree'];
        $user -> occupation = $data['occupation'];
        $user -> professional_abilities = $data['professional_abilities'];
        $user -> mission_id = $data['mission_id'];
        $user -> area_interest_id = $data['area_interest_id'];
        $user -> spiritual_gift_id = $data['spiritual_gift_id'];
        $user -> skill_id = $data['skill_id'];
         $user->update(); 
         User::Where('id', auth()->user()->id)->update(['status' => 1]);
     
     Notification::make()
     ->success()
     ->title('Successful')
     ->body('You have successfully updated your profile')
     ->send();

     return Redirect::to('users/Dashbord');

 }
}