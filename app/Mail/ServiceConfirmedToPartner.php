<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Service;
use App\Models\Client;
use App\Models\Partenaire;

class ServiceConfirmedToPartner extends Mailable
{
    use Queueable, SerializesModels;

    public $service;
    public $client;
    public $partner;

    /**
     * Create a new message instance.
     *
     * @param Service $service
     * @param Client $client
     * @param Partenaire $partner
     */
    public function __construct(Service $service, Client $client, Partenaire $partner)
    {
        $this->service = $service;
        $this->client = $client;
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
                    ->view('emails.serviceConfirmedToPartner')
                    ->with([
                        'metier' => $this->partner->metier,
                        'client_name' => $this->client->nom . ' ' . $this->client->prenom,
                        'client_phone' => $this->client->telephone,
                        'client_address' => $this->client->adresse
                    ]);
    }
}
