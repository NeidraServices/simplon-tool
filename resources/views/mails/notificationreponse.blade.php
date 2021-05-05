<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simplon - Nouveau commentaire</title>
</head>
<body>
    <p> 
        Bonjour {{ $com[0]->users->name }} {{ $com[0]->users->surname }}, <br><br>
       {{ $name }} {{ $surname }} a répondu à votre commentaire <br>
        <div style="background-color:lightgrey;padding:10px;">
        {{$com[0]["text"] }}
        </div>
    </p>

    <p> 
        Cordialement, <br>
        L'équipe de Simplon
    </p>
</body>
</html>