# Agence de Voyage - Backend

Ce projet est le back-end d'une plateforme d'agence de voyage, développé avec Symfony. Il gère l'API utilisée par le front-end pour afficher les voyages et traiter les demandes de contact. Il propose également une interface d'administration pour la gestion des voyages et des utilisateurs.

## Lien du projet

- [Interface d'administration - Symfony](https://simplondevgrenoble.nohost.me/amal/tripagencyprod/public/)

## Fonctionnalités

- **API REST** : 
  - Fournit les données des voyages au front-end (Next.js).
- **Administration** :
  - Gestion complète des voyages (ajouter, modifier, supprimer).
  - Gestion des utilisateurs avec rôles (admin et éditeur).
  - Gestion des prises de contact.
- **Sécurité** :
  - Accès à l'API uniquement pour le front-end.
  - Accès à l'administration réservé aux utilisateurs ayant des rôles admin ou éditeur.

## Technologies utilisées

- **Symfony 5.4** : Framework PHP pour la construction du back-end et des services API.
- **Doctrine** : ORM utilisé pour la gestion de la base de données.
- **Twig** : Moteur de templates pour l'interface d'administration.
- **JWT** : Utilisé pour sécuriser les appels à l'API.

## Installation

### Prérequis

- **PHP 8.0** ou plus
- **Composer** : Gestionnaire de dépendances PHP.
- **MySQL** ou une autre base de données relationnelle.

### Instructions

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/nom-utilisateur/agence-voyage-back.git
   cd agence-voyage-back
**Installer les dépendances :**

    ```bash
     composer install
     ```
**Configurer l'environnement : Modifiez le fichier .env pour ajouter vos paramètres de base de données :**
   ```bash
   DATABASE_URL="mysql://username:password@127.0.0.1:3306/tripagency?serverVersion=5.7"
   ```
**Effectuer les migrations :**
   ```bash
   php bin/console doctrine:migrations:migrate
   ```
**Lancer le serveur local :**
   ```bash
   symfony server:start
   ```
