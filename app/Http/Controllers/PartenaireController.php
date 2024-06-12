<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\User;
use App\Models\Creneau;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    public function update(Request $request)
    {
        // Récupérer l'utilisateur authentifié
        $user = User::find(Auth::id());

        // Mettre à jour les informations de l'utilisateur
        $user->name = $request->input('firstName');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Récupérer le profil partenaire associé à l'utilisateur
        $partenaire = $user->partenaire;

        // Mettre à jour les informations du profil partenaire
        $partenaire->nom = $request->input('firstName');
        $partenaire->prenom = $request->input('lastName');
        $partenaire->cin = $request->input('cin');
        $partenaire->num_telephone = $request->input('phone');
        $partenaire->adresse = $request->input('address');
        $partenaire->metier = $request->input('category');
        $partenaire->ville = $request->input('city');
        $partenaire->annees_exp = $request->input('annees_exp');
        $partenaire->prix_intervention = $request->input('prix_intervention');
        $partenaire->description = $request->input('description');

        if ($request->hasFile('profil_picture')) {
            $image = $request->file('profil_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $partenaire->profil_picture = "img/" . $imageName;
        }

        // Supprimer tous les créneaux existants avec le statut 'disponible' pour ce partenaire
        Creneau::where('id_partenaire', $user->id)->where('status', 'disponible')->delete();

        // Enregistrer les nouveaux créneaux pour le partenaire
        if ($request->has('jours') && $request->has('heures')) {
            foreach ($request->jours as $jour) {
                foreach ($request->heures as $heure) {
                    // Vérifier si un créneau existe pour ce partenaire, ce jour, cette heure et cette catégorie
                    $existingCreneau = Creneau::where('id_partenaire', $user->id)
                        ->where('jour', $jour)
                        ->where('creneau', $heure)
                        ->where('categorie', $request->input('category'))
                        ->first();

                    if ($existingCreneau) {
                        // Si le créneau existe et est réservé, ne rien faire
                        if ($existingCreneau->status === 'réservé') {
                            continue 2;
                        } else {
                            // Si le créneau existe et est disponible, le supprimer
                            $existingCreneau->delete();
                        }
                    }

                    // Ajouter le nouveau créneau
                    $creneau = new Creneau();
                    $creneau->id_partenaire = $user->id;
                    $creneau->jour = $jour;
                    $creneau->creneau = $heure;
                    $creneau->categorie = $request->input('category');
                    $creneau->status = 'disponible'; // Valeur par défaut
                    $creneau->save();
                }
            }
        }

        // Sauvegarder les modifications du profil partenaire
        $partenaire->save();

        // Rediriger avec un message de succès et l'ID de l'utilisateur
        return redirect()->route('partenaire-profile', ['id_user' => $user->id]);
    }
}