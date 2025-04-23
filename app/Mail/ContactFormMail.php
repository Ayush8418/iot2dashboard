<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;

    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->subject('New Contact Form Submission')
                    ->view('emails.contact')
                    ->with([
                        'name' => $this->formData['name'],
                        'service' => $this->formData['service'],
                        'emailAddress' => $this->formData['email'],
                        'userMessage' => $this->formData['message'],
                    ]);
    }
}
