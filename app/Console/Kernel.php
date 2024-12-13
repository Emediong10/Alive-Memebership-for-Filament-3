<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Prune outdated Filament Comments daily
        $schedule->command('model:prune', [
            '--model' => [\Parallax\FilamentComments\Models\FilamentComment::class],
        ])->daily();

        // Send birthday emails daily at 7:00 AM
        $schedule->call(function () {
            // Get users whose birthday matches today's day and month
            $users = \App\Models\User::whereRaw("DATE_FORMAT(dob, '%d-%m') = ?", [now()->format('d-m')])->get();

            foreach ($users as $user) {
                // Check if today is the user's birthday
                if ($this->isBirthday($user->dob)) {
                    // Send the birthday email
                    Mail::to($user->email)->send(new \App\Mail\Birthdays($user));
                    // Log that the birthday email has been sent
                    \Log::info("Birthday email sent to {$user->email}");
                }
            }
        })->everySecond();  // Use everyMinute() for testing, can change to daily later
    }

    /**
     * Check if today is the user's birthday.
     *
     * @param string|null $dob
     * @return bool
     */
    private function isBirthday($dob): bool
    {
        return $dob && Carbon::parse($dob)->isBirthday();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
