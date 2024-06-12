<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style3.css') }}">
        <title>Client_dashboard</title>
        <script src="https://kit.fontawesome.com/1e94604817.js" crossorigin="anonymous"></script>
        <style >
            .section { display: none; }
            .section.active { display: block; }
            .clickable { cursor: pointer; }
            .cardContainerX { display: flex; flex-wrap: wrap; justify-content: center; gap: 100px; padding: 20px; }
            .cardX { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #ccc; border-radius: 10px; max-width: 280px; height: 250px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); position: relative; text-align: center; padding-bottom: 50px; }
            .profileInfo { display: flex; align-items: center; margin-bottom: 15px; }
            .profilePic { width: 80px; height: 80px; border-radius: 50%; margin-right: 20px; }
            .user-info { text-align: left; }
            .user-name { font-size: 18px; font-weight: bold; margin-bottom: 5px; }
            .address { font-size: 14px; color: #BBBBBB; margin-bottom: 5px; }
            .grade { font-size: 14px; color: #FFD43B; margin-bottom: 5px; }
            .serviceX { position: absolute; bottom: 100px; left: 50%; transform: translateX(-50%); }
            .view-profile { position: absolute; bottom: 10px; color: #fff; border: none; padding: 10px 20px; border-radius: 20px; cursor: pointer; }
            .card2 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; width: 260px; height: 400px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
            .card-container { display: flex; flex-wrap: wrap; gap: 40px; padding: 20px; }
            .card-container2 { display: flex; flex-wrap: wrap; gap: 7px; padding: 5px; }
            .card-container { display: flex; flex-wrap: wrap; gap: 40px; padding: 20px; }
            .card1 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; max-width: 245px; height: 250px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
            .title_card1 { font-size: 15px; font-weight: bold; margin-bottom: 5px; margin-top: 10px; }
            .card3 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; width: 290px; height: 250px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
            .parag_card1 { font-size: 14px; margin-bottom: 5px; }
            #Review { position: absolute; bottom: 20px; background-color: #ff914d; color: #fff; border: none; width: 70%; padding: 10px 20px; border-radius: 20px; font: bold; cursor: pointer; }
            .form-group input[type="number"]{ width: 100%; padding: 10px 20px; border: 1.5px solid #000000; box-sizing: border-box; }
            .form-group input[type="file"], .form-group textarea, .form-group input[type="number"]{    width: 100%; padding: 10px 20px; border: 1.5px solid #000000; box-sizing: border-box; }
            .form-group input[type="checkbox"] { margin-right: 14px;  vertical-align: middle; }       
        </style> 
    </head>
    <body>
    <main>
        <!-- SIDEBAR -->
        <section id="sidebar">
            <a href="#" class="brand">
            <span class="text" >
                <nav>
                    <ul>
                        <li><img src="{{ asset('img/logo.png') }}" style="height:30px;"></li>
                        <li class="handyhelps" style="color: #000000; font-family: 'Namdhinggo'; font-size: 20px;">HandyHelps</li>
                    </ul>
                </nav>
            </span>
            </a>
            <ul class="side-menu top">


                <li >
                    <a href="{{ route('dashbordClient', ['id_user' => $client->id_user]) }}#" class="menu-item" data-target="reclamations-section">
                        <span class="text" style="margin-left: 50px;">Request Service</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('client-profile', ['id_user' => $client->id_user]) }}#"  class="menu-item" data-target="dashboard-section">
                        <span class="text" style="margin-left: 50px;">My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client-experts', ['id_user' => $client->id_user]) }}#" class="menu-item" data-target="clients-section">
                        <span class="text" style="margin-left: 50px;">Experts</span>
                    </a>
                </li>
                
                <li class="active" >
                    <a href="#" class="menu-item" data-target="message-section">
                        <span class="text" style="margin-left: 50px;">My Requests</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client-comments', ['id_user' => $client->id_user]) }}#" class="menu-item" data-target="comments-section">
                        <span class="text" style="margin-left: 50px;" >Comments</span>
                    </a>
                </li>
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="#" class="menu-item logout" data-target="settings-section">
                        <span class="text" style="margin-left: 50px;">Logout</span>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('.logout').click(function(e) {
                            e.preventDefault();
                            $('#logout-form').submit();
                        });
                    });
                </script>
            </ul>
        </section>
        <!-- SIDEBAR -->

        <!-- CONTENT -->
        <section id="content">
            <!-- NAVBAR -->
            <nav>
                <form action="#" style="margin-left: 22%;">
                </form>
                <a href="#" class="notification" id="notificationLink">
                    <i class='bx bxs-bell' style="font-size: 25px;"></i>
                </a>
            </nav>
            <!-- NAVBAR -->

            <!-- MAIN -->
            <main>
                <!------------------------------------------ Section de My profile ------------------------------------------>
                
                <!------------------------------------------ Section de My requests ------------------------------------------>
                <div id="message-section" class="section">
                    <h2 > On hold services</h2>
                    <div class="card-container">
                        @foreach($services as $service)
                            <div class="card1" style="height: 190px; width:290px;">
                                <p class="title_card1">Service {{ $service->id }}</p>
                                <p class="parag_card1">{{ $service->description }}</p> 
                                <div style="display: flex; align-items: center;">
                                    <p class="parag_card1">Reserv date:</p>
                                    <p class="parag_card1" style="margin-left: 35px;">{{ $service->date_reservation }}</p>
                                </div> 
                                <div style="display: flex; align-items: center;">
                                    <p class="parag_card1">Service date:</p>
                                    <p class="parag_card1" style="margin-left: 35px;">{{ $service->date_service }}</p>
                                </div>  
                                <div style="display: flex; align-items: center;">
                                    <p class="parag_card1">Creneau:</p>
                                    <p class="parag_card1" style="margin-left: 35px;">{{ $service->creneau }}</p>
                                </div>
                            </div> 
                        @endforeach 
                    </div>  

                    
                        <!------------------- Section d'affichage des commentaires  ------------------->
                    <h2 > Recent comments</h2> 
                    @if(isset($comments))
                        <div class="card-container2">
                            @foreach($comments as $comment)
                                <div class="card3" style="height: 190px;">
                                    <p class="title_card1">Comment</p>
                                    <div style="display: flex; justify-content: center;">
                                        @for ($i = 0; $i < $comment->rating; $i++)
                                            <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 14px;"></i>
                                        @endfor
                                    </div> 
                                    <p class="parag_card1">{{ $comment->commentaire }}</p> </br>
                                    <div style="display: flex; align-items: center;">
                                        <p class="parag_card1"><strong>Comment's date</strong></p>
                                        <p class="parag_card1" style="margin-left: 35px;">{{ $comment->date }}</p>
                                    </div>
                                    <div style="display: flex; align-items: center;">
                                        <p class="parag_card1"><strong>Provider's name</strong></p>
                                        <p class="parag_card1" style="margin-left: 35px;">{{ $comment->partenaire->nom}} {{ $comment->partenaire->prenom}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div> </br>

              <!-- Ignored Section in your Blade file -->
                <div id="ignored-section" class="section" style="display:block;"> <!-- Remove style if dynamically toggling display -->
                    <h2>Ignored services</h2>
                    <div class="card-container">
                        @forelse($ignoredServices as $service)
                            <div class="card1" style="height: 190px; width:290px;">
                                <p class="title_card1">Service {{ $service->id }}</p>
                                <p class="parag_card1">{{ $service->description }}</p>
                                <p class="parag_card1">Reservation date: {{ $service->date_reservation }}</p>
                                <p class="parag_card1">Service date: {{ $service->date_service }}</p>
                                <p class="parag_card1">Time slot: {{ $service->creneau }}</p>
                            </div>
                        @empty
                            <p>No ignored services found.</p>
                        @endforelse
                    </div>
                </div>


            </main>

        
            <script>
                // Attend que le document soit chargé
                document.addEventListener('DOMContentLoaded', function() {
                    // Récupère toutes les sections avec la classe "section"
                    var sections = document.querySelectorAll('.section');
                    
                    // Vérifie s'il y a au moins une section
                    if (sections.length > 0) {
                        // Ajoute la classe "active" à la première section
                        sections[0].classList.add('active');
                    }
                });
            </script>
        </section>


    </body>
</html>