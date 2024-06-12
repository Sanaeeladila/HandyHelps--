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
                <a href="{{ route('client-profile', ['id_user' => $client->id_user]) }}#"  class="menu-item" data-target="dashboard-section">
                        <span class="text" style="margin-left: 50px;">My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client-experts', ['id_user' => $client->id_user]) }}#" class="menu-item" data-target="clients-section">
                        <span class="text" style="margin-left: 50px;">Experts</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('client-requests', ['id_user' => $client->id_user]) }}#"  class="menu-item" data-target="message-section">
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
                <!--
                <a href="#" class="notification" id="notificationLink">
                    <i class='bx bxs-bell' style="font-size: 25px;"></i>
                </a> -->
            </nav>
            <!-- NAVBAR -->

            <!-- MAIN -->
            <main>
               






                <!------------------------------------------ Section de request service ------------------------------------------>
                <div id="reclamations-section" class="section active">
                    <h1 style="font-size: 24px; color: #333; margin-bottom: 10px; margin-top: 30px; ">Choose a category</h1>
                    <div class="row">
                        <div class="col-4">
                            <a class="category-link" data-service="gardening" style="text-decoration: none; color: #000000; font-size: 20px; text-align: center;">
                                <div class="card">
                                    <img src="{{ asset('img/service1.jpg') }}" class="card-img-top" >
                                    <div class="card-body">
                                        <h5 class="card-title" style="margin-top: 10px;" >GARDENING</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="category-link" data-service="petCare" style="text-decoration: none; color: #000000; font-size: 20px; text-align: center;"><div class="card">
                                <img src="{{ asset('img/service2.jpg') }}" class="card-img-top" >
                                <div class="card-body">
                                    <h5 class="card-title" style="margin-top: 10px;">PET CARE</h5>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="category-link" data-service="bricolage" style="text-decoration: none; color: #000000; font-size: 20px; text-align: center;"><div class="card">
                                <img src="{{ asset('img/service3.jpg') }}" class="card-img-top" >
                                <div class="card-body">
                                    <h5 class="card-title" style="margin-top: 10px;">BRICOLAGE</h5>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <!--<input type="submit" value="Continue" style="width: 50%; margin-left: 25%; margin-top: 15px;"> -->
                </div> 

                <div id="gardening-section" class="section ">
                    <h1 style="font-size: 24px; color: #333; margin-bottom: 10px; margin-top: 30px; ">What do you need?</h1>
                    <div class="container category2-link" >
                        <form id="gardening-form" method="POST" action="{{ route('get_available_profiles', ['id_client' => auth()->user()->id]) }}">
                            @csrf
                             <!-- Champ d'entrée caché pour stocker la catégorie -->
                             <input type="hidden" name="category" id="gardening-category" value="Gardening">
                            <div class="form-group2">
                                <input type="radio" id="gardening" name="service" value="gardening">
                                <label for="gardening">Garden Planting</label>
                                <input type="radio" id="landscapeDesign" name="service" value="landscapeDesign">
                                <label for="landscapeDesign">Landscape Design</label>
                                <input type="radio" id="gardenMaintenance" name="service" value="gardenMaintenance">
                                <label for="gardenMaintenance">Garden Maintenance</label> <br>
                            </div>
                            <div class="form-group">
                                <label for="service_date">Date of service</label>
                                <input type="date" id="service_date" name="service_date" >
                            </div>
                            <div class="form-group">
                                <label for="heures">Hours</label>
                                <input type="checkbox" name="heures[]" value="8h-10h">8h-10h
                                <input type="checkbox" name="heures[]" value="10h-12h">10h-12h
                                <input type="checkbox" name="heures[]" value="12h-14h">12h-14h
                                <input type="checkbox" name="heures[]" value="14h-16h">14h-16h
                                <input type="checkbox" name="heures[]" value="16h-18h">16h-18h
                                <input type="checkbox" name="heures[]" value="18h-20h">18h-20h
                            </div>
                            <div class="form-group3">
                                <label for="description">Desciption</label>
                                <input type="text" id="description" name="description" >
                            </div>
                            <input type="submit" value="continue">
                        </form>
                    </div>
                </div>
                   

                

                <div id="petCare-section" class="section ">
                    <h1 style="font-size: 24px; color: #333; margin-bottom: 10px; margin-top: 30px; ">What do you need?</h1>
                    <div class="container category2-link" >
                        <form id="petcare-form" method="POST" action="{{ route('get_available_profiles', ['id_client' => auth()->user()->id]) }}">
                            @csrf
                            <!-- Champ d'entrée caché pour stocker la catégorie -->
                            <input type="hidden" name="category" id="PetCare-category" value="PetCare">
                            <div class="form-group4">
                                <input type="radio" id="Petsitting" name="service" value="Petsitting">
                                <label for="Petsitting">Pet sitting</label>
                                <input type="radio" id="Dogwalking" name="service" value="Dogwalking">
                                <label for="Dogwalking">Dog walking</label>
                                <input type="radio" id="Petgrooming" name="service" value="Petgrooming">
                                <label for="Petgrooming">Pet grooming</label> <br>
                            </div>
                            <div class="form-group">
                                <label for="service_date">Date of service</label>
                                <input type="date" id="service_date2" name="service_date" >
                            </div>
                            <div class="form-group">
                                <label for="heures">Hours</label>
                                <input type="checkbox" name="heures[]" value="8h-10h">8h-10h
                                <input type="checkbox" name="heures[]" value="10h-12h">10h-12h
                                <input type="checkbox" name="heures[]" value="12h-14h">12h-14h
                                <input type="checkbox" name="heures[]" value="14h-16h">14h-16h
                                <input type="checkbox" name="heures[]" value="16h-18h">16h-18h
                                <input type="checkbox" name="heures[]" value="18h-20h">18h-20h
                            </div>
                            <div class="form-group3">
                                <label for="description">Desciption</label>
                                <input type="text" id="description" name="description" >
                            </div>
                            <input type="submit" value="continue">
                        </form>
                    </div>
                </div>


                
                
                <div id="bricolage-section" class="section ">
                    <h1 style="font-size: 24px; color: #333; margin-bottom: 10px; margin-top: 30px; ">What do you need?</h1>
                    <div class="container category2-link" data-service="provider3" >
                        <form id="Bricolage-form" method="POST" action="{{ route('get_available_profiles', ['id_client' => auth()->user()->id]) }}">
                            @csrf
                            <!-- Champ d'entrée caché pour stocker la catégorie -->
                            <input type="hidden" name="category" id="Bricolage-category" value="Bricolage">
                            <div class="form-group5">
                                <input type="radio" id="Plumber" name="service" value="Plumber">
                                <label for="Plumber">Plumber</label>
                                <input type="radio" id="Electrician" name="service" value="Electrician">
                                <label for="Electrician">Electrician</label>
                                <input type="radio" id="Painter" name="service" value="Painter">
                                <label for="Painter">Painter</label> <br>
                            </div>
                            <div class="form-group">
                                <label for="service_date">Date of service</label>
                                <input type="date" id="service_date" name="service_date" >
                            </div>
                            <div class="form-group">
                                <label for="heures">Hours</label>
                                <input type="checkbox" name="heures[]" value="8h-10h">8h-10h
                                <input type="checkbox" name="heures[]" value="10h-12h">10h-12h
                                <input type="checkbox" name="heures[]" value="12h-14h">12h-14h
                                <input type="checkbox" name="heures[]" value="14h-16h">14h-16h
                                <input type="checkbox" name="heures[]" value="16h-18h">16h-18h
                                <input type="checkbox" name="heures[]" value="18h-20h">18h-20h
                                <!--<input type="hidden" id="heures" name="heures[]">-->
                            </div>
                            <div class="form-group3">
                                <label for="email">Desciption</label>
                                <input type="text" id="description" name="description" >
                            </div>
                            <input type="submit" value="continue">
                        </form>
                        
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

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Sélectionnez tous les éléments avec la classe "category-link"
                const categoryLinks = document.querySelectorAll('.category-link');
                // Ajoutez un gestionnaire d'événements clic à chaque lien de catégorie
                categoryLinks.forEach(link => {
                    link.addEventListener('click', function(event) {
                        event.preventDefault(); // Empêche le comportement par défaut du lien
                        // Récupérez la valeur de la catégorie à partir de l'attribut data-service
                        const service = link.getAttribute('data-service');
                        // Masquez toutes les sections
                        const sections = document.querySelectorAll('.section');
                        sections.forEach(section => {
                            section.classList.remove('active');
                        });
                        // Affichez la section correspondant au service sélectionné
                        const serviceSection = document.getElementById(service + '-section');
                        if (serviceSection) {
                            serviceSection.classList.add('active');
                        }
                    });
                });  
            });
        </script>
        
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Sélectionnez tous les éléments avec la classe "request_service"
                const continueButtons = document.querySelectorAll('.request_service');
                // Ajoutez un gestionnaire d'événements clic à chaque bouton "continue"
                continueButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); // Empêche le comportement par défaut du bouton
                        // Récupérez la valeur de service à partir de l'attribut data-service
                        const service = button.getAttribute('data-service');
                        // Masquez toutes les sections
                        const sections = document.querySelectorAll('.section');
                        sections.forEach(section => {
                            section.classList.remove('active');
                        });
                        // Affichez la section correspondant au service sélectionné
                        const providerSection = document.getElementById(service + '-section');
                        if (providerSection) {
                            providerSection.classList.add('active');
                        }
                    });
                });
            });
        </script>

        <!-- script de recherche -->
        <script>
            document.getElementById('searchForm').addEventListener('submit', function(event) {
                // Empêcher le comportement par défaut du formulaire de rechargement de la page
                event.preventDefault();
                let searchTerm = document.getElementById('searchInput').value.trim().toLowerCase();
                // Contenu pour Gardening
                let gardeningCards = document.querySelectorAll('.cardContainerX:nth-of-type(1) .cardX');
                gardeningCards.forEach(function(card) {
                    if (card.textContent.toLowerCase().includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
                // Contenu pour Pet Care
                let petCareCards = document.querySelectorAll('.cardContainerX:nth-of-type(2) .cardX');
                petCareCards.forEach(function(card) {
                    if (card.textContent.toLowerCase().includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
                // Contenu pour Bricolage
                let bricolageCards = document.querySelectorAll('.cardContainerX:nth-of-type(3) .cardX');
                bricolageCards.forEach(function(card) {
                    if (card.textContent.toLowerCase().includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        </script>

    </body>
</html>
