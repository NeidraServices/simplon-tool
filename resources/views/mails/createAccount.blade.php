<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simplon - Confirmation inscription</title>
</head>
<body>
    <p> 
        Bonjour {{ $name }} {{ $surname }}, <br><br>
        Un compte a été créé pour vous sur la plateforme Simplon Tool. <br>
        Votre mot de passe temporaire est le suivant : {{ $temporaryPasswd }}
    </p>

    <p>
        Pour pouvoir vous connecter, vous devez confirmer votre adresse mail en cliquant sur le lien suivant : 
    </p>

    <a href="{{ $url }}"> {{ $url }} </a>
    
    <p> 
        Cordialement, <br>
        L'équipe de Simplon
    </p>
</body>
</html>