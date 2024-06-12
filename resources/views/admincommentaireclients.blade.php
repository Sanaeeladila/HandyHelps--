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
            color: #444444;;
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
                <a href="{{ route('adminclient') }}" class="menu-item" data-target="dashboard-section">
                    <span class="text" style="margin-left: 50px;">Clients</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminservice') }}" class="menu-item" data-target="services-section">
                    <span class="text" style="margin-left: 50px;">Services</span>
                </a>
            </li>
            <li class="active">
                <a href=8 class="menu-item" data-target="services-section">
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
                <a href="{{ route('home') }}" class="menu-item logout" data-target="logout-section">
                    <span class="text" style="margin-left: 50px;">Logout</span>
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
                        <h1 style=" font-size: 34px; text-align:center; margin-left: 325px;">Clients Comments</h1>
                    </div>
                </div>
                <div id="clients-section" class="section active">
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

                    <input type="text" id="search" onkeyup="searchTable()" placeholder="Search ..." style="width: 50%; padding: 10px; border: 1px solid #ccc; border-radius: 9px; margin-left: 25%;">
                    <table>
                        <thead>
                            <tr>
                                <th>From Client</th>
                                <th>To Expert</th>
                                <th>Service</th>
                                <th>Comment</th>
                                <th>Date</th>
                                <th>Rating</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commentaires as $commentaire)
                            <tr>
                                <td>{{ $commentaire->client->nom }} {{ $commentaire->client->prenom }}</td>
                                <td>{{ $commentaire->partenaire->nom }} {{ $commentaire->partenaire->prenom }}</td>
                                <td>
                                    @if ($commentaire->service)
                                        {{ $commentaire->service->categorie }}
                                    @endif
                                </td>
                                <td>{{ $commentaire->commentaire }}</td>
                                <td>{{ $commentaire->date }}</td>
                                <td>{{ $commentaire->rating }}</td>
                                <td>
                                    <!-- Assurez-vous que l'ID du commentaire est passé en paramètre -->
                                    <a href="{{ route('confirm-delete-commentclient', ['id' => $commentaire->id_commentaire]) }}">Supprimer</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>


    <script>
        function searchTable() {
            var input, filter, table, tr, td, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("content").getElementsByTagName("table")[0];
            tr = table.getElementsByTagName("tr");
            for (var i = 1; i < tr.length; i++) {
                tr[i].style.display = "none"; // hide all rows by default
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = ""; // show row if any cell matches
                            break;
                        }
                    }
                }
            }
        }
    </script>
</body>
</html>        
