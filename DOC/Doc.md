# E-LAN

# Objectifs :

-   Interface Bootstrap, avec ou sans template
-   Groupes de 3
-   Sujet libre, mais avec:
    -   MVC
    -   CRUD
    -   User / Password chiffré
    -   2 Rôles user et admin
    -   Concept d'événement
        -   lieu
        -   Date/heure
        -   Titre
        -   Description
    -   Lien entre user et événement
-   Elèves choisissent un sujet qui respecte les consignes ci-dessus (Multiplex, Vaccin, Festival,…) et le font valider par le PO sur la base d’une liste de features et d’un MCD
-   Le Déploiment Swisscenter
-   Critère d'évaluation:
    -   Analyse fonctionnelle (Tests)
    -   Conception UX (maquettes)
    -   Analyse technique (Tâches)
    -   Réalisation (qualité du code – commentaires – choix des noms - historique).
    -   Procédures de tests (comment le site a été testé)
    -   Qualité du produit du point de vue utilisation (ergonomie, fonctionnalité)
    -   Efficacité – Gestion du temps
    -   Documentation du produit (reproductibilité)

# Description

Notre site permet de faciliter la création et gestion d'évènements "Gaming" LAN.
Une LAN est répartie sur une durée et contiendra plusieurs évènements de type tournois ou ateliers/activité.
Une LAN va comporter plusieurs types évenement par exemple un quiz, un stand autre, un évemenet autre ou encore des tournois de jeux-vidéo,
le site permet une gestion complète et propre à chaque évènement.
Il propose un système de profil utilisateur personalisable ainsi que des rôles facilitant l'oraganisation entre géstionnaires et utilisateurs.

## Dans quel contexte le projet est-il réalisé ?

Nous réalisont se Projet de dévelopement web avec base de donnée lors de notre 2ème année d'apprentisage le but et de nous faire travailler sur un gros projet en groupe de 3 pour prouver nos compétence en tant que développeur et de gestion de projet

## Organisation

| Nom              | Role          |
| ---------------- | ------------- |
| Carrel Xavier    | Product Owner |
| Augsburger Kenan | Scrum Master  |
| Pinto Pedro      | Team Member   |
| Bonzon Yoann     | Team Member   |

## Fonctionnalités

-   Administrateurs
    -   Gestion des utilisateurs/roles
-   Modérateurs
    -   Gestion de LAN
    -   Gestion d'événements d'une LAN
    -   Création de news
    -   Outils de tournois
-   Utilisateurs
    -   Inscription à des LAN
    -   Inscription à des évènements
    -   Création d'équipes
    -   Modification des information du compte

## Planification initiale

### Stratégie de test

### Testeurs

| Nom              | Email                                                       |
| ---------------- | ----------------------------------------------------------- |
| Pedro Pinto      | [pedro.pinto@cpnv.ch](mailto:pedro.pinto@cpnv.ch)           |
| Yoann Bonzon     | [yoann.bonzon@cpnv.ch](mailto:yoann.bonzon@cpnv.ch)         |
| Kenan Augsburger | [kenan.augsburger@cpnv.ch](mailto:kenan.augsburger@cpnv.ch) |

### Materiel/Software de test

| name   | type     | version | description                                   |
| :----- | :------- | :------ | :-------------------------------------------- |
| php    | software | 7.x.x   | Interpréteur php pour faire tourner le server |
| npm    | software | 7.5.4   | Dependency manager                            |
| chrome | software | 85.x.x  | Navigateur pour tester le site                |

---

### Fonctionnalités à tester

-   Vues
    -   Apparence (erreurs visuels / sens compréhensibilité des controls)
    -   Charge de travail
    -   Bon fonctionnement des contrôles
    -   Retour utilisateur
-   Controller
    -   Traitement et assainissement des données
    -   Sécurité (blockage des actions selon droits)
-   Model
    -   Format des données
    -   Risques de corruption

## Analyse des risques

## Entités

-   Utilisateurs (Contient tout les informations pour chaque rôle d'utilisateur cette entité est composé du Nom,Prénom,Email,Pseudo,Password )
-   Rôles (Propose les rôles coréspondant au type d'utilisateur cette entité est composé du Nom,Description)
-   Lans (Comporte tout les informations des LANS cette entité est composé du Nom,Description,Places,Début,Fin)
-   Lieux (information de l'endroit ou se trouve les évenements cette entité est composé du Nom,Adresse)
-   Équipes (liste des nom de groupes de joueurs créer dans la LAN cette entité est composé du Nom,Abréviation)
-   Événements (liste les activités ordganisé cette entité est composé du nom,description, type , date de début et date de fin d'un événement)
-   Tournois (Contient les information lié au différent tournois cette entité est composé du nom du jeux,maximum d'équipe et du nom du tournoi)
-   Matches (Liste les differents matches liées aux tournois cette entité est composé de la date de début et date de fin, numéro de match)
-   état (l'état exprime si une LAN est ouvert, fermé ou en création cette entité est composé du type)

## Journal de bord

## Bilan des objectifs atteints / non-atteints

## Bilan des points positifs / négatifs

## Difficultés particulières rencontrées

## Suites possibles
