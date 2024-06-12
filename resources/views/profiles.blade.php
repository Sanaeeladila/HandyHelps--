<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style3.css') }}">
        <title>Experts profiles</title>
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
            .card-container2 { display: flex; flex-wrap: wrap; gap: 20px; padding: 20px; }
            .card-container { display: flex; flex-wrap: wrap; gap: 40px; padding: 20px; }
            .card1 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; max-width: 245px; height: 250px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
            .title_card1 { font-size: 15px; font-weight: bold; margin-bottom: 5px; margin-top: 10px; }
            .card3 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; width: 320px; height: 250px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
            .parag_card1 { font-size: 14px; margin-bottom: 5px; }
            #Review { position: absolute; bottom: 20px; background-color: #ff914d; color: #fff; border: none; width: 70%; padding: 10px 20px; border-radius: 20px; font: bold; cursor: pointer; }
            .form-group input[type="number"]{ width: 100%; padding: 10px 20px; border: 1.5px solid #000000; box-sizing: border-box; }
            .form-group input[type="file"], .form-group textarea, .form-group input[type="number"]{    width: 100%; padding: 10px 20px; border: 1.5px solid #000000; box-sizing: border-box; }
            .form-group input[type="checkbox"] { margin-right: 14px;  vertical-align: middle; }    
            .submit_request {  position: absolute; width: 100px;  bottom: 20px;  background-color: #000000; color: #ffffff; font-size: 15px;  padding: 10px 20px; margin: 6px 0; border: none; border-radius: 6px; cursor: pointer; }   
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
                    <a href="#" class="menu-item" data-target="reclamations-section">
                        <span class="text" style="margin-left: 50px;">Request Service</span>
                    </a>
                </li>
                <li >
                    <a href="#" class="menu-item" data-target="dashboard-section">
                        <span class="text" style="margin-left: 50px;">My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item" data-target="clients-section">
                        <span class="text" style="margin-left: 50px;">Experts</span>
                    </a>
                </li>
                
                <li>
                    <a href="#" class="menu-item" data-target="message-section">
                        <span class="text" style="margin-left: 50px;">My Requests</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item" data-target="comments-section">
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
                <!--
                <a href="#" class="notification" id="notificationLink">
                    <i class='bx bxs-bell' style="font-size: 25px;"></i>
                </a>  -->
            </nav>
            <!-- NAVBAR -->

            <!-- MAIN -->
            <main>
                <!------------------------------------------ Section de My profile ------------------------------------------>
                <div id="dashboard-section" class="section ">                    

                </div>




                <!------------------------------------------ Section des experts ------------------------------------------>
                <div id="clients-section" class="section">                    

                </div>


                <!------------------------------------------ Section de request service ------------------------------------------>
                <div id="reclamations-section" class="section active">
                    <h1 style="font-size: 24px; color: #333; margin-bottom: 10px; margin-top: 30px; ">Choose a provider</h1>
                    @php
                        $jsonFilePath = storage_path('app\profiles.json');                
                        // Vérifier si le fichier JSON existe
                        if (file_exists($jsonFilePath)) {
                            $jsonString = file_get_contents($jsonFilePath);
                            $profiles = json_decode($jsonString, true);

                    @endphp

                    <div class="cardContainerX">
                        @foreach ($profiles as $profile)
                            <div class="cardX " >                      
                                <div class="profileInfo">
                                    <img src="{{ $profile['profil_picture'] }}" alt="Profile Picture" class="profilePic">
                                    <div class="user-info">
                                        <div class="user-name">{{ $profile['nom'] }} {{ $profile['prenom'] }}</div>
                                        <div class="address"><i class="fa-solid fa-location-dot" style="color: #BBBBBB;"></i> {{ $profile['ville'] }}</div>
                                        <div class="grade"><i class="fa-solid fa-star" style="color: #FFD43B;"></i> {{ $profile['moy_evaluation'] }}</div>
                                    </div>
                                    <div class="serviceX">{{ $profile['metier'] }}</div>
                                </div>
                                <form method="POST" action="{{ route('store_reservation') }}">
                                  @csrf
                                    <input type="hidden" name="id_client" value="{{ $id_client }}">
                                    <input type="hidden" name="description" value="{{ $description }}">
                                    <input type="hidden" name="creneaux" value="{{ $creneaux }}">
                                    <input type="hidden" name="service" value="{{ $service }}">
                                    <input type="hidden" name="category" value="{{ $category }}">
                                    <input type="hidden" name="serviceDate" value="{{ $serviceDate }}">
                                    <input type="hidden" name="jour" value="{{ $jour }}">
                                    <input type="hidden" name="profile_id" value="{{ $profile['id_user'] }}">
                                    <button type="submit" class="submit_request">Select</button>
                                </form>
                            </div>
                        @endforeach
                        @php
                        }
                        @endphp
                            
                    </div>
                                            
                </div> 



                <!------------------------------------------ Section de My requests ------------------------------------------>
                <div id="message-section" class="section">
                    
                </div>



                <!------------------------------------------ Section de Comments ------------------------------------------>
                <div id="comments-section" class="section">
                    
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
