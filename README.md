# Simple Blog PHP MVC

## Description du besoin

Le projet est de développer un blog professionnel en PHP. 

En utilisant la structure MVC (Model View Controller)


## Steps

1.Clonez le dépôt depuis Github.

2. Installez les dépendances du projet avec   `composer install` .

3. Inserez la base de donnés 'BlogMVCP5' au format sql que vous trouverez à la racine du projet. 
   
4. Créez *config/db.php* à partir du fichier *config/db.php.dist* et ajoutez vos paramètres de base de données. 
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```

5. Exécutez le serveur Web PHP interne avec  `php -S localhost:8000 -t public/`. l'option `-t` avec `public` comme paramètre signifie que votre hôte local ciblera le `/public` du dossier.
6. Allez- y sur  `localhost:8000` avec votre navigateur préféré..


### Utilisateurs Windows

Si vous développez sous Windows, vous devez éditer votre configuration git pour changer vos règles de fin de ligne avec cette commande :

`git config --global core.autocrlf true`


### SITE MVC Blog en PHP

![homepage](https://user-images.githubusercontent.com/52566974/124477841-c8501a80-dda4-11eb-893e-93b0b956542a.png)

![listes-article](https://user-images.githubusercontent.com/52566974/124476558-43b0cc80-dda3-11eb-87f1-b990b5d11cca.png)

![login](https://user-images.githubusercontent.com/52566974/124477174-000a9280-dda4-11eb-9705-f75839a5ca5b.png)

![espace_admin](https://user-images.githubusercontent.com/52566974/124478664-b8850600-dda5-11eb-8407-778a4a223271.png)

![admin_commentaire](https://user-images.githubusercontent.com/52566974/124483513-b7a2a300-ddaa-11eb-9b17-cf510e82344e.png)














