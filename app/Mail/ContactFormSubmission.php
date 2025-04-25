<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;

    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to(config('mail.from.address'))
            ->subject('Yeni Əlaqə Formu Göndərilişi')
            ->view('emails.contact_email');
    }
}
