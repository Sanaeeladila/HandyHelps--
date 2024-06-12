<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentaireClient; // Assure-toi que le chemin vers le modèle est correct
use App\Models\CommentairePartenaire;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentDeletedNotification;
use App\Mail\ClientCommentDeleted;

class AdminCommentaireController extends Controller
{
    /**
     * Display the client comments with related client, partner, and service information.
     *
     * @return \Illuminate\Http\Response
     */
    public function showClientsComments()
{
    $commentaires = CommentaireClient::with(['client', 'partenaire', 'service'])->get();
    return view('admincommentaireclients', ['commentaires' => $commentaires]);
}

    public function showPartnersComments()
    {
        $commentaires = CommentairePartenaire::with(['client', 'partenaire', 'service'])->get();
        return view('admincommentairepartenaires', ['commentaires' => $commentaires]);
    }

    public function destroy($id)
    {
        $commentaire = \App\Models\CommentaireClient::with(['client.user', 'partenaire'])->findOrFail($id);
        $email = $commentaire->client->user->email;  // Email du client
        $partnerName = $commentaire->partenaire->nom . ' ' . $commentaire->partenaire->prenom;  // Nom complet du partenaire
    
        Mail::to($email)->send(new ClientCommentDeleted($partnerName));
    
        $commentaire->delete();
    
        return redirect()->route('admincommentaireclients');
    }

    public function destroyPartenaire($id)
{
    $commentaire = \App\Models\CommentairePartenaire::with(['partenaire.user', 'client'])->findOrFail($id);
    $email = $commentaire->partenaire->user->email;  // Email du partenaire
    $clientName = $commentaire->client->nom . ' ' . $commentaire->client->prenom;  // Nom complet du client

    // Suppression du commentaire
    $commentaire->delete();

    // Envoi de l'email
    Mail::to($email)->send(new CommentDeletedNotification($clientName));

    return redirect()->route('admincommentairepartenaires');
}

    

}
