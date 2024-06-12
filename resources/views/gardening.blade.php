<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gardening</title>
        <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
        <script src="https://kit.fontawesome.com/1e94604817.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <style>
            body{    margin: 0;    padding: 0;    background-color: #86bd5f; }
            .handyhelps{    font-size: 20px;    color: black;    padding-left: 10px;    text-decoration: none;    padding-bottom: 25px; }
            .navbar{    background-color: #ffffff;    padding: 0 20px;    height: 70px;  }
            h1{    text-align: center;    font-size: 45px;    color: #ffffff;    /* padding-top: 10px; */    font-family: "Open Sans", serif; }
            .phrase{    font-size: 25px;    padding-left: 40px;    color: #ffffff; }
            p{    text-align: center;    font-size: 25px;    font-family: "Kanit", sans-serif;    padding-left: 40px;    padding-right: 40px; }
            .navbar-brand{    text-decoration: none;    color: #000000; }
            .card-container {    display: flex;    flex-wrap: wrap;    justify-content: center;    gap: 100px;     padding: 20px; }
            .card {    display: flex;    flex-direction: column;    align-items: center;    padding: 15px;    border: 1px solid #ccc;    border-radius: 10px;    max-width: 200px;    height: 180px;    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);    position: relative;     text-align: center;    padding-bottom: 50px;  }
            .profile-info {    display: flex;    align-items: center;    margin-bottom: 15px; }
            .profile-pic {    width: 80px;    height: 80px;    border-radius: 50%;    margin-right: 20px; }
            .user-info {    text-align: left; }
            .user-name {    font-size: 18px;    font-weight: bold;    margin-bottom: 5px; }
            .address {    font-size: 14px;    color: #BBBBBB;    margin-bottom: 5px; }
            .grade {    font-size: 14px;    color: #FFD43B;    margin-bottom: 5px; }
            .service {    position: absolute;    bottom: 100px;    left: 50%;    transform: translateX(-50%); }
            .view-profile {    position: relative;    bottom: 10px;     background-color: #16703c;    color: #fff;    border: none;    padding: 10px 20px;    border-radius: 20px;    cursor: pointer; margin-right: 10px;    margin-top: 70px;}
            .view-profile:hover {    background-color: #BBBBBB; }
        </style>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <ul>
                    <li><img src="img/logo.png" style="height:35px; padding-bottom: 20px;"> </li>
                    <li class="handyhelps"><a class="navbar-brand" href="{{ route('home') }}">HandyHelps</a> </li>
                </ul>
            </div>
        </nav>

        <h1>Gardening</h1>

        <p>From <strong>garden planting</strong> to <strong>landscape design</strong> and <strong>garden maintenance</strong>, we've got all your gardening needs covered.</p>
        
        <div class="phrase">Our available partners</div>

        <div class="card-container">
            @foreach($gardeningPartners as $gardner)
            <div class="card">
                <div class="profile-info">
                    <img src="{{ asset($gardner->profil_picture) }}" alt="Profile Picture" class="profile-pic">
                    <div class="user-info">
                        <div class="user-name">{{ $gardner->nom }}</div>
                        <div class="address"><i class="fa-solid fa-location-dot" style="color: #BBBBBB;"></i> Tetouan</div>
                        <div class="grade"><i class="fa-solid fa-star" style="color: #FFD43B;"></i>{{ $gardner->moy_evaluation}}</div>
                    </div>
                </div>
                <div class="service">{{$gardner->metier}}</div>
                <a href="{{ route('profile.details', $gardner->id) }}"><button class="view-profile">VIEW PROFILE</button> </a>
            </div>
            @endforeach
        </div>

    </body>
</html>
