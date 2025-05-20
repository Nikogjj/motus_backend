## Voici les commandes à suivre pour executer le backend

Dans votre terminal :

- Cloner le dépôt :
```bash
git clone https://github.com/Nikogjj/motus_backend.git
```
- Se déplacer dans le dossier : `cd motus_backend`
- Installer les dépendances PHP : `composer install`
- Copier le fichier d’environnement : `cp .env.example .env`
- Générer la clé de l’application Laravel : `php artisan key:generate`
- Générer la clé JWT : `php artisan jwt:secret`
- Exécuter les migrations : `php artisan migrate`
- Lancer le serveur : `php artisan serve`

La BDD sqlite est déjà présente dans le repo pas besoin d'en créer une autre.
