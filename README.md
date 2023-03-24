# SeFocus

Projet tutoré UE L304

LPMI Groupe 2 (AW-CP 2)

Bellenger Julien, Demoulin Eddy (Demoulin7, Higgs54), Haffner Alexandre, Laurent Alexandre, Nsue Nchama Estefania, Waxin Nathan, Geoffrey Gaye

CMS de groupe http://bjgivep.cluster031.hosting.ovh.net/Groupe2/

Site en ligne : https://climbing-federations.org/ 

# Installation en local : 

Cloner le repos Github : ``` git clone "" ```

Installer php (8.1), symfony (6.2) et composer

Installer un service de base de données mysql, par exemple : xampp

Pour toute autre service modifier dans le fichier .env : ``` DATABASE_URL="database" ``` se référer à la [doc symfony](https://symfony.com/doc/current/doctrine.html).


### Installation des dépendances : 

```
composer install
```

### Création de la base de données : 

```
php bin/console doctrine:database:create 

php bin/console doctrine:migrations:migrate 
```

### Executer les projet : 

```
symfony server:start
```

-> http://127.0.0.1:8000/ 

#### Pour fermer le serveur :

```
symfony local:server:stop
```

### Droits d'accès admin :

Après avoir créer un compte, accéder à la base de données et modifier le rôle ``` ROLE_USER ``` en ``` ROLE_ADMIN ```
