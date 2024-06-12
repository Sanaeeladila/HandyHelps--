<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentDeletedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;

    public function __construct($clientName)
    {
        $this->clientName = $clientName;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Notification de Suppression de Commentaire')
                    ->view('emails.commentDeleted');
    }
}
