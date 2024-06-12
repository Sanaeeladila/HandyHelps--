<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use App\Models\Partenaire; // Corrected model import
    use App\Models\Service; // Corrected model import
    use App\Models\Client; // Corrected model import
    use App\Models\Commentaire_Client; // Corrected model import
    use App\Models\Commentaire_Partenaire; // Corrected model import
    use Carbon\Carbon; // Import Carbon for date manipulation
    use Illuminate\Support\Facades\Mail;
    use App\Mail\ServiceConfirmedToPartner;
    use App\Mail\ServiceConfirmedToClient;
    use App\Mail\ServiceRefusalToClient;
    use Illuminate\Support\Facades\Log;



    class DashboardPartenaireController extends Controller
    {
        public function index($id_user)
        {
            $partenaire = Partenaire::where('id_user', $id_user)->first();
            $servicesPartenaire = $this->showServices($id_user);
            $servicesToReview1 = $this->displayServicesToReview1($id_user);
            //$comments = $this->showCommentaire($id_user);

            return view('DashbordPartenaire', [
                'partenaire_id' => $partenaire->id, 
                'partenaire' => $partenaire, 
                'services' => $servicesPartenaire, 
                'servicesToReview1' => $servicesToReview1, 
                // 'comments' => $comments
            ]);

        }


        public function profile($id_user)
        {
            $partenaire = Partenaire::where('id_user', $id_user)->first();
            $user = Auth::user(); // Récupérer l'utilisateur authentifié
            return view('profile-partenaire', compact('partenaire', 'user'));
        }


        public function comments($id_user)
        {
            $partenaire = Partenaire::where('id_user', $id_user)->first();
            $comments = Commentaire_Client::where('id_partenaire', $partenaire->id)->get();
            $servicesToReview1 = $this->displayServicesToReview1($id_user);  // Make sure this is correctly fetching data

            return view('partenaire-comments', [
                'comments' => $comments,
                'partenaire' => $partenaire,
                'servicesToReview1' => $servicesToReview1  // Ensure this variable is being passed
            ]);
        }




        public function interventions($id_user)
        {
            // Récupérer le partenaire à partir de son ID utilisateur
            $partenaire = Partenaire::where('id_user', $id_user)->first();

            // Vérifier si le partenaire existe avant de récupérer ses interventions
            if ($partenaire) {
                // Récupérer les interventions associées à ce partenaire
                $interventions = Service::where('partenaire_id', $partenaire->id)->get();
                
            // Récupérer les commentaires des services du client depuis la table CommentairePartenaire
            $comments = Commentaire_Client::where('id_partenaire', $partenaire->id)
                ->where(function($query) {
                    $query->where('commentaire_partenaire', 1) // Cas où commentaire_client = 1
                        ->orWhere(function($query) {
                            $query->where('commentaire_partenaire', 0) // Cas où commentaire_client = 0
                                    ->whereDate('date_service', '<', now()->subDays(7)); // et la date > 7 jours
                        });
                })
                ->get();
                // Passer les interventions et les commentaires et le partenaire à la vue
                return view('partenaire-interventions', compact('interventions', 'comments', 'partenaire'));
            } else {
                // Si le partenaire n'est pas trouvé, retourner une vue avec un message d'erreur ou rediriger
                $comments = collect();
                return view('error')->with('message', 'Partenaire non trouvé');
            }
        }



        
        
        public function profileDetailsPartenaire($clientId)
        {
            // Récupérer les détails du client avec l'ID donné
            $client = Client::findOrFail($clientId);
            
            // Initialiser la variable des commentaires
            $comments = [];

            // Vérifier si le client a été trouvé
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

            // Passer les détails du client et les commentaires à la vue
            return view('partenaire-details', compact('client', 'comments'));
        }



        public function showServices($id_user)
        {
            $partenaire = Partenaire::where('id_user', $id_user)->first();
            if ($partenaire) {
                // Fetch services where status is 'en attente'
                $servicesPartenaire = $partenaire->services()
                    ->where('statut', 'en attente')
                    ->get();

                // Loop through services to check if the reservation date is more than 2 days ago
                foreach ($servicesPartenaire as $service) {
                    if (Carbon::parse($service->date_reservation)->lt(now()->subDays(2))) {
                        $service->statut = 'ignorer';  // Update status to 'ignorer'
                        $service->save();
                    }
                }

                // Optionally, re-fetch the services list to reflect the updates
                $servicesPartenaire = $partenaire->services()
                    ->where('statut', 'en attente')
                    ->get();
            } else {
                $servicesPartenaire = collect();
            }
            return $servicesPartenaire;
        }



        public function updateServiceStatus(Request $request)
        {
            $serviceId = $request->input('service_id');
            $newStatus = $request->input('new_status');

            // Fetch the service using the provided ID
            $service = Service::findOrFail($serviceId);       
            $client = $service->client;
            $partner = $service->partenaire;

            // Ensure the client and partner have associated user records
            if (!$partner->user || !$client->user) {
                Log::error("Email sending failed: Partner or Client user record is missing.");
                return redirect()->back()->with('error', 'Email cannot be sent because the user record is missing.');
            }

            if ($newStatus == 'valide') {
                $service->statut = $newStatus;
                $service->date_validation = now(); // Set the validation date to the current date
                $service->save();

                // Send email to the partner using user's email
                Mail::to($partner->user->email)->send(new ServiceConfirmedToPartner($service, $client, $partner));

                // Send email to the client using user's email
                Mail::to($client->user->email)->send(new ServiceConfirmedToClient($service, $partner));
            } elseif ($newStatus == 'refuse') {
                $service->statut = $newStatus;
                $service->save();

                // Send email to the client informing about refusal
                Mail::to($client->user->email)->send(new ServiceRefusalToClient($service, $partner));
            }

            return redirect()->back()->with('success', 'Service status updated successfully and emails sent.');
        } 
        

        public function displayServicesToReview1($id_user)
        {
            $partenaire = Partenaire::where('id_user', $id_user)->first();
            if ($partenaire) {
                $servicesToReview = $partenaire->services()
                    ->where('statut', 'valide')
                    ->where('commentaire_partenaire', 0)
                    ->whereDate('date_service', '>', now()->subDays(7))
                    ->get();
            } else {
                $servicesToReview = collect();
            }
            return $servicesToReview;
        }

        
    
        public function commenter(Request $request, $service_id)
        {
            // Trouver le service par son ID
            $service = Service::findOrFail($service_id);
            if ($service->commentaire_partenaire == 0) { 
                $service->commentaire_partenaire = 1;
                $service->save();

                $commentaire_partenaire = new Commentaire_Partenaire();
                $commentaire_partenaire->id_client = $service->client_id;
                $commentaire_partenaire->id_service = $service->id;
                $commentaire_partenaire->id_partenaire = $service->partenaire_id;
                $commentaire_partenaire->commentaire = $request->input('commentaire');
                $commentaire_partenaire->rating = $request->input('rating');
                $commentaire_partenaire->date = now(); // Date actuelle
                $commentaire_partenaire->date_service = $service->date_service;
                $commentaire_partenaire->commentaire_client  = 0; // Mettre à 0 pour indiquer que c'est un commentaire de partenaire
                // Enregistrer le commentaire dans la base de données
                $commentaire_partenaire->save();
            }
            else {
                Commentaire_Client::where('id_partenaire', $service->partenaire_id)
                ->where('id_service', $service->id)
                ->where('id_client', $service->client_id)
                ->update(['commentaire_partenaire' => 1]);

                $service->commentaire_partenaire = 1;
                $service->save();
                
                $commentaire_partenaire = new Commentaire_Partenaire();
                $commentaire_partenaire->id_service = $service->id;
                $commentaire_partenaire->id_client = $service->client_id;
                $commentaire_partenaire->id_partenaire = $service->partenaire_id;
                $commentaire_partenaire->commentaire = $request->input('commentaire');
                $commentaire_partenaire->date = now(); // Date actuelle
                $commentaire_partenaire->date_service = $service->date_service;
                $commentaire_partenaire->commentaire_client = 1; // Mettre à 0 pour indiquer que c'est un commentaire de partenaire
                
                // Enregistrer le commentaire dans la base de données
                $commentaire_partenaire->save();
            }  
            // Rediriger avec un message de succès
            return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');

        }



        // public function showCommentaire($id_user)
        //     {
        //         // Récupérer l'ID du partenaire associé à l'utilisateur connecté
        //         $partenaire = Partenaire::where('id_user', $id_user)->first();

        //         if ($partenaire) {

        //             // Récupérer les commentaires des services du client depuis la table CommentairePartenaire
        //             $comments = Commentaire_Client::where('id_client', $partenaire->id)
        //                 ->where('commentaire_partenaire', 0) // Filtre pour les commentaires non encore ajoutés
        //                 ->whereDate('date', '>', now()->subDays(7)) // Commentaires ajoutés au cours des 7 derniers jours
        //                 ->get();
        //         } else {
        //             // Si l'utilisateur n'est pas un client, retourner une collection vide
        //             $comments = collect();
        //         }

        //         return $comments; // Retourner la collection de commentaires
        //     }

        // public function showCommentaire($id_user)
        // {
        // // Récupérer l'utilisateur connecté
        //  $partenaire = Partenaire::where('id_user', $id_user)->first();
        //  //dd($partenaire);

        // // Vérifier si le client existe et s'il a des services en attente
        // if ($partenaire) {
        //     //dd($partenaire);

        //     // Récupérer les commentaires des services du client depuis la table CommentairePartenaire
        //     $comments = Commentaire_Client::where('id_partenaire', $partenaire->id)
        //         ->where(function($query) {
        //             $query->where('commentaire_partenaire', 1) // Cas où commentaire_client = 1
        //                   ->orWhere(function($query) {
        //                       $query->where('commentaire_partenaire', 0) // Cas où commentaire_client = 0
        //                             ->whereDate('date_service', '<', now()->subDays(7)); // et la date > 7 jours
        //                   });
        //         })
        //         ->get();
        //         //dd($comments);
        // } else {
        //     // Si l'utilisateur n'est pas un client, retourner une collection vide
        //     $comments = collect();
        // }
        // return $comments; // Retourner la collection de commentaires
        // }
    }  

?>