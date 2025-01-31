<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/admin/css/adminlte.css') }}">
    <link rel="shortcut icon" href="{{ asset('/admin/assets/logo.png') }}" type="image/x-icon">
    <title>@yield('title') {{ config('app.name') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fff4c1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 60%;
            max-width: 1200px;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .logo-section {
            flex: 1;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .logo-section img {
            max-width: 70%;
            height: auto;
        }

        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-section form {
            display: flex;
            flex-direction: column;
        }

        .form-section label {
            font-size: 14px;
            margin-bottom: 8px;
            color: #555;
        }

        .form-section input {
            padding: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-section button {
            padding: 12px;
            background-color: #002366;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-section button:hover {
            background-color: #001a4d;
        }

        .vertical-separator {
            width: 0.5px; /* Ajustez cette valeur pour la largeur de la barre */
            height: 70vh; /* Ajustez cette valeur pour la hauteur de la barre */
            background-color: #ccc; /* Couleur de la barre */
            margin: 0 auto; /* Centre la barre horizontalement */
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="logo-section">
            <img src="{{ asset('/admin/assets/logo.png') }}" alt="Logo Africa Business Card">
        </div>
        <div class="vertical-separator"></div>
        <div class="form-section">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('/admin/css/adminlte.js') }}"></script>
</body>
</html>
