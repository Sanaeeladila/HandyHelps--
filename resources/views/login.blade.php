<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            margin-top: 0;
            font-size: 56px;
            font-family: "Open Sans", serif;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 14px 20px;
            border: 1.5px solid #000000;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #000000;
            color: #ffffff;
            font-size: 20px;
            font: bold;
            padding: 14px 20px;
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
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="text" id="email" name="email" placeholder="hello@gmail.com" value="{{ old('email') }}">

            </div>
            <div class="form-group">
                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password" placeholder="******">
            </div>
            @error('email')
            <p style="color: red;">{{ $message }}</p>
            @enderror
            <p><a href="{{ url('before-signup') }}" class="link" style="color: #000000;">Create an account</a></p>
            <input type="submit" value="Connexion">
        </form>
    </div>
</body>
</html>
