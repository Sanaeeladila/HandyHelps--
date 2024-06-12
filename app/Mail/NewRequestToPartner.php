<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Partenaire;
use App\Models\Client;

class NewRequestToPartner extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $service;

    public function __construct(Client $client, $service)
    {
        $this->client = $client;
        $this->service = $service;
    }

    public function build()
    {
        return $this->subject('New Service Request')
                    ->view('emails.newRequestToPartner')
                    ->with([
                        'clientName' => $this->client->prenom . ' ' . $this->client->nom,
                        'serviceCategory' => $this->service->categorie,
                    ]);
    }
}
