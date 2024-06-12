<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use App\Models\Client; // Corrected model import
    use App\Models\Service; // Corrected model import
    use App\Models\Partenaire; // Corrected model import
    use App\Models\Commentaire_Client; // Corrected model import
    use App\Models\Commentaire_Partenaire; // Corrected model import
    use Carbon\Carbon; // Import Carbon for date manipulation
    use Illuminate\Support\Facades\Mail; // Import Mail facade
    use App\Mail\NewRequestToPartner; // Import the Mailable class for sending email to partner
    use App\Mail\RequestSentToClient; // Import the Mailable class for sending email to client
    use Illuminate\Support\Facades\Log; // Import Log facade

    

    class DashboardClientController extends Controller
    {
       
        public function index($id_user)
{
    $client = Client::where('id_user', $id_user)->first();

    if (!$client) {
        return redirect()->route('home')->with('error', 'Client not found.');
    }

    $client_id = $client->id;
    $partnersByCategory = $this->displayPartnersByCategory();
    $services = $this->displayServices($id_user);
    $servicesToReview = $this->displayServicesToReview($id_user);
    $comments = $this->showCommentaire($id_user);
    $ignoredServices = $this->displayIgnoredServices($id_user);  // Fetch ignored services

    return view('dashbordClient', [
        'client_id' => $client_id,
        'client' => $client,
        'partnersByCategory' => $partnersByCategory,
        'services' => $services,
        'servicesToReview' => $servicesToReview,
        'comments' => $comments,
        'ignoredServices' => $ignoredServices  // Pass this to the view
    ]);
}


        public function showClientExperts($id_user) {
            $client = Client::where('id_user', $id_user)->first();
            if (!$client) {
                // Handle the error, such as redirecting or showing an error message
                return redirect()->route('home')->with('error', 'No client found.');
            }

            // Assuming you have a method to get partners by category
            $partnersByCategory = $this->displayPartnersByCategory();

            return view('client-experts', [
                'client' => $client,
                'partnersByCategory' => $partnersByCategory  // Ensure this variable is being passed
            ]);
        }


        public function profile($id_user)
        {
            $client = Client::where('id_user', $id_user)->first();
            if (!$client) {
                return redirect()->route('home')->with('error', 'Client not found');
            }
            return view('client-profile', compact('client'));
        }

        public function requests($id_user)
{
    $client = Client::where('id_user', $id_user)->first();
    if (!$client) {
        return redirect()->route('home')->with('error', 'Client not found');
    }

    $services = $this->displayServices($id_user);
    $comments = $this->showCommentaire($id_user);
    $ignoredServices = $this->displayIgnoredServices($id_user);  // Fetch ignored services

    return view('client-requests', [
        'client' => $client,
        'services' => $services,
        'comments' => $comments,
        'ignoredServices' => $ignoredServices  // Pass this to the view
    ]);
}


        public function confirmService(Request $request)
        {
            $client = Client::find($request->client_id);
            $partenaire = Partenaire::find($request->partenaire_id);
            $service = Service::find($request->service_id);

            // Send email to partner
            Mail::to($partenaire->email)->send(new NewRequestToPartner($client, $service));

            // Send email to client
            Mail::to($client->email)->send(new RequestSentToClient($partenaire, $service));

            return redirect()->route('some.route')->with('success', 'Service request confirmed and emails sent.');
        }



        public function displayPartnersByCategory() {
            // Récupérer toutes les catégories de métiers disponibles
            $categories = Partenaire::select('metier')->distinct()->get();

            // Pour chaque catégorie, récupérer les partenaires qui lui sont associés
            $partnersByCategory = [];
            foreach ($categories as $category) {
                // Récupérer les partenaires qui ont ce métier
                $partners = Partenaire::where('metier', $category->metier)->get();
                $partnersByCategory[$category->metier] = $partners;
            }
            return $partnersByCategory; // Return the array of partners by category
        }


        public function profileDetails($partnerId)
        {
            // Récupérer les détails du partenaire avec l'ID donné
            $partner = Partenaire::findOrFail($partnerId);
            // Initialiser la variable des commentaires
            $comments = [];
            // Vérifier si le partenaire a été trouvé
            if ($partner) {
                // Récupérer les commentaires des services du partenaire depuis la table Commentaire_Client
                $comments = Commentaire_Client::where('id_client', $partner->id)
                    ->where('commentaire_partenaire', 0) // Filtre pour les commentaires non encore ajoutés
                    ->whereDate('date_service', '>', now()->subDays(7)) // Commentaires ajoutés au cours des 7 derniers jours
                    ->get();
            }
            // Passer les détails du partenaire et les commentaires à la vue
            return view('profile_details', compact('partner', 'comments'));
        }



        public function displayServices($id_user)
        {
            // Récupérer le client associé à cet ID utilisateur
            $client = Client::where('id_user', $id_user)->first();
            // Vérifier si le client existe et s'il a des services en attente
            if ($client) {
                $services = $client->services()->where('statut', 'en attente')->get();
            } else {
                // Si le client n'existe pas, ou s'il n'a pas de services en attente, retourner une collection vide
                $services = collect();
            }
            // Retourner les services à la vue correspondante
            return $services;
        }


        
        public function displayServicesToReview($id_user)
        {
            $client = Client::where('id_user', $id_user)->first();
            if ($client) {
                $servicesToReview = $client->services()
                    ->where('statut', 'valide')
                    ->where('commentaire_client', 0)
                    ->whereDate('date_service', '>', now()->subDays(7))
                    ->get();
            } else {
                $servicesToReview = collect();
            }
            return $servicesToReview;
        }

        public function displayIgnoredServices($id_user)
{
    $client = Client::where('id_user', $id_user)->first();
    if ($client) {
        $ignoredServices = $client->services()->where('statut', 'ignorer')->get();
        Log::info('Ignored Services Count: ' . $ignoredServices->count());
        return $ignoredServices;
    } else {
        return collect();
    }
}



        public function commenter(Request $request, $service_id)
        {
            $service = Service::findOrFail($service_id);
            // Récupérer la date actuelle
            $currentDate = Carbon::now();
            

            // Check if the service date is within the last 7 days
            if (Carbon::parse($service->date_service)->diffInDays($currentDate) > 7) {
                // If more than 7 days have passed, redirect back with an error message
                return redirect()->back()->with('error', 'The commenting period for this service has expired.');
            }

            // Proceed with commenting logic if within 7 days
            if($service->commentaire_partenaire == 0) {
                $service->commentaire_client = 1;
                $service->save();

                $commentaire_client = new Commentaire_Client();
                $commentaire_client->id_client = $service->client_id;
                $commentaire_client->id_service = $service->id;
                $commentaire_client->id_partenaire = $service->partenaire_id;
                $commentaire_client->commentaire = $request->input('commentaire');
                $commentaire_client->rating = $request->input('rating');
                $commentaire_client->date = now(); // Date actuelle
                $commentaire_client->date_service = $service->date_service;
                $commentaire_client->commentaire_partenaire  = 0; // Mettre à 0 pour indiquer que c'est un commentaire de partenaire
                // Enregistrer le commentaire dans la base de données
                $commentaire_client->save();
            } else 
            {
                Commentaire_Partenaire::where('id_client', $service->client_id)
                ->where('id_service', $service->id)
                ->where('id_partenaire', $service->partenaire_id)
                ->update(['commentaire_client' => 1]);
                
                $service->commentaire_client = 1;
                $service->save();

                $commentaire_client = new Commentaire_Client();
                $commentaire_client->id_service = $service->id;
                $commentaire_client->id_client = $service->client_id;
                $commentaire_client->id_partenaire = $service->partenaire_id;
                $commentaire_client->commentaire = $request->input('commentaire');
                $commentaire_client->rating = $request->input('rating');
                $commentaire_client->date = now(); // Date actuelle
                $commentaire_client->date_service = $service->date_service;
                $commentaire_client->commentaire_partenaire = 1; // Mettre à 0 pour indiquer que c'est un commentaire de partenaire
                
                // Enregistrer le commentaire dans la base de données
                $commentaire_client->save();
                
            }
                
            return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
        }



        public function comments($id_user)
        {
            $client = Client::where('id_user', $id_user)->first();
            if (!$client) {
                return redirect()->route('home')->with('error', 'Client not found.');
            }

            $servicesToReview = $this->displayServicesToReview($id_user);
            return view('client-comments', [
                'client' => $client,
                'servicesToReview' => $servicesToReview
            ]);
        }


        // public function showCommentaire($id_user)
        // {
        //     // Récupérer l'utilisateur connecté
        //     $client = Client::where('id_user', $id_user)->first();
        //     // Vérifier si le client existe et s'il a des services en attente
        //     if ($client) {
        //         // Récupérer les commentaires des services du client depuis la table CommentairePartenaire
        //         $comments = Commentaire_Partenaire::where('id_client', $client->id)
        //             ->where('commentaire_client', 0) // Filtre pour les commentaires non encore ajoutés
        //             ->whereDate('date', '>', now()->subDays(7)) // Commentaires ajoutés au cours des 7 derniers jours
        //             ->get();
        //     } else {
        //         // Si l'utilisateur n'est pas un client, retourner une collection vide
        //         $comments = collect();
        //     }
        //     return $comments; // Retourner la collection de commentaires
        // }


    public function showCommentaire($id_user)
    {
    // Récupérer l'utilisateur connecté
    $client = Client::where('id_user', $id_user)->first();
    // Vérifier si le client existe et s'il a des services en attente
    if ($client) {
        // Récupérer les commentaires des services du client depuis la table CommentairePartenaire
        $comments = Commentaire_Partenaire::where('id_client', $client->id)
            ->where(function($query) {
                $query->where('commentaire_client', 1) // Cas où commentaire_client = 1
                      ->orWhere(function($query) {
                          $query->where('commentaire_client', 0) // Cas où commentaire_client = 0
                                ->whereDate('date_service', '<', now()->subDays(7)); // et la date > 7 jours
                      });
            })
            ->get();
    } else {
        // Si l'utilisateur n'est pas un client, retourner une collection vide
        $comments = collect();
    }
    return $comments; // Retourner la collection de commentaires
}


        

        
    }

?>