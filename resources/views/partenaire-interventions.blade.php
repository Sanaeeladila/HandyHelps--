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

                <li>
                    <a href="{{ route('dashbordPartenaire', ['id_user' => $partenaire->id_user]) }}" class="menu-item" >
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
                <li class="active">
                    <a href="#" class="menu-item" >
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
                    .card-container { display: flex; flex-wrap: wrap; gap: 10px; padding: 5px; }
                    .card1 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; width: 260px; height: 360px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
                    .card2 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; width: 280px; height: 420px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
                    .title_card1 { font-size: 15px; font-weight: bold; margin-bottom: 5px; margin-top: 10px; }
                    .parag_card1 { font-size: 14px; margin-bottom: 5px; }
                    #VIEW { position: relative;margin-top: 40px; bottom: 35px; background-color: #0097b2; color: #fff; border: none; width: 100%; padding: 7px 32px; border-radius: 20px; font: bold; cursor: pointer; }
                    #ACCEPT { position: relative; bottom: 30px; background-color: #86bd5f; color: #fff; border: none; width: 100%; padding: 7px 13px; border-radius: 20px; font: bold; cursor: pointer; }
                    #REFUSE { position: relative; bottom: 20px; background-color: #ff3131; color: #fff; border: none; width: 100%; padding: 7px 13px; border-radius: 20px; font: bold; cursor: pointer; }
                    .form-group input[type="number"]{ width: 100%; padding: 10px 20px; border: 1.5px solid #000000; box-sizing: border-box; }
                    #Review { position: absolute; bottom: 20px; background-color: #ff914d; color: #fff; border: none; width: 70%; padding: 10px 20px; border-radius: 20px; font: bold; cursor: pointer; }
                    .card3 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; width: 290px; height: 250px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
                </style>

                
                <!-- Autres sections de contenu -->
                <div id="clients-section" class="section">
                    <h1 style="font-size: 24px; color: #333; margin-bottom: 30px; margin-top: 10px; ">Recent interventions</h1>
                    <div class="card-container" >
                        @foreach($comments as $comment)
                            <div class="card3" style="height: 190px;">
                                <p class="title_card1">Comment</p> 
                                <div style="display: flex; justify-content: center;">
                                    <!-- Affichage de l'évaluation avec des étoiles -->
                                    @for ($i = 0; $i < $comment->rating; $i++)
                                        <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 14px;"></i>
                                    @endfor
                                </div>  </br>
                                <p class="parag_card1">{{ $comment->commentaire }}</p> 
                                <div style="display: flex; align-items: center;">
                                    <p class="parag_card1"><strong>Comment's date</strong></p> 
                                    <p class="parag_card1" style="margin-left: 35px;">{{ $comment->date }}</p> 
                                </div> 
                                <div style="display: flex; align-items: center;">
                                    <p class="parag_card1"><strong>Client</strong></p> 
                                    <p class="parag_card1" style="margin-left: 35px;">{{ $comment->client->nom }} {{ $comment->client->prenom }}</p> 
                                </div> 
                            </div>
                        @endforeach
                        
                    </div>
                </div>

            </main>
        </section>
        <!-- CONTENT -->

        
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
 
    </body>
</html>
