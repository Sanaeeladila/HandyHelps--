<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style3.css') }}">
        <title>Comments</title>
        <style >
           
            .section {
                display: none;
            }
            .section.active {
                display: block;
            }
            .service-box {
                border: 1px solid #ccc;
                padding: 20px;
                margin-bottom: 20px;
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
                    <a href="#" class="menu-item" data-target="dashboard-section">
                        <span class="text" style="margin-left: 50px;">My Profile</span>
                    </a>
                </li>
                <li>
            <a href="{{ route('Requestspartenaire', ['id_user' => Auth::user()->id]) }}" class="menu-item requests" data-target="requestspartenaire-section">
                <span class="text" style="margin-left: 50px;">Requests</span>
            </a>
        </li>
                
                <li>
                    <a href="{{ route('CommentairePartenaire', ['id_user' => Auth::user()->id]) }}" class="menu-item" data-target="comments-section">
                        <span class="text" style="margin-left: 50px;" >Comments</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item" data-target="clients-section">
                        <span class="text" style="margin-left: 50px;">My interventions</span>
                    </a>
                </li>
                
            </ul>
            <ul class="side-menu">
                <li>
                <a href="{{ route('home') }}" class="menu-item logout" data-target="logout-section">
                    <span class="text" style="margin-left: 50px;">Logout</span>
                </a>
                </li>
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
                <div id="commentairespartenaire-section" class="section active">
                    <h1 style="font-size: 34px; color: #333; margin-bottom: 20px; text-align:center;">commentaires partenaire</h1>
                    <div class="container">
                    @foreach ($services as $service)
                    <div class="service-box">
                        <h2>{{ $service->titre }}</h2>
                        <p>{{ $service->description }}</p>
                        <p>Client: {{ $service->client->nom }} {{ $service->client->prenom }}</p>
                        <p>Date demande: {{ optional($service->date_demande)->format('d/m/Y') }}</p>
                        <p>Date début: {{ optional($service->date_debut)->format('d/m/Y') }}</p>
                        <p>Durée: {{ $service->duree }}</p>
                    
                        <form action="{{ route('commenter-service', $service->id) }}" method="GET">

                            @csrf
                            <textarea name="commentaire" placeholder="Votre commentaire"></textarea>
                            <button type="submit">Commenter</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </main>
        </section>

<script>
            // JavaScript code for handling sidebar navigation
            document.addEventListener('DOMContentLoaded', function() {
                const menuItems = document.querySelectorAll('.menu-item');
                const sections = document.querySelectorAll('.section');

                menuItems.forEach(item => {
                    item.addEventListener('click', function() {
                        // Deactivate all sections
                        sections.forEach(section => {
                            section.classList.remove('active');
                        });

                        // Activate the corresponding section
                        const target = item.getAttribute('data-target');
                        document.getElementById(target).classList.add('active');
                    });
                });

                // Activate section from URL hash
                const hash = window.location.hash.substring(1); // Retrieve the hash from the URL
                if (hash) {
                    const targetSection = document.getElementById(hash);
                    if (targetSection) {
                        targetSection.classList.add('active');
                    }
                }
            });
        </script>
</body>
</html>
