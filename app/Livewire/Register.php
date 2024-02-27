<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Chapter;
use App\Models\Application;
use Livewire\Component;

class Register extends Component
{
    public $chapters,$user;
    public $currentStep = 1;
    public $firstname, $middlename, $lastname, $email,$dob,$gender, $phone, $chapter,$status = 1;
    public $successMsg = '', $monthly_outreach, $outreach, $outreach_experience, $christian_standard, $professional, $attended_mission, $good_standing_adventist;
    public  $will_support, $have_supported, $show_outreach=false, $show_monthly_amount=false, $monthly_support, $monthly_amount, $currency, $password, $confirm_password, $Chapter;


    public function render()
    {
        $this->chapters = Chapter::where('active',1)->get();
        //dd($this->chapters);
        return view('livewire.register');
    }


    public function firstStepSubmit()
    {
         $this->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'phone'=>'required|unique:users,phone',
            'gender' => 'required',
            'chapter' => 'required',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required|unique:users,phone',
         ]);
        //  dd($this->phone);
      

        // $this->successMsg = "Saved";
        $this->currentStep = 2;
    }


    public function skip($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        $this->validate([
            'monthly_outreach' => 'required',
        
                'christian_standard'=>'required',
                'attended_mission'=>'required',
                'professional'=>'required',
                'will_support'=>'required',
               
            ]);
        
            
        //    dd(json_encode($answers));
    

        //$this->successMsg = "Saved";
        $this->currentStep = 3;

    }

    public function thirdStepSubmit()
    {
        $this->validate([
            'monthly_support' => 'required',
        ]);

        if($this->monthly_support == 'yes')
        {
             $this->validate([
                 'monthly_amount' => 'required',
                'currency'=>'required',
            ]);
        }
   if($this->monthly_amount >='1000') 
   {
         $this->validate([
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password'
         ]);
             } 
         
        $answers=[
            
            'monthly_outreach'=>$this->monthly_outreach,
            'professional'=> $this->professional,
            'attended_mission'=> $this->attended_mission,
            'christian_standard'=> $this->christian_standard,
            'will_support'=> $this->will_support,
            'monthly_support'=> $this->monthly_support,
            'monthly_amount'=> $this->monthly_amount,
            'currency'=> $this->currency
        ];

        


        
        $user = User::create([
            'firstname'=>$this->firstname,
            'middlename'=>$this->middlename,
            'lastname'=>$this->lastname,
            'gender'=>$this->gender,
            'dob'=>$this->dob,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'chapter_id'=>$this->chapter,
            'password' =>\Hash::make($this->password),
            
          User::where('id')->update([
            //
        ])
    ]);


        
        Application::create([
            // 'answers'=>json_encode($answers),
            // 'user_id'=>3,
            'answers'=>[$answers],
            'user_id'=>$user->id,
            'status'=>0
           ]);
           

          // dd($answers);
          if (
            ($answers['monthly_outreach'] === "yes" || $answers['monthly_outreach'] === "no") &&
            ($answers['professional'] === "yes" || $answers['professional'] === "no") &&
            $answers['will_support'] === "10k" &&
            ($answers['christian_standard'] === "yes" || $answers['christian_standard'] === "yes") &&
            ($answers['attended_mission'] === "yes" || $answers['attended_mission'] === "no") &&
            $answers['monthly_support'] === "yes" &&
            (($answers['currency'] === "NGN" || $answers['currency'] === "USD") && $answers['monthly_amount'] >= 10000)
        ) {
            $user->assignRole('financial');
            $user->member_type_id = 2;
            $this->successMsg = "Thank you for registering as a Financial Member with ALIVE-Nigeria for 2024. Let’s continually raise the banner of Christ higher. Maranatha!";
            $user->update();
        } elseif (
            $answers['monthly_outreach'] === "yes" &&
            $answers['professional'] === "yes" &&
            
                ($answers['will_support'] === "1k-5k" || $answers['will_support'] === "6k-9k") &&
                $answers['christian_standard'] === "yes" &&
                $answers['attended_mission'] === "yes" &&
                $answers['monthly_support'] === "yes" &&
                ($answers['currency'] === "NGN" || $answers['currency'] === "USD") &&
                $answers['monthly_amount'] <= 9999
            
        ) {
            $user->assignRole('member');
            $user->member_type_id = 5;
            $this->successMsg = "Thank you for registering as an Outreach Member with ALIVE-Nigeria for 2024. Let’s continually raise the banner of Christ higher. Maranatha!";
            $user->update();
        }
         else {
            $user->assignRole('volunteer');
            $user->member_type_id = 3;
            $this->successMsg = "Thank you for registering as a Volunteer Member with ALIVE-Nigeria for 2024. Let’s continually raise the banner of Christ higher. Maranatha!";
            $user->update();
        }
        
        
       // dd($answers);

        $this->currentStep = 4;
        // $this->reset();

    }

    /**
     * Write code on Method
     */
    public function submitForm()
    {
     
       // session()->flash('success_message',$this->successMsg);
       
        
    }
    /**
     * Write code on Method
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     */
    public function clearForm()
    {

    }
}
