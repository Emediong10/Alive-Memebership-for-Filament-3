<?php

namespace App\Helpers;

use App\Models\Payment; // Ensure your Payment model namespace is correct
use Illuminate\Support\Facades\Auth;

class MessageHelper
{
    /**
     * Determine if the rolling message should be displayed.
     *
     * @return bool
     */
    public static function shouldDisplayMessage(): bool
    {
        $today = now();
        $startOfPeriod = $today->copy()->startOfMonth()->addDays(19); // 15th of the month
        $endOfPeriod = $today->copy()->startOfMonth()->addDays(32); // 30th of the month

        // Check if today is within the range
        if ($today->between($startOfPeriod, $endOfPeriod)) {
            $userId = Auth::id(); // Get the currently authenticated user ID

            // Check if the user has made a payment within the range
            $paymentExists = Payment::where('user_id', $userId)
                ->whereBetween('created_at', [$startOfPeriod, $endOfPeriod])
                ->exists();

            return !$paymentExists; 
        }

        return false;
    }
}
