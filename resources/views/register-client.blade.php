<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign-up</title>
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
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 10px;
            width: 400px;
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
        .form-group input[type="text"], .name-details input[type="text"], .form-group input[type="password"] {
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <form action="add-client" method="post">
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
            <p><a href="{{ url('login') }}" class="link" style="color: #000000;">Already Registered? Log in here.</a></p>
            <input type="submit" value="Sign up">
        </form>
    </div>
</body>
</html>
