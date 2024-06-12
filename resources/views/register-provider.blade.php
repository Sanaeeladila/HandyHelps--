<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/1e94604817.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #ffffff;
            padding: 10px;
            width: 600px;
            text-align: center;
        }
        h2 {
            font-size: 54px;
            font-family: "Open Sans", serif;
        }
        .name-details{
            display: flex;
            gap: 16px;
        }
        .name-details .field:first-child{
            margin-right: 10px;
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }
        .name-details .field:last-child{
            margin-left: 10px;
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }
        .form-group input[type="text"], .name-details input[type="text"], .form-group input[type="password"], .form-group input[type="number"], .form-group input[type="date"], .form-group input[type="file"], .form-group textarea{
            width: 100%;
            padding: 10px 20px;
            border: 1.5px solid #000000;
            box-sizing: border-box;
        }
        .form-group select {
            width: 100%;
            padding: 10px 20px;
            border: 1.5px solid #000000;
            box-sizing: border-box;
        }
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px 20px;
            border: 1.5px solid #000000;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #000000;
            color: #ffffff;
            font-size: 15px;
            font: bold;
            padding: 10px 20px;
            margin: 6px 0;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
        }
        .link:hover {
            text-decoration: none;
        }
        .form-group2 input[type="checkbox"] {
            margin-right: 3px; 
            vertical-align: middle; 
        }
        .form-group2 label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }
        .form-group input[type="checkbox"] {
            margin-right: 14px; 
            vertical-align: middle; 
        }
        .form2 {
            width: 100%;
            padding: 10px 20px;
            border: 1.5px solid #000000;
            box-sizing: border-box;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <form action="add-partenaire" method="post" enctype="multipart/form-data">
            @csrf
            <div class="name-details">
                <div class="field">
                    <label for="firstName">FIRST NAME</label>
                    <input type="text" id="firstName" name="firstName" placeholder="Sanae">
                </div>
                <div class="field">
                    <label for="lastName">LAST NAME</label>
                    <input type="text" id="lastName" name="lastName" placeholder="El Adila">
                </div>
            </div>
            <div class="form-group">
                <label for="cin">CIN</label>
                <input type="text" id="cin" name="cin" placeholder="L123456">
            </div>
            <div class="form-group">
                <label for="phone">PHONE</label>
                <input type="text" id="phone" name="phone" placeholder="06********">
            </div>
            <div class="form-group">
                <label for="address">ADDRESS</label>
                <input type="text" id="address" name="address" placeholder="address">
            </div>
            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="text" id="email" name="email" placeholder="hello@gmail.com">
            </div>
            <div class="form-group">
                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password" placeholder="******">
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
                <input type="text" id="city" name="city" placeholder="Rabat">
            </div>
            <div class="form-group">
                <label for="annees_exp">YEARS OF EXPERIENCE</label>
                <input type="number" id="annees_exp" name="annees_exp" placeholder="5">
            </div>
            <label>AVAILABILITY: </label>
            
            <div class="form-group2">
                <label for="jours">Days</label>
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
                <input type="text" id="prix_intervention" name="prix_intervention" placeholder="100">
            </div>
            <div class="form-group">
                <label for="description">DESCRIPTION</label>
                <textarea id="description" name="description" placeholder="I am a plumber"></textarea>
            </div>
            <p><a href="{{ url('login') }}" class="link" style="color: #000000;">Already Registered? Log in here.</a></p>
            <input type="submit" value="Sign up">
        </form>
    </div>
</body>
</html>
