# educational-botnet
Création d'une application qui permet d'éxécuter des tâches sur des ordinateurs via un agent.

## Liste des tâches et planification initiale
Sur un principe de 4 sprints de 2 semaines

### 1er sprint
- En tant que Hacker je dois pouvoir m'authentifier

### 2ème sprint
- En tant qu'administrateur je dois me pouvoir gérer les utilisateurs et leurs droits
- En tant que Bot je dois pouvoir afficher des informations de debug
- En tant que Hacker je dois pouvoir gérer la liste d'ordniateur

### 3ème sprint
- En tant que Hacker je dois pouvoir transmettre des tâches
- En tant qu'Application web je dois pouvoir éxécuter des tâches
- En tant que Bot je dois pouvoir effecturer un attaque DOS

### 4ème sprint
- En tant que Bot je dois pouvoir infecter un ordinateur
- En tant que Bot je dois pouvoir désinfecter un ordinateur

## Installation du serveur Php

### Liens utiles :
- composer: https://getcomposer.org/download/
- laravel: https://laravel.com/docs/5.4

### Dépendances
- mysql/mariaDb: https://mariadb.org/

### Pour lancer le serveur la première fois

```sh
composer install
php artisan install
cp .env.example .env
php artisan key:generate
```

Allez faire la configuration dans le fichiers use Illuminate\Support\Str;
.env

```sh
php artisan migrate
php artisan serve
```
### Pour recréer la DB depuis le début et peupler la base
```sh
php artisan migrate:refresh
php artisan db:seeds
```

### Mise à jour de doctrine/dbal
```sh
composer require doctrine/dbal
composer update
```
