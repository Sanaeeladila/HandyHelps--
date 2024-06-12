<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <title>Admin</title>
    <style>
        .section {
            display: none;
        }
        .section.active {
            display: block;
        }
        table {
            width: 80%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px; /* Réduire l'espacement autour du contenu */
            font-size: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        #searchInput {
            margin-bottom: 15px;
            margin-top: 10px;
            width: 35%;
            padding: 8px;
            font-size: 16px;
        }
        a {
            text-decoration: none;
            color: #444444;
        }
        a:hover {
            color: #f00;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <span class="text">
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
                    <span class="text" style="margin-left: 50px;">Experts</span>
                </a>
            </li>
            <li >
                <a href="{{ route('adminclient') }}" class="menu-item" data-target="clients-section">
                    <span class="text" style="margin-left: 50px;">Clients</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminservice') }}" class="menu-item" data-target="services-section">
                    <span class="text" style="margin-left: 50px;">Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admincommentaireclients') }}" class="menu-item" data-target="services-section">
                    <span class="text" style="margin-left: 50px;">Clients Comments</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admincommentairepartenaires') }}" class="menu-item" data-target="services-section">
                    <span class="text" style="margin-left: 50px;">Providers Comments</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="{{ route('home') }}" class="menu-item logout" data-target="settings-section">
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
                <!--
                <a href="#" class="notification" id="notificationLink">
                    <i class='bx bxs-bell' style="font-size: 25px;"></i>
                </a> -->
            </nav>
        <!-- MAIN -->
        <main>
            <div id="dashboard-section" class="section active">
                <div class="head-title">
                    <div class="left">
                        <h1 style="font-size: 34px; text-align:center; margin-left: 350px;">Experts List</h1>
                    </div>
                </div>
                @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                <!-- Barre de recherche -->
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search ..." style="width: 50%; padding: 10px; border: 1px solid #ccc; border-radius: 9px; margin-left: 25%;">
                
                <!-- Tableau des partenaires -->
                <table id="partnersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Profile_Picture</th>
                            <th>First_Name</th>
                            <th>Last_Name</th>
                            <th>CIN</th>
                            <th>Email</th>
                            <th>Profession</th>
                            <th>City</th>
                            <th>Years of Experience</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Intervention_Price</th>
                            <th>Description</th>  
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partners as $partner)
                        <tr>
                            <td>{{ $partner->id }}</td>
                            <td><img src="{{ asset($partner->profil_picture) }}" alt="Profile Picture" style="width: 50px; height: 50px;"></td>
                            <td>{{ $partner->nom }}</td>
                            <td>{{ $partner->prenom }}</td>
                            <td>{{ $partner->cin }}</td>
                            <td>{{ optional($partner->user)->email }}</td>
                            <td>{{ $partner->metier }}</td>
                            <td>{{ $partner->ville }}</td>
                            <td>{{ $partner->annees_exp }}</td>
                            <td>{{ $partner->num_telephone }}</td>
                            <td>{{ $partner->adresse }}</td>
                            <td>{{ $partner->prix_intervention }}</td>
                            <td>{{ $partner->description }}</td>
                            <td>
                                <a href="{{ route('confirm-delete-partenaire', $partner->id) }}">Supprimer</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </section>
    <!-- CONTENT -->

    <script>
        // Fonction de recherche dans le tableau
        function searchTable() {
            var input, filter, table, tr, td, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("partnersTable");
            tr = table.getElementsByTagName("tr");
            for (var i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break; // Affiche la ligne si au moins une colonne correspond à la recherche
                        } else {
                            tr[i].style.display = "none"; // Cache la ligne si aucune colonne ne correspond à la recherche
                        }
                    }
                }
            }
        }
    </script>

</body>
</html>
