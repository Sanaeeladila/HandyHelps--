<?php

    namespace App\Http\Controllers;
    use App\Models\Creneau;
    use App\Models\Partenaire;
    use App\Models\Client;
    use App\Models\Service;
    use Illuminate\Http\Request;
    use App\Mail\NewRequestToPartner;
    use App\Mail\RequestSentToClient;
    use Illuminate\Support\Facades\Mail;

    class ReservationController extends Controller
    {
        public function getAvailableProfiles(Request $request)
        {
            // Récupérez les données du formulaire
            $id_client = $request->id_client;
            $description = $request->description;
            $service = $request->service;

            $category = $request->category;
            $serviceDate = $request->service_date;
            $heures = $request->heures;
            $creneaux = implode(',', $heures);

                $jour = date('l', strtotime($serviceDate));
                //dd($jour, date_default_timezone_get(),$category, $serviceDate, $heures);



            // Recherchez les créneaux disponibles pour la catégorie de service, la date et les heures sélectionnées
            $creneauxDisponibles = Creneau::where('categorie', $category)
                ->where('jour', $jour)
                ->whereIn('creneau', $heures)
                ->where('status', 'disponible')
                ->distinct()
                ->pluck('id_partenaire')
                ->toArray();
            
            


            // Récupérez les profils correspondants aux créneaux disponibles
            //$profilesDisponibles = Partenaire::whereIn('id_user', $creneauxDisponibles)->get();
            $profilesDisponibles = Partenaire::whereIn('id_user', $creneauxDisponibles)->with('creneaux')->get();
            //$query = Partenaire::whereIn('id_user', $creneauxDisponibles)->with('creneaux');
            //dd($query->toSql(), $query->getBindings());
            //$sql = $query->toSql();
            //dd($sql);
            //dd($creneauxDisponibles, $jour, $profilesDisponibles);
            // Encodez les données en JSON
            $jsonData = $profilesDisponibles->toJson(JSON_PRETTY_PRINT);

            // Chemin du fichier JSON où vous souhaitez enregistrer les données
            $jsonFilePath = storage_path('app\profiles.json');

            // Écrivez les données JSON dans le fichier
            $success = file_put_contents($jsonFilePath, $jsonData);
            //dd($creneauxDisponibles, $jour, $profilesDisponibles, $jsonData, $jsonFilePath, $success);

            // Retournez une vue avec les profils disponibles (facultatif)
            return view('profiles', [
                'id_client' => $id_client,
                'description' => $description,
                'creneaux' => $creneaux,
                'service' => $service,
                'category' => $category,
                'serviceDate' => $serviceDate,
                'jour' => $jour
            ]);
        }

        public function storeReservation(Request $request)
{
    $id_partenaire = $request->profile_id;
    $partenaire = Partenaire::where('id_user', $id_partenaire)->first();
    $id_client = $request->id_client;
    $client = Client::where('id_user', $id_client)->first();

    // Check if the partenaire or client does not exist or their user relationships are not set
    if (!$partenaire || !$client || !$partenaire->user || !$client->user) {
        return back()->withErrors(['error' => 'Client or Partner data is incomplete.']);
    }

    $id_p = $partenaire->id;
    $id_c = $client->id;
    $description = $request->description;
    $date_reservation = date('Y-m-d H:i:s');
    $service = $request->service;
    $status = 'en attente';
    $commentaire_partenaire = 0;
    $commentaire_client = 0;
    $category = $request->category;
    $serviceDate = $request->serviceDate;
    $creneaux = $request->creneaux;
    $jour = $request->jour;


    $Service = new Service();
            $Service->partenaire_id = $id_p;
            $Service->client_id = $id_c;
            $Service->description = $description;
            $Service->date_reservation = $date_reservation;
            $Service->service = $service;
            $Service->statut = $status;
            $Service->commentaire_partenaire = $commentaire_partenaire;
            $Service->commentaire_client = $commentaire_client;
            $Service->categorie = $category;
            $Service->date_service = $serviceDate;
            $Service->creneau = $creneaux;

    $Service->save();

    // Send emails
    Mail::to($partenaire->user->email)->send(new NewRequestToPartner($client, $Service));
    
    // Assuming $client, $partenaire, and $Service are already defined correctly
Mail::to($client->user->email)->send(new RequestSentToClient($partenaire, $Service));
$creneaux = explode(',', $creneaux);
Creneau::whereIn('creneau', $creneaux)
    ->where('id_partenaire', $id_partenaire)
    ->where('categorie', $category)
    ->where('jour', $jour)
    ->update(['status' => 'réservé']);



    // Redirect to the confirmation page
    return redirect()->route('confirm-reservation', compact('id_client'));
        }
        public function confirmReservation($id_client)
        {
            return view('confirm-reservation', compact('id_client'));
        }

    }

