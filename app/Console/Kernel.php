<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Parallax\FilamentComments\Models\FilamentComment;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    // protected function schedule(Schedule $schedule): void
    // {
    //     // $schedule->command('inspire')->hourly();
    // }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('model:prune', [
            '--model' => [FilamentComment::class],
        ])->daily();

        $schedule->call(function () {
            $users = \App\Models\User::all();
    
            foreach ($users as $user) {
                if ($this->isBirthday($user->dob)) {
             \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\BirthdayEmail($user));
                }
            }
    })->daily()->at('07:00');
    }
    
    private function isBirthday($dob)
    {
        return \Carbon\Carbon::parse($dob)->isBirthday();
    }
    

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

   
}
