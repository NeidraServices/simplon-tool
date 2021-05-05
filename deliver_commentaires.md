# Infos

L'idée c'est récupérer les commentaires d'un et leurs réponses.

Pour ce faire il faudrait lier la table à elle même.

Tout d'abord il faut ajouter au modèle la liaison :

```php
    public function commentaires(){
        return $this->hasMany(Deliver_CommentairesModel::class,"commentaire_id","id");
    }
```

Ensuite dans le controller, on récuppère les commentaires et leur réponses :

```php
$com = Deliver_CommentairesModel::with("reponses")->where("commentaire_id", null)->where("projet_id", 1)->get();
```

Ensuite on réccupère les infos :

```vuejs
$com->users // pour l'utilisateur
$com->reponse //pour les réponses
```
