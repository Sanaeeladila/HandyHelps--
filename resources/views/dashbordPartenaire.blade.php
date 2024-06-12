<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style3.css') }}">
        <title>Partenaire_dashboard</title>
        <script src="https://kit.fontawesome.com/1e94604817.js" crossorigin="anonymous"></script>
        <style >
            .section {
                display: none;
            }
            .section.active {
                display: block;
            }
        </style>
    </head>
    <body>
        
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

                <li class="active">
                    <a href="#" class="menu-item" data-target="message-section">
                        <span class="text" style="margin-left: 50px;">Requests</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('partenaire-profile', ['id_user' => $partenaire->id_user]) }}#" class="menu-item" data-target="dashboard-section">
                        <span class="text" style="margin-left: 50px;">My Profile</span>
                    </a>
                </li>

                
                <li>
                    <a href="{{ route('partenaire-comments', ['id_user' => $partenaire->id_user]) }}#" class="menu-item" data-target="comments-section">
                        <span class="text" style="margin-left: 50px;" >Comments</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('partenaire-interventions', ['id_user' => $partenaire->id_user]) }}#" class="menu-item" data-target="clients-section">
                        <span class="text" style="margin-left: 50px;">My interventions</span>
                    </a>
                </li>
                
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="#" class="menu-item logout" data-target="settings-section">
                        <span class="text" style="margin-left: 50px;  color: var(--red);">Logout</span>
                    </a>
                </li>
                <form id="logout-form-partner" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('.logout').click(function(e) {
                            e.preventDefault();
                            $('#logout-form-partner').submit();
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
                <!--
                <a href="#" class="notification" id="notificationLink">
                    <i class='bx bxs-bell' style="font-size: 25px;"></i>
                </a> -->
            </nav>
            <!-- NAVBAR -->

            <!-- MAIN -->
            <main>
                <style> 
                    .form-group select { width: 100%;   padding: 10px 20px;   border: 1.5px solid #000000;  box-sizing: border-box;  }
                    .form-group2 input[type="checkbox"] {  margin-right: 3px;   vertical-align: middle;   }
                    .form-group2 label {  display: block;  text-align: left; margin-bottom: 8px;  }
                    .form-group input[type="checkbox"] {  margin-right: 14px;  vertical-align: middle;   }
                    .form2 {  width: 100%; padding: 10px 20px;  border: 1.5px solid #000000;  box-sizing: border-box;  }
                    .form-group input[type="file"], .form-group textarea, .form-group input[type="number"]{    width: 100%; padding: 10px 20px; border: 1.5px solid #000000; box-sizing: border-box; }
                    .card-container { display: flex; flex-wrap: wrap; gap: 30px; padding: 20px; }
                    .card1 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; width: 260px; height: 360px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
                    .card2 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; width: 280px; height: 420px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
                    .title_card1 { font-size: 15px; font-weight: bold; margin-bottom: 5px; margin-top: 10px; }
                    .parag_card1 { font-size: 14px; margin-bottom: 5px; }
                    #VIEW { position: relative;margin-top: 40px; bottom: 35px; background-color: #0097b2; color: #fff; border: none; width: 100%; padding: 7px 32px; border-radius: 20px; font: bold; cursor: pointer; }
                    #ACCEPT { position: relative; bottom: 30px; background-color: #86bd5f; color: #fff; border: none; width: 100%; padding: 7px 13px; border-radius: 20px; font: bold; cursor: pointer; }
                    #REFUSE { position: relative; bottom: 20px; background-color: #ff3131; color: #fff; border: none; width: 100%; padding: 7px 13px; border-radius: 20px; font: bold; cursor: pointer; }
                    .form-group input[type="number"]{ width: 100%; padding: 10px 20px; border: 1.5px solid #000000; box-sizing: border-box; }
                    #Review { position: absolute; bottom: 20px; background-color: #ff914d; color: #fff; border: none; width: 70%; padding: 10px 20px; border-radius: 20px; font: bold; cursor: pointer; }
                    .card3 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; width: 320px; height: 250px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
                </style>




                <div id="message-section" class="section active">
                    <h1 style="font-size: 24px; color: #333; margin-bottom: 20px; text-align:center;">My Requests</h1>
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif 
                    <div class="card-container">
                        @foreach ($services as $service)
                        <div class="card1 category-link"  data-service="review1">
                            <p class="title_card1">Service {{ $service->id }}</p>
                            <p class="parag_card1">{{ $service->description }}</p> </br>
                            <div style="display: flex; align-items: center; ">
                                <strong><p class="parag_card1">Client </p> </strong>
                                <p class="parag_card1" style="margin-left: 35px;"> {{ $service->client->nom }} {{ $service->client->prenom }} </p>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <strong><p class="parag_card1">Request date </p> </strong>
                                <p class="parag_card1" style="margin-left: 35px;"> {{ $service->date_reservation }} </p>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <strong><p class="parag_card1">Service date</p> </strong>
                                <p class="parag_card1" style="margin-left: 30px;"> {{ $service->date_service }} </p>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <strong><p class="parag_card1">Creneau </p> </strong>
                                <p class="parag_card1" style="margin-left: 65px;"> {{ $service->creneau }}</p>
                            </div>
                            <a href="{{ route('partenaire.details', $service->client_id ) }}"><input type="submit" value="VIEW CLIENT" id="VIEW"> </a>

                            <form action="{{ route('update.service.status') }}" method="POST" id="service-status-form">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                <button type="submit" name="new_status" value="valide" id="ACCEPT">ACCEPT</button>
                                <button type="submit" name="new_status" value="refuse" id="REFUSE">REFUSE</button>
                            </form>

                            
                        </div>
                        @endforeach
                    </div>
                </div>

                
            </main>
        </section>
        <!-- CONTENT -->

        
        <script>
            // Script JavaScript pour gérer le basculement des sections de contenu
            document.addEventListener('DOMContentLoaded', function() {
                const menuItems = document.querySelectorAll('.menu-item');
                const sections = document.querySelectorAll('.section');

                menuItems.forEach(item => {
                    item.addEventListener('click', function() {
                        // Désactive toutes les sections
                        sections.forEach(section => {
                            section.classList.remove('active');
                        });

                        // Active la section correspondante
                        const target = item.getAttribute('data-target');
                        document.getElementById(target).classList.add('active');
                    });
                });
            });
        </script>  

    </body>
</html>
