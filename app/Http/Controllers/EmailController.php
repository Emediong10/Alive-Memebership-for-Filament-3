<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendWelcomeEmail()
    {
        // Define the recipient, subject, and message
        $toEmail = 'beemediong1@gmail.com';
        $mailMessage = 'Welcome to programming. God bless you!';
        $subject = 'Welcome to our testing Email';

        try {
            // Send the email
            Mail::to($toEmail)->send(new WelcomeEmail($mailMessage, $subject));

            // Flash a success message to the session
            session()->flash('status', 'Email sent successfully.');

            // Redirect to a specific route (you might need to adjust this to your needs)
            return redirect()->route('home');
        } catch (\Exception $e) {
            // Flash an error message to the session
            session()->flash('error', 'Failed to send email. Please try again later.');

            // Redirect back to the previous page or a specific route
            return redirect()->back();
        }
    }

}
