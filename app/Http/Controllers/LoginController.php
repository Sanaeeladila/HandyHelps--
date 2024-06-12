<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Vérifier le type d'utilisateur et rediriger en conséquence
            if(Auth::user()->type === 2) {
                // Redirection vers le tableau de bord spécifique du partenaire en utilisant son ID
                return redirect()->route('dashbordPartenaire', ['id_user' => Auth::user()->id]);
            } elseif(Auth::user()->type === 3) {
                return redirect()->route('dashbordadmin');
            } else {
                return redirect()->route('dashbordClient', ['id_user' => Auth::user()->id]);
                
            }
        } else {
            return back()->withErrors([
                'email' => 'Erreur! Identifiants de connexion invalides.'
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        // Vérifier si un utilisateur est authentifié
        if (Auth::check()) {
            $userType = Auth::user()->type;

            // Déconnexion de l'utilisateur
            Auth::logout();

            // Redirection en fonction du type d'utilisateur
            if ($userType === 2) {
                // Redirection vers la page de connexion des partenaires
                return redirect('/login');
            } elseif ($userType === 3) {
                // Redirection vers la page de connexion des administrateurs
                return redirect('/login');
            } else {
                // Redirection vers la page de connexion des clients
                return redirect('/login');
            }
        } 
    }
}

?>
