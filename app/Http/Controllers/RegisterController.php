<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|max:255',
            'role' => 'required|string|in:client,provider',
        ]);

        // Création d'un nouvel utilisateur
        if ($request->role === 'client') {
            $user = new Client();
        } elseif ($request->role === 'provider') {
            $user = new Partenaire();
        }

        if ($user) {
            $user->nom = $request->firstName; // Utilisez 'nom' pour les clients et les partenaires
            $user->prenom = $request->lastName; // Utilisez 'prenom' pour les clients et les partenaires
            $user->telephone = $request->phone; // Utilisez 'telephone' pour les clients
            $user->num_telephone = $request->phone; // Utilisez 'num_telephone' pour les partenaires
            $user->adresse = $request->address; // Utilisez 'adresse' pour les clients et les partenaires
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Redirection vers une page de confirmation ou de connexion
        return redirect()->route('login')->with('success', 'Votre inscription a été réussie. Veuillez vous connecter.');
    }
}
