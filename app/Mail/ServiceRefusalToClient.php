<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Service;
use App\Models\Partenaire;

class ServiceRefusalToClient extends Mailable
{
    use Queueable, SerializesModels;

    public $service;
    public $partner;

    public function __construct(Service $service, Partenaire $partner)
    {
        $this->service = $service;
        $this->partner = $partner;
    }

    public function build()
    {
        return $this->subject('Service Refusal Notification')
                    ->view('emails.serviceRefusalToClient')
                    ->with([
                        'metier' => $this->partner->metier,
                        'expert_name' => $this->partner->nom . ' ' . $this->partner->prenom
                    ]);
    }
}
