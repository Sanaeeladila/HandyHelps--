<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientCommentDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $partnerName; // Nom du partenaire

    public function __construct($partnerName)
    {
        $this->partnerName = $partnerName;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Notification de Suppression de Commentaire')
                    ->view('emails.clientCommentDeleted')
                    ->with([
                        'partnerName' => $this->partnerName,
                    ]);
    }
}
