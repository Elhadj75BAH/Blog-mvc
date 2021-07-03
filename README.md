# Simple Blog PHP MVC

## Description du besoin

Le projet est de développer un blog professionnel en PHP. 

En utilisant la structure MVC (Model View Controller)


## Steps

1.Clonez le dépôt depuis Github.

2. Installez les dépendances du projet avec   `composer install` .
   
3. Créez *config/db.php* à partir du fichier *config/db.php.dist* et ajoutez vos paramètres de base de données. 
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```

4. Exécutez le serveur Web PHP interne avec  `php -S localhost:8000 -t public/`. The option `-t` with `public` comme paramètre signifie que votre hôte local ciblera le `/public` du dossier.
5. Allez- y sur  `localhost:8000` avec votre navigateur préféré..


### Utilisateurs Windows

Si vous développez sous Windows, vous devez éditer votre configuration git pour changer vos règles de fin de ligne avec cette commande :

`git config --global core.autocrlf true`
[Diagramme_du_projet.pdf](https://github.com/Elhadj75BAH/Blog-mvc/files/6759187/Diagramme_du_projet.pdf)




