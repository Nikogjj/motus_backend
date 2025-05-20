## Voici les commandes à suivre pour executer le backend

Dans votre terminal :

- Cloner le dépôt :
```bash
git clone https://github.com/Nikogjj/motus_backend.git
```
- Se déplacer dans le dossier :
```bash
cd motus_backend
```
- Installer les dépendances PHP :
```bash
composer install
```
- Copier le fichier d’environnement :
```bash
cp .env.example .env
```
- Générer la clé de l’application Laravel :
```bash
php artisan key:generate
```
- Générer la clé JWT :
```bash
php artisan jwt:secret
```
- Exécuter les migrations :
```bash
php artisan migrate
```
- Lancer le serveur :
```bash
php artisan serve
```

La BDD sqlite est déjà présente dans le repo pas besoin d'en créer une autre.
