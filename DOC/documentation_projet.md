# E-LAN

## Objectifs :

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

## Description

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

Sprints (2 semaines par sprint)

1. Analyse et planification
    - 26/04/2021 - 09/05/2021
    - MCD
    - MLD
    - Documentation du projet
2. Conception
    - 10/05/2021 - 23/05/2021
    - Maquettes
3. Réalisation
    - 24/05/2021 - 06/06/2021
4. Corréction de bugs et Ajout de fonctionnalités
    - 07/06/2021 - 20/06/2021
5. Bouclage et release
    - 21/06/2021 - 24/06/2021

## Stratégie de test

### Testeurs

| Nom              | Email                                                       |
| ---------------- | ----------------------------------------------------------- |
| Pedro Pinto      | [pedro.pinto@cpnv.ch](mailto:pedro.pinto@cpnv.ch)           |
| Yoann Bonzon     | [yoann.bonzon@cpnv.ch](mailto:yoann.bonzon@cpnv.ch)         |
| Kenan Augsburger | [kenan.augsburger@cpnv.ch](mailto:kenan.augsburger@cpnv.ch) |

### Materiel/Logiciel de test

| name                 | type     | version | description                                   |
| :------------------- | :------- | :------ | :-------------------------------------------- |
| Dell Optiplex 7040   | Meteriel |         | Ordinateurs du cpnv en classe C214            |
| Windows 10 Education | Logiciel | 2004+   | OS                                            |
| php                  | Logiciel | 7.x.x   | Interpréteur php pour faire tourner le server |
| chrome               | Logiciel | 85.x.x  | Navigateur pour tester le site                |
| firefox              | Logiciel | 82.x.x  | Navigateur secondaire                         |

### Contexte de testes

Pour verifier le fonctionnement du site, les testes sont réalisés en servant en interne accessible par d'autres clients dans le meme réseau.
La base de donnée est sur la même machine que le serveur.
Le site web cible desktop et mobile, le site doit donc etre responsive pour ces critères.

## Analyse des risques

-   L'absence d’un des participants du projet courte ou longue durée
    -   Dans le but d’éviter d’être trop pénaliser par l’absence d’une personne nous mettons en place une distribution commune des documents. De ce fait nous pouvons rapidement reprendre le boulot et même l’attribuer a quelqu’un d’autre.
-   Des problèmes matériels
    -   Nos documents seront disponibles sur un répertoire en ligne a l’abris de pannes matériel cependant si nous venions à perdre nos documents se trouvent sur le cloud le problème serait plus conséquent.
-   Un objectif irréalisable
    -   Pour éviter un objectif trop ambitieux nous tenons des échanges réguliers avec le PO et fessons les choses petits à petit et ajoutons les suppléments après
-   Des délais trop sérés
    -   Nous veillons à ce que le suivis du temps dû à chaque tache soit minuté et surveillé de manier à éviter au maximum de louper les deadlines
-   Mauvaise répartition des tâches en fonction des compétences de chacun
    -   Pour éviter ce problème nous avons un gestionnaire de projet et fessons des scrum meating réguliers dans le but d’avoir la meilleure distribution des taches possible
-   Pas d’accès aux technologies requise
    -   Pour éviter d’avoir recours à des technologies inaccessibles nous favorisons l’utilisation des logiciels mis à notre disposition ainsi qu’à des logiciels open source et restons dans la mesure du réalisable vis-à-vis de notre matériel

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

| date             | description                                                 | participant                                 |
| ---------------- | ----------------------------------------------------------- | ------------------------------------------- |
| 03/05/2021 15:30 | Validation du MCD par le PO                                 | Pedro P. , Kenan A. et Xavier C.            |
| 10/05/2021 13:40 | Fermeture du sprint 1 pour commencer les taches du sprint 2 | Pedro P., Kenan A. et Yoann B.              |
| 11/05/2021 8:20  | Sprint 1 review                                             | Pedro P. , Yoann B. , Kenan A. et Xavier C. |

## Bilan des objectifs atteints / non-atteints

## Bilan des points positifs / négatifs

## Difficultés particulières rencontrées

## Suites possibles
