<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Partenaire;
use App\Models\Service;

class RequestSentToClient extends Mailable
{
    use Queueable, SerializesModels;

    public $partenaire;
    public $service;

    public function __construct(Partenaire $partenaire, Service $service)
    {
        $this->partenaire = $partenaire;
        $this->service = $service;
    }

    public function build()
    {
        return $this->subject('Your Service Request is Confirmed')
                    ->view('emails.requestSentToClient')
                    ->with([
                        'partner' => $this->partenaire,
                        'service' => $this->service,
                    ]);
    }
}

