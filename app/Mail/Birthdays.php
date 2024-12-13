<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Birthdays extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Happy Birthday!')
                    ->view('mails.birthdays')
                    ->with([
                        'name' => $this->user->name,
                        'email' => $this->user->email,
                        'dob' => $this->user->date_of_birth,
                    ]);
    }

    /**
     * Get the message envelope.
     */
//     public function envelope(): Envelope
//     {
//         return new Envelope(
//             from: new Address('basseyEmediong@gmail.com'),
//             replyTo: [
//                 new Address('basseyemediong20@gmail.com.com' ),
//             ],
//             subject: 'Happy birthday to you',
// );
//     }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.birthdays', // Use the correct email template.
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
