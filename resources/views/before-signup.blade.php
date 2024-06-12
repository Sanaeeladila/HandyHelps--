<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Role</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/1e94604817.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #dcdbd1; /* Changer la couleur de fond */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: "Open Sans", sans-serif; 
        }
        .container {
            background-color: #dcdbd1;
            padding: 20px; /* Augmenter l'espacement intérieur */
            width: 400px;
            text-align: center;
            border-radius: 10px; 
            margin-bottom: 40px; /* Ajouter un espacement en bas */
        }
        h2 {
            font-size: 46px; /* Réduire légèrement la taille de la police */
            margin-bottom: 70px; /* Ajouter un espacement en bas */
        }
        .role-buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .role-buttons a {
            text-decoration: none;
        }
        .role-buttons button {
            padding: 12px 24px; /* Augmenter le rembourrage */
            margin: 0 10px; /* Espacement entre les boutons */
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease; /* Ajouter une transition */
            width: 300px;
        }
        .role-buttons button.client {
            background-color: #000000;
            color: white;
        }
        .role-buttons button.service-provider {
            background-color: #000000;
            color: white;
        }
        .role-buttons button:hover {
            background-color: #f2f2f2;
            color: #000000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Choose Your Role</h2>
        <div class="role-buttons">
            <a href="{{ route('register-client') }}">
                <button class="client">Client</button>
            </a>
            <a href="{{ route('register-provider') }}">
                <button class="service-provider">Service Provider</button>
            </a>
        </div>
    </div>
</body>
</html>
