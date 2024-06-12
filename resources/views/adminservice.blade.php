<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    <style>
        .section {
            display: none;
        }
        .section.active {
            display: block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        #search {
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
            <li>
            <a href="{{ route('dashbordadmin') }}" class="menu-item" data-target="experts-section">
                    <span class="text" style="margin-left: 50px;">Experts</span>
                </a>
            </li>
            <li>
            <a href="{{ route('adminclient') }}" class="menu-item" data-target="clients-section">
                <span class="text" style="margin-left: 50px;">Clients</span>
            </a>
            </li>
            <li class="active">
                <a href="#" class="menu-item" data-target="services-section">
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
                    <span the="text" style="margin-left: 50px;">Logout</span>
                </a>
            </li>
        </ul>
    </section>
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
                        <h1 style="font-size: 34px; text-align:center; margin-left: 350px;">Services List</h1>
                    </div>
                </div>
            <div id="services-section" class="section active">
                <input type="text" id="search" onkeyup="searchTable()" placeholder="Search ..." style="width: 50%; padding: 10px; border: 1px solid #ccc; border-radius: 9px; margin-left: 25%;">
                <table id="servicesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client_Name</th>
                            <th>Provider_Name</th>
                            <th>Category</th>
                            <th>Service</th>
                            <th>Description</th>
                            <th>Reservation_Date</th>
                            <th>Service_Date</th>
                            <th>Validation_Date</th>
                            <th>Creneau</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->client ? $service->client->nom . ' ' . $service->client->prenom : 'Non assigné' }}</td>
                            <td>{{ $service->partenaire ? $service->partenaire->nom . ' ' . $service->partenaire->prenom : 'Non assigné' }}</td>
                            <td>{{ $service->categorie }}</td>
                            <td>{{ $service->service }}</td>
                            <td>{{ $service->description }}</td>
                            <td>{{ $service->date_reservation }}</td>
                            <td>{{ $service->date_service }}</td>
                            <td>{{ $service->date_validation }}</td>
                            <td>{{ $service->creneau }}</td>
                            <td>{{ $service->statut }}</td>
                            <td>
                                <a href="{{ route('confirm-delete', $service->id) }}">Supprimer</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </section>
    <script>
        function searchTable() {
            var input, filter, table, tr, i, txtValue, found;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("servicesTable");
            tr = table.getElementsByTagName("tr");
            
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                found = false;
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = found ? "" : "none";
            }
        }
    </script>
</body>
</html>
