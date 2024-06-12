<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\CommentaireClient;
use App\Models\CommentairePartenaire;

use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function adminclient()  // Assurez-vous que la méthode s'appelle 'adminclient'
    {
        $clients = Client::all(); // Récupère tous les clients de la base de données
        return view('adminclient', ['clients' => $clients]); // Envoie les données à la vue
    }

    public function destroy($id)
{
    DB::beginTransaction();
    try {
        // Supprimer les enregistrements liés dans 'services'
        Service::where('client_id', $id)->delete();

        // Supprimer les enregistrements liés dans 'commentaires' des clients et partenaires
        CommentaireClient::where('id_client', $id)->delete();
        CommentairePartenaire::where('id_client', $id)->delete();

        // Récupérer l'instance du client pour obtenir l'ID utilisateur
        $client = Client::findOrFail($id);
        $userId = $client->id_user;  // Récupérer l'ID de l'utilisateur associé

        // Supprimer le client
        $client->delete();

        // Supprimer l'utilisateur associé
        User::findOrFail($userId)->delete();

        DB::commit();
        // Redirigez vers la page adminclient avec un message de succès
        return redirect()->route('adminclient')->with('message', 'Client supprimé avec succès.');
    } catch (\Exception $e) {
        DB::rollBack();
        // Redirigez vers la page adminclient avec un message d'erreur
        return redirect()->route('adminclient')->with('error', "Erreur lors de la suppression du client et de l'utilisateur: {$e->getMessage()}");
    }
}


    public function confirmDeleteClient($id)
    {
        $client = Client::findOrFail($id);
        return view('confirm-delete-client', compact('client'));  // Modifiez le chemin ici
    }
    
    public function AddClient(Request $request)
    {
        $random_id = mt_rand(100000, 999999);
        $user = new User();
        $user->id = $random_id;
        $user->name = $request->firstName;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = 1;
        $user->save();

        $client = new Client();
        $client->nom = $request->firstName;
        $client->prenom = $request->lastName;
        //$client->email = $request->email;
        $client->telephone = $request->phone;
        $client->adresse = $request->address;
        $client->id_user = $random_id;
        $client->save();
        return redirect('login');
    }

   
    public function update(Request $request)
    {
        $user = \App\Models\User::find(Auth::id());

        // Mettre à jour les informations de l'utilisateur
        $user->name = $request->input('firstName');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Récupérer le profil client associé à l'utilisateur
        $client = $user->client;

        // Mettre à jour les informations du profil client
        $client->nom = $request->input('firstName');
        $client->prenom = $request->input('lastName');
        $client->telephone = $request->input('phone');
        $client->adresse = $request->input('address');
        $client->save();

        // Rediriger avec un message de succès
        return redirect()->back();
    }
}