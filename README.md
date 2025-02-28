# GrandTaxiGo

## Description
GrandTaxiGo est une plateforme de réservation de grands taxis pour des trajets interurbains. Elle permet aux passagers de réserver des trajets et de trouver des chauffeurs disponibles pour des trajets spécifiques. Les chauffeurs, de leur côté, peuvent publier leurs disponibilités et gérer leurs trajets.

## Fonctionnalités

### Authentification et Gestion de Compte
- Inscription avec une photo de profil obligatoire et des informations personnelles.
- Connexion sécurisée avec identifiants.
- Gestion du profil utilisateur.

### Réservation et Gestion des Trajets
- Réservation d'un taxi avec date, lieu de prise en charge et destination.
- Consultation de l'historique des trajets (réservations pour les passagers, courses effectuées pour les chauffeurs).
- Annulation d'une réservation dans un délai déterminé (avant une heure de départ).
- Filtrage des chauffeurs par localisation et disponibilité.
- Acceptation ou refus des réservations par les chauffeurs (Les réservations non acceptées ou annulées avant l'heure de départ seront automatiquement annulées).
- Mise à jour des disponibilités des chauffeurs (avec possibilité d'automatisation).

### Fonctionnalités Bonus
- Notification par email pour le chauffeur en cas de nouvelle demande de réservation.
- Notification par email pour le passager en cas d'acceptation ou d'annulation de sa réservation.
- Notification envoyée au passager et au chauffeur avant l’annulation automatique d’une réservation.
- Automatisation de la gestion des disponibilités des chauffeurs.

## Installation
1. Cloner le projet :
   ```sh
   git clone https://github.com/votre-repo/grandtaxigo.git
   ```
2. Installer les dépendances :
   ```sh
   composer install
   npm install
   ```
3. Configurer l'environnement :
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
4. Configurer la base de données dans `.env` puis exécuter :
   ```sh
   php artisan migrate
   ```
5. Lancer le serveur :
   ```sh
   php artisan serve
   ```

## Contribution
Les contributions sont les bienvenues ! Merci de créer une issue ou une pull request avant toute modification majeure.

## Licence
Ce projet est sous licence MIT.