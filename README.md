# SMS Sender Project

## Description
SMS Sender est une application PHP simple mais puissante qui permet d'envoyer des SMS via l'API OVH et de stocker l'historique des messages envoyés dans une base de données MySQL.

## Fonctionnalités
- Envoi de SMS via l'API OVH
- Stockage de l'historique des SMS dans une base de données MySQL
- Interface utilisateur simple pour l'envoi de SMS
- Affichage de l'historique des SMS envoyés

## Structure du Projet
```
sms-sender/
├── config/
│   └── config.php
├── src/
│   ├── Database.php
│   ├── SMS.php
│   └── SMSRepository.php
├── public/
│   └── index.php
├── vendor/
├── composer.json
└── composer.lock
```

## Prérequis
- PHP 8.3.8 ou supérieur
- Composer
- MySQL
- Compte OVH avec accès à l'API SMS

## Installation
1. Clonez ce dépôt :
   ```
2. Installez les dépendances via Composer :
   ```
   composer install
   ```
3. Copiez `config/config.php.example` vers `config/config.php` et remplissez-le avec vos informations :
   ```php
   return [
       'db' => [
           'host' => 'localhost',
           'name' => 'sms_sender',
           'user' => 'votre_utilisateur',
           'pass' => 'votre_mot_de_passe'
       ],
       'ovh' => [
           'application_key' => 'votre_application_key',
           'application_secret' => 'votre_application_secret',
           'consumer_key' => 'votre_consumer_key',
           'endpoint' => 'ovh-eu'
       ]
   ];
   ```
4. Créez la base de données et la table nécessaire :
   ```sql
   CREATE DATABASE sms_sender;
   USE sms_sender;
   CREATE TABLE sms_messages (
       id INT AUTO_INCREMENT PRIMARY KEY,
       recipient VARCHAR(20) NOT NULL,
       message TEXT NOT NULL,
       sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

## Utilisation
1. Assurez-vous que votre serveur web pointe vers le dossier `public/`.
2. Accédez à l'application via votre navigateur.
3. Remplissez le formulaire avec le numéro de téléphone du destinataire et le message.
4. Cliquez sur "Envoyer" pour envoyer le SMS.

## Architecture et Concepts
- **Programmation Orientée Objet (POO)** : Utilisation de classes et d'objets pour une meilleure organisation du code.
- **Pattern Repository** : `SMSRepository` gère l'accès aux données, séparant la logique métier de la persistance.
- **Gestion des Dépendances** : Utilisation de Composer pour l'autoloading et la gestion des dépendances.
- **Séparation des Responsabilités** : Chaque classe a un rôle spécifique, améliorant la maintenabilité du code.
- **Abstraction de la Base de Données** : La classe `Database` fournit une interface unifiée pour les opérations de base de données.
- **Gestion des Erreurs** : Utilisation de try-catch pour une gestion robuste des exceptions.
- **Configuration Externalisée** : Les paramètres sensibles sont stockés dans un fichier de configuration séparé.

## Licence
Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## Contact
Pour toute question ou suggestion, n'hésitez pas à me contacter à j.bouddehbine@it-students.fr
