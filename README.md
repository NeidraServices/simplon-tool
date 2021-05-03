# Application MayProject

## Technologies 

- Laravel 8 (API)
- VueJS et son material design Vuetify

## Initialisation du projet

Après avoir fait un git clone de ce projet, vous devez effectué les actions suivantes : 

- composer install
- npm install
- php artisan passport:install --force
- cp .env.example .env
- php artisan key:generate 
- php artisan migrate:fresh --seed

## Contenu du .env

Vous devez éditer les informations suivantes dans votre .env :

- DB_DATABASE=simplonapp
- DB_USERNAME=
- DB_PASSWORD=

Pour que l'envoie de mails fonctionne il faut modifier les élements suivants avec les informations du serveur de messagerie comme montrer dans l'exemple ci-dessous :

Dans le cas de l'exemple ci-dessous, on utilise mailtrap.

- MAIL_MAILER=smtp
- MAIL_HOST=smtp.mailtrap.io
- MAIL_PORT=2525
- MAIL_USERNAME=
- MAIL_PASSWORD=
- MAIL_ENCRYPTION=tls
- MAIL_FROM_ADDRESS=contact@example.com

## En développement

En développement, veuillez utiliser les commandes suivantes dans des consoles différentes : 

- php artisan serve
- php artisan queue:work
- npm run dev

## Tâches jobs / Asynchrone queue

### Si nous utilisons un VPS :

Pour que l'envoie de mail s'effectue correctement, il faut mettre en place "supervisor" qui va permettre de lancer une commande dédié au queue. Même si le serveur redémarre la commande s'exécutera à nouveau.

- Installation : apt-get install supervisor
- Création du fichier de config : sudo touch /etc/supervisor/conf.d/simplonapp.conf
- Editer le fichier simplonapp.conf et coller le contenu ci-dessous : 

Si le path n'est pas le même, veuillez l'adapter :

```
[program:simplonapp]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/simplonapp/artisan queue:work
autostart=true
autorestart=true
user=root
numprocs=2
redirect_stderr=true
stdout_logfile=/var/log/simplonapp.log
```

- Redemarre le service supervisor : sudo /etc/init.d/supervisor restart

### Si nous n'utilisons pas un VPS

Si nous n'utilisons pas un VPS, il faut modifier les fichiers suivants en enlevant "implement ShouldQueue" au niveau des classes qui permet l'envoi de mail.