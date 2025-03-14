<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Accès à la plateforme</title>
</head>
<body>
    <h2>Bienvenue {{ $user->name }} !</h2>
    <p>Votre compte a été créé avec succès. Voici vos identifiants :</p>

    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Mot de passe :</strong> {{ $password }}</p>

    <p>Vous pouvez vous connecter en cliquant sur le lien ci-dessous :</p>
    <a href="{{ url('/login') }}" style="padding: 10px 15px; background-color: blue; color: white; text-decoration: none; border-radius: 5px;">Connexion</a>

    <p>Nous vous recommandons de changer votre mot de passe dès votre première connexion.</p>

    <p>Merci,</p>
    <p>L'équipe de support</p>
</body>
</html>
