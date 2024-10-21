<?php

namespace App\Mail;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $Email;

    public function __construct(Email $Email)
    {
        $this->Email = $Email;
    }

    public function build()
    {
        return $this->view('emails.email');
    }

}
