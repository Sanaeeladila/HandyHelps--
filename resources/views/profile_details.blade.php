<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style3.css') }}">
    <script src="https://kit.fontawesome.com/1e94604817.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1 style="font-size: 24px; color: #333; margin-bottom: 10px; margin-top: 30px;">{{ $partner->nom }}</h1>
    <div class="cardZ" style="width: 100%;">
        <div class="profileInfo">
            <img src="{{ asset($partner->profil_picture) }}" alt="Profile Picture" class="profilePic" style="width: 100px; height: 100px;">
            <div class="user-info" style="margin-left: 70px;">
                <div class="user-name">About me</div>
                <p style="margin-right:30px;">{{ $partner->description }}</p>  
            </div>
        </div>
        <div class="serviceZ">{{ $partner->metier }}</div>
        <div class="grade"><i class="fa-solid fa-star" style="color: #FFD43B; margin-left: 30px;"></i> {{ $partner->moy_evaluation }}</div>
        <div class="address"><i class="fa-solid fa-location-dot" style="color: #BBBBBB; margin-left: 30px;"></i> {{ $partner->adresse }}</div>
    </div>


    <h1 style="font-size: 24px; color: #333; margin-bottom: 10px; margin-top: 30px; ">Reviews</h1>
    <div class="card-container">
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

    <style>
        body {  padding: 0; margin-left: 130px; margin-top: 20px; font-size:20px;}
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
        .card3 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; width: 320px; height: 250px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
        .card-container { display: flex; flex-wrap: wrap; gap: 40px; padding: 20px; }
        .card1 { display: flex; flex-direction: column; align-items: center; padding: 15px; border: 1px solid #f3f3f4; border-radius: 10px; max-width: 245px; height: 250px; background-color: #f3f3f4; position: relative;  text-align: center; padding-bottom: 50px; margin-left: 10px; }
        .title_card1 { font-size: 15px; font-weight: bold; margin-bottom: 5px; margin-top: 10px; }
        .parag_card1 { font-size: 14px; margin-bottom: 5px; }
        #Review { position: absolute; bottom: 20px; background-color: #ff914d; color: #fff; border: none; width: 70%; padding: 10px 20px; border-radius: 20px; font: bold; cursor: pointer; }
        .form-group input[type="number"]{ width: 100%; padding: 10px 20px; border: 1.5px solid #000000; box-sizing: border-box; }
    </style>
</body>
</html>



