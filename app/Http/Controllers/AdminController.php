<?php

namespace App\Http\Controllers;

use App\Models\Partenaire; //Importer le modèle Partenaire
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Commentaire;
use App\Models\Creneau;
use Illuminate\Support\Facades\Hash;
use App\Models\CommentaireClient;
use App\Models\CommentairePartenaire;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashbordadmin()
    {
        $partners = Partenaire::all(); // Récupérer tous les partenaires depuis la base de données
        return view('dashbordadmin', ['partners' => $partners]); // Passer les partenaires à la vue
    }
    
    public function destroy($id)
{
    DB::beginTransaction();
    try {
        // Supprimer les enregistrements liés dans 'services'
        Service::where('partenaire_id', $id)->delete();
        // Supprimer les enregistrements liés dans 'commentaires' des clients et des partenaires
        CommentaireClient::where('id_partenaire', $id)->delete();
        CommentairePartenaire::where('id_partenaire', $id)->delete();
        // Supprimer les créneaux associés au partenaire
        Creneau::where('id_partenaire', $id)->delete();

        // Récupérer l'instance du partenaire pour obtenir l'ID utilisateur
        $partenaire = Partenaire::findOrFail($id);
        $userId = $partenaire->id_user;  // Récupérer l'ID de l'utilisateur associé

        // Supprimer le partenaire
        $partenaire->delete();

        // Supprimer l'utilisateur associé
        User::findOrFail($userId)->delete();

        DB::commit();
        // Rediriger vers la page dashbordadmin avec un message de succès
        return redirect()->route('dashbordadmin')->with('message', 'Partenaire supprimé avec succès.');
    } catch (\Exception $e) {
        DB::rollBack();
        // Rediriger vers la page dashbordadmin avec un message d'erreur
        return redirect()->route('dashbordadmin')->with('error', "Erreur lors de la suppression du partenaire et de l'utilisateur: {$e->getMessage()}");
    }
}

    
    
        public function confirmDeletePartenaire($id)
        {
            $partenaire = partenaire::findOrFail($id);
            return view('confirm-delete-partenaire', compact('partenaire'));  // Modifiez le chemin ici
        }
    
        public function AddPartenaire(Request $request)
        {
            $random_id = mt_rand(100000, 999999);
            $user = new User();
            $user->id = $random_id;
            $user->name = $request->firstName;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->type = 2;
            $user->save();

            $partenaire = new Partenaire();
            $partenaire->nom = $request->firstName;
            $partenaire->prenom = $request->lastName;
            $partenaire->num_telephone = $request->phone;
            $partenaire->adresse = $request->address;
            $partenaire->metier = $request->category;
            $partenaire->description = $request->description;
            $partenaire->ville = $request->city;
            $partenaire->annees_exp = $request->annees_exp;
            $partenaire->moy_evaluation = 0;
            $partenaire->disponibilite = 1;
            $partenaire->prix_intervention = $request->prix_intervention;
            $partenaire->cin = $request->cin;
            // Gérez le téléchargement de l'image
            if ($request->hasFile('profil_picture')) {
                $image = $request->file('profil_picture');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('img'), $imageName);
                $partenaire->profil_picture = "img/" . $imageName;
            }            
            $partenaire->id_user = $random_id;
            $partenaire->save();

            foreach ($request->jours as $jour) {
                foreach ($request->heures as $heure) {
                    $creneau = new Creneau();
                    $creneau->id_partenaire = $random_id;
                    $creneau->jour = $jour;
                    $creneau->creneau = $heure;
                    $creneau->categorie = $request->input('category');  // default_category is a placeholder
    
                    $creneau->save();
                }
            }
            return redirect('login');
        }

}

