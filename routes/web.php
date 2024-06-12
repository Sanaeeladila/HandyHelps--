<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\ClientController;
    use App\Http\Controllers\PartenaireController;
    use App\Http\Controllers\ServiceController;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\DashboardClientController;
    use App\Http\Controllers\DashboardPartenaireController;
    use App\Http\Controllers\AdminCommentaireController;
    use App\Http\Controllers\IndexController;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\ReservationController;



    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/login', function () {
        return view('login');
    });

    Route::get('/signup', function () {
        return view('signup');
    });

    /*
    Route::get('/gardening', function () {
        return view('gardening');
    });  

    Route::get('/petCare', function () {
        return view('petCare');
    });

    Route::get('/bricolage', function () {
        return view('bricolage');
    }); */

    /*Route::get('/dashbord', function () {
        return view('dashbord');
    });*/



    Route::get('/dashbordadmin', [AdminController::class, 'dashbordadmin'])->name('dashbordadmin');


    Route::get('/adminclient', [ClientController::class, 'adminclient'])->name('adminclient');

    Route::get('/adminservice', [ServiceController::class, 'showServices'])->name('adminservice');

    Route::delete('/delete-client/{id}', [ClientController::class, 'destroy']);

    Route::delete('/delete-service/{id}', [ServiceController::class, 'destroy'])->name('delete-service');
    // Confirmation de suppression avec le dialogue
    Route::get('/services/confirm-delete/{id}', [ServiceController::class, 'confirmDelete'])->name('confirm-delete');

    // Route de suppression finale
    Route::delete('/services/delete/{id}', [ServiceController::class, 'delete'])->name('service-delete');

    // Dans web.php
    Route::get('/clients/confirm-delete/{id}', [ClientController::class, 'confirmDeleteClient'])->name('confirm-delete-client');

    Route::delete('/delete-client/{id}', [ClientController::class, 'destroy'])->name('delete-client');


    Route::delete('/delete-partenaire/{id}', [AdminController::class, 'destroy']);

    Route::get('/partenaires/confirm-delete/{id}', [AdminController::class, 'confirmDeletePartenaire'])->name('confirm-delete-partenaire');

    Route::delete('/delete-partenaire/{id}', [AdminController::class, 'destroy'])->name('delete-partenaire');


    // Route vers la page de choix du rôle
    Route::get('/before-signup', function () {
        return view('before-signup');
    })->name('before-signup');

    // Route pour le formulaire d'inscription du client
    Route::get('/register-client', function () {
        return view('register-client');
    })->name('register-client');

    // Route pour le formulaire d'inscription du fournisseur de service
    Route::get('/register-provider', function () {
        return view('register-provider');
    })->name('register-provider');

    Route::POST('/add-client', [ClientController::class, 'AddClient'])->name('add-client');
    Route::POST('/add-partenaire', [AdminController::class, 'AddPartenaire'])->name('add-partenaire');

    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/dashbordClient', [DashboardClientController::class, 'index'])->name('dashbordClient');
    Route::get('/dashbordPartenaire', [DashboardPartenaireController::class, 'index'])->name('dashbordPartenaire');

    // Add a route parameter for the partner's ID
    Route::get('/dashbordPartenaire/{id}', [DashboardPartenaireController::class, 'index'])->name('dashbordPartenaire');
    Route::get('/dashbordClient/{id}', [DashboardClientController::class, 'index'])->name('dashbordClient');


    /*Route::get('/dashbordPartenaire', function () {
        return view('dashbordPartenaire');
    }); */

    ////////////////////////////logout//////////////////////////
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



    ////////////////////////// Client_update //////////////////////////
    Route::post('/dashbordClient', [ClientController::class, 'update'])->name('update-profile');
    ////////////////////////// Partenaire update //////////////////////////


    ////////////////////////// Afficher_expert //////////////////////////
    Route::get('/dashbordClient', [DashboardClientController::class, 'displayPartnersByCategory'])->name('partners.by.category');
    Route::get('/profile/details/{partner}', [DashboardClientController::class, 'profileDetails'])->name('profile.details');
    Route::get('/dashbordClient', [DashboardClientController::class, 'displayServices'])->name('show.services.clients');


    ////////////////////////// Afficher_service //////////////////////////
    Route::get('/dashboardPartenaire', [DashboardPartenaireController::class, 'showServices'])->name('show.services');
    Route::post('/update-service-status', [DashboardPartenaireController::class, 'updateServiceStatus'])->name('update.service.status');

    Route::get('/dashboardClient', [DashboardClientController::class, 'displayServicesToReview'])->name('show.services.to.review');
    // Example route for displaying services to review for a partner
    Route::get('/partenaire-comments/{id_user}', [DashboardPartenaireController::class, 'displayServicesToReview1'])->name('partenaire-services-to-review');

    Route::get('/dashboardPartenaire', [DashboardPartenaireController::class, 'dashbordPartenaire'])->name('dashboardPartenaire');
    Route::post('/dashbordPartenaire', [PartenaireController::class, 'update'])->name('update-profile-partenaire');
    Route::get('/partenaire/details/{clientId}', [DashboardPartenaireController::class, 'profileDetailsPartenaire'])->name('partenaire.details');

    /////////////////////comments////////////////////////


    Route::get('/dashboardClient', [DashboardClientController::class, 'showCommentaire'])->name('show.commentaires');
    Route::get('/dashboardPartenaire', [DashboardPartenaireController::class, 'showCommentaire'])->name('show.commentaires');




    Route::get('/admin-commentaires-partenaires', [AdminCommentaireController::class, 'showPartnersComments'])->name('admincommentairepartenaires');

    Route::get('/admin-commentaires-clients', [AdminCommentaireController::class, 'showClientsComments'])->name('admincommentaireclients');
    // Assure-toi que la route attend un paramètre 'id'
    Route::get('/confirm-delete-commentclient/{id}', function ($id) {
        $commentaire = App\Models\CommentaireClient::findOrFail($id);
        return view('confirm-delete-commentclient', ['commentaire' => $commentaire]);
    })->name('confirm-delete-commentclient');

    Route::delete('/delete-commentaire/{id}', [App\Http\Controllers\AdminCommentaireController::class, 'destroy'])->name('delete-commentaire');

    Route::get('/confirm-delete-commentpartenaire/{id}', function ($id) {
        $commentaire = App\Models\CommentairePartenaire::where('id_commentaire', $id)->firstOrFail();
        return view('confirm-delete-commentpartenaire', ['commentaire' => $commentaire]);
    })->name('confirm-delete-commentpartenaire');

    Route::delete('/delete-commentpartenaire/{id}', [App\Http\Controllers\AdminCommentaireController::class, 'destroyPartenaire'])->name('delete-commentpartenaire');


    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');


    Route::get('/partenaire-profile/{id_user}', [DashboardPartenaireController::class, 'profile'])->name('partenaire-profile');



    Route::get('/partenaire-comments/{id_user}', [DashboardPartenaireController::class, 'comments'])->name('partenaire-comments');

    Route::post('/dashbordPartenaire/{service_id}', [DashboardPartenaireController::class, 'commenter'])->name('submit.review1');

    Route::get('/partenaire-interventions/{id_user}', [DashboardPartenaireController::class, 'interventions'])->name('partenaire-interventions');

    Route::get('/dashbordPartenaire/{id_user}', [DashboardPartenaireController::class, 'index'])->name('dashbordPartenaire');



    //////////////////// firdaous add ////////////////////////
    // Route pour la page de réservation pour récupérer les profiles disponibles dans un créneau donné
    Route::match(['get', 'post'], '/get-available-profiles', [ReservationController::class, 'getAvailableProfiles'])->name('get_available_profiles');

    //Route::get('/dashboard/{id}', [DashboardClientController::class, 'index'])->name('dashboard');
    Route::post('/store_reservation', [ReservationController::class, 'storeReservation'])->name('store_reservation');

    //Route pour confirm Reservation
    Route::get('/confirm-reservation/{id_client}', [ReservationController::class, 'confirmReservation'])->name('confirm-reservation');



    Route::get('/client-profile/{id_user}', [DashboardClientController::class, 'profile'])->name('client-profile');

    Route::post('/dashbordClient/{service_id}', [DashboardClientController::class, 'commenter'])->name('submit.review');  
    Route::get('/client-comments/{id_user}', [DashboardClientController::class, 'comments'])->name('client-comments');


    Route::get('/client-requests/{id_user}', [DashboardClientController::class, 'requests'])->name('client-requests');


    Route::get('/client-experts/{id_user}', [DashboardClientController::class, 'showClientExperts'])->name('client-experts');


    Route::get('/dashbordClient/{id_user}', [DashboardClientController::class, 'index'])->name('dashbordClient');

    /*-----------------------------*/
    Route::get('/gardening', [IndexController::class, 'showGardeningPartners'])->name('gardening.partners');
    Route::get('/petCare', [IndexController::class, 'showPetCarePartners'])->name('petcare.partners');
    Route::get('/bricolage', [IndexController::class, 'showBricolagePartners'])->name('bricolage.partners');


?>