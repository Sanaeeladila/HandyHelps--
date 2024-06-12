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

                <li >
                <a href="{{ route('dashbordPartenaire', ['id_user' => $partenaire->id_user]) }}" class="menu-item" >
    <span class="text" style="margin-left: 50px;">Requests</span>
</a>

                </li>
                
                <li class="active" >
                    <a href="#" class="menu-item" data-target="dashboard-section">
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

                <div id="dashboard-section" class="section ">
                    <h1 style="font-size: 28px; color: #333; margin-bottom: 25px; text-align:center;" >Welcome back <spam style="color: var(--red);">{{ $partenaire->nom ?? '' }} </spam></h1>
                    
                    <div class="profile-picture">
                        <img src="{{ asset($partenaire->profil_picture) }}" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 50%;  margin-left: 40%;">
                    </div>
                    
                    <div class="container">
                        <form method="POST" action="{{ route('update-profile-partenaire') }}" enctype="multipart/form-data">
                            @csrf
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <div class="name-details">
                                <div class="field">
                                    <label for="firstName">FIRST NAME</label>
                                    <input type="text" id="firstName" name="firstName" placeholder="Sanae" value="{{ $partenaire->nom ?? '' }}">
                                </div>
                                <div class="field">
                                    <label for="lastName">LAST NAME</label>
                                    <input type="text" id="lastName" name="lastName" placeholder="El Adila" value="{{ $partenaire->prenom ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cin">CIN</label>
                                <input type="text" id="cin" name="cin" placeholder="L123456" value="{{ $partenaire->cin ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">PHONE</label>
                                <input type="text" id="phone" name="phone" placeholder="06********" value="{{ $partenaire->num_telephone ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="address">ADDRESS</label>
                                <input type="text" id="address" name="address" placeholder="address" value="{{ $partenaire->adresse ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="email">EMAIL</label>
                                <input type="text" id="email" name="email" placeholder="hello@gmail.com" value="{{ $user->email ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="password">PASSWORD</label>
                                <input type="password" id="password" name="password" placeholder="******" >
                            </div>
                            <div class="form-group">
                                <label for="category">CATEGORY</label>
                                <select name="category" id="category">
                                <option value="Gardening">Gardening</option>
                                <option value="PetCare">PetCare</option>
                                <option value="Bricolage">Bricolage</option>
                                </select>                
                            </div>
                            <div class="form-group">
                                <label for="city">CITY</label>
                                <input type="text" id="city" name="city" placeholder="Rabat" value="{{ $partenaire->ville ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="annees_exp">YEARS OF EXPERIENCE</label>
                                <input type="number" id="annees_exp" name="annees_exp" placeholder="5" value="{{ $partenaire->annees_exp ?? '' }}">
                            </div> </br>
                            <label>AVAILABILITY: </label>
                            
                            <div class="form-group">
                                <label  for="jours">Days</label>
                                <div class="form2">
                                    <input type="checkbox" id="jours" name="jours[]" value="Monday">Monday
                                    <input type="checkbox" id="jours" name="jours[]" value="Tuesday">Tuesday
                                    <input type="checkbox" id="jours" name="jours[]" value="Wednesday">Wednesday
                                    <input type="checkbox" id="jours" name="jours[]" value="Thursday">Thursday
                                    <input type="checkbox" id="jours" name="jours[]" value="Friday">Friday
                                    <input type="checkbox" id="jours" name="jours[]" value="Saturday">Saturday
                                    <input type="checkbox" id="jours" name="jours[]" value="Sunday">Sunday
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="heures">Hours</label>
                                <div class="form2">
                                    <input type="checkbox" id="heures" name="heures[]" value="8h-10h">8h-10h
                                    <input type="checkbox" id="heures" name="heures[]" value="10h-12h">10h-12h
                                    <input type="checkbox" id="heures" name="heures[]" value="12h-14h">12h-14h
                                    <input type="checkbox" id="heures" name="heures[]" value="14h-16h">14h-16h
                                    <input type="checkbox" id="heures" name="heures[]" value="16h-18h">16h-18h
                                    <input type="checkbox" id="heures" name="heures[]" value="18h-20h">18h-20h
                                </div>
                            </div>
            
                            <div class="form-group">
                                <label for="profil_picture">PROFILE PICTURE</label>
                                <input type="file" id="profil_picture" name="profil_picture">
                            </div>
                            <div class="form-group">
                                <label for="prix_intervention">PRICE PER HOUR</label>
                                <input type="text" id="prix_intervention" name="prix_intervention" placeholder="100" value="{{ $partenaire->prix_intervention ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="description">DESCRIPTION</label>
                                <textarea id="description" name="description" placeholder="I am a plumber" >{{ $partenaire->description ?? '' }}</textarea>
                            </div>
                            <input type="submit" value="Modify">
                        </form>
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
