<?php

namespace App\Mail;

use App\Models\Inscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InscriptionCreated extends Mailable
{
    use Queueable;
    use SerializesModels;

    public Inscription $inscription;

    /**
     * Create a new message instance.
     */
    public function __construct(Inscription $inscription)
    {
        $this->inscription = $inscription;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject('Confirmación de inscripción')
            ->view('emails.inscription_created');
    }
}
