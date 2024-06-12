<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Service;
use App\Models\Partenaire;

class ServiceConfirmedToClient extends Mailable
{
    use Queueable, SerializesModels;

    public $service;
    public $partner;

    /**
     * Create a new message instance.
     *
     * @param Service $service
     * @param Partenaire $partner
     */
    public function __construct(Service $service, Partenaire $partner)
    {
        $this->service = $service;
        $this->partner = $partner;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Service Confirmation')
                    ->view('emails.serviceConfirmedToClient')
                    ->with([
                        'metier' => $this->partner->metier,
                        'expert_name' => $this->partner->nom . ' ' . $this->partner->prenom
                    ]);
    }
}
