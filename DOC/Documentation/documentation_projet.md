E-LAN

# E-LAN

## Objectifs :

-   Interface Bootstrap, avec ou sans template
-   Groupes de 3
-   Sujet libre, mais avec :
    -   MVC
    -   CRUD
    -   User / Password chiffré
    -   2 Rôles user et admin
    -   Concept d’événement
        -   Lieu
        -   Date/heure
        -   Titre
        -   Description
    -   Lien entre user et événement
-   Élèves choisissent un sujet qui respecte les consignes ci-dessus (Multiplex, Vaccin, Festival, …) et le font valider par le PO sur la base d’une liste de features et d’un MCD
-   Le Déploiement Swisscenter
-   Critère d’évaluation :
    -   Analyse fonctionnelle (Tests)
    -   Conception UX (maquettes)
    -   Analyse technique (Tâches)
    -   Réalisation (qualité du code – commentaires – choix des noms - historique).
    -   Procédures de tests (comment le site a été testé)
    -   Qualité du produit du point de vue utilisation (ergonomie, fonctionnalité)
    -   Efficacité – Gestion du temps
    -   Documentation du produit (reproductibilité)

## Description

Notre site permet de faciliter la création et gestion d’évènements "Gaming" LAN.
Une LAN est répartie sur une durée et contiendra plusieurs évènements de type tournois ou ateliers/activité.
Une LAN va comporter plusieurs types événement par exemple un quiz, un stand autre, un événement autre ou encore des tournois de jeux-vidéo,
le site permet une gestion complète et propre à chaque évènement.
Il propose un système de profil utilisateur personnalisable ainsi que des rôles facilitant l’organisation entre gestionnaires et utilisateurs.

## Dans quel contexte le projet est-il réalisé ?

Nous réalisons ce Projet de développement web avec base de données lors de notre 2ᵉ année d’apprentissage le but est de nous faire travailler sur un gros projet en groupe de 3 pour prouver nos compétences en tant que développeur et de gestion de projet.
Nous avons pour base les cours suivants :

-   ICT133 (PHP)
-   ICT151 (PHP+BD)
-   ICT105 (SQL)
-   MA8 (SQL)
-   Projet Web (PHP)

## Organisation

| Nom              | Rôle          |
| ---------------- | ------------- |
| Carrel Xavier    | Product Owner |
| Augsburger Kenan | Scrum Master  |
| Pinto Pedro      | Team Member   |
| Bonzon Yoann     | Team Member   |

## Fonctionnalités

-   Administrateurs
    -   Gestion des utilisateurs/rôles
-   Modérateurs
    -   Gestion de LAN
    -   Gestion d’événements d’une LAN
    -   Création de news
    -   Outils de tournois
-   Utilisateurs
    -   Inscription à des LAN
    -   Inscription à des évènements
    -   Création d’équipes
    -   Modification des informations du compte

## Planification initiale

Sprints (2 semaines par sprint)

1. 26/04/2021 - 09/05/2021
    - Être prêt pour le premier vrai sprint
2. 10/05/2021 - 25/05/2021
    - Authentification
3. 26/05/2021 - 07/06/2021
    - Sprint review le mardi 25.05.2021
4. 08/06/2021 - 21/06/2021
    - Sprint review le mardi 8.06.2021
5. 21/06/2021 - 24/06/2021

## Stratégie de test

### Testeurs

| Nom              | Email                                                       |
| ---------------- | ----------------------------------------------------------- |
| Pedro Pinto      | [pedro.pinto@cpnv.ch](mailto:pedro.pinto@cpnv.ch)           |
| Yoann Bonzon     | [yoann.bonzon@cpnv.ch](mailto:yoann.bonzon@cpnv.ch)         |
| Kenan Augsburger | [kenan.augsburger@cpnv.ch](mailto:kenan.augsburger@cpnv.ch) |

### Matériel/Logiciel de test

| name                 | type     | version | description                                    |
| :------------------- | :------- | :------ | :--------------------------------------------- |
| Dell Optiplex 7040   | Matériel |         | Ordinateurs du cpnv en classe C214             |
| Windows 10 Education | Logiciel | 2004+   | OS                                             |
| php                  | Logiciel | 7.x.x   | Interpréteur php pour faire tourner le serveur |
| chrome               | Logiciel | 85.x.x  | Navigateur pour tester le site                 |
| firefox              | Logiciel | 82.x.x  | Navigateur secondaire                          |

### Contexte de testes

Pour vérifier le fonctionnement du site, les testes sont réalisés en servant en interne accessible par d’autres clients dans le même réseau.
La base de donnée est sur la même machine que le serveur.
Le site web cible desktop et mobile, le site doit donc être responsive pour ces critères.

## Analyse des risques

-   L’absence d’un des participants du projet courte ou longue durée
    -   Dans le but d’éviter d’être trop pénaliser par l’absence d’une personne, nous mettons en place une distribution commune des documents. De ce fait, nous pouvons rapidement reprendre le boulot et même l’attribuer a quelqu’un d’autre.
-   Des problèmes matériels
    -   Nos documents seront disponibles sur un répertoire en ligne a l’abri de pannes matériel cependant si nous venions à perdre nos documents se trouvent sur le cloud le problème serait plus conséquent.
-   Compétences insuffisantes
    -   Pour éviter ce problème nous faisons des Scrum meetings qui nous permettent de parler de nos difficultés rencontrées.
-   Pas d’accès aux technologies requises
    -   Pour éviter d’avoir recours à des technologies inaccessibles nous favorisons l’utilisation des logiciels mis à notre disposition ainsi qu’à des logiciels open source et restons dans la mesure du réalisable vis-à-vis de notre matériel

## Entités

-   Utilisateurs (Contient toutes les informations pour chaque rôle d’utilisateur cette entité est composé du Nom, Prénom, Email, Pseudo, Password )
-   Rôles (Propose les rôles correspondant au type d’utilisateur cette entité est composé du Nom, Description)
-   Lans (Comporte toutes les informations des LANS cette entité est composé du Nom, Description, Places, Début, Fin)
-   Lieux (information de l’endroit où se trouve les événements cette entité est composé du Nom, Adresse)
-   Équipes (liste des noms de groupes de joueurs créer dans la LAN cette entité est composé du Nom, Abréviation)
-   Événements (liste les activités organisées cette entité est composé du nom, description, type, date de début et date de fin d’un événement)
-   Tournois (Contient les informations liées aux différents tournois cette entité est composé du nom du jeu, maximum d’équipe et du nom du tournoi)
-   Matches (Liste les différents matches liés aux tournois cette entité est composé de la date de début et date de fin, numéro de match)
-   État (l’état exprime si une LAN est ouvert, fermé ou en création cette entité est composé du type)

## Journal de bord

| Date             | Description                                                 | Participant                                 |
| ---------------- | ----------------------------------------------------------- | ------------------------------------------- |
| 03/05/2021 15:30 | Validation du MCD par le PO                                 | Pedro P. , Kenan A. et Xavier C.            |
| 10/05/2021 13:40 | Fermeture du sprint 1 pour commencer les taches du sprint 2 | Pedro P., Kenan A. et Yoann B.              |
| 11/05/2021 8:20  | Sprint 1 review                                             | Pedro P. , Yoann B. , Kenan A. et Xavier C. |
| 25/05/2021 8:10  | Sprint 2 review                                             | Pedro P. , Yoann B. , Kenan A. et Xavier C. |
| 08/06/2021 8:05  | Sprint 3 review                                             | Pedro P. , Yoann B. , Kenan A. et Xavier C. |
| 20/06/2021 21:50 | Sprint 4 review                                             | Pedro P. , Yoann B. et Kenan A.             |

# Bilan des objectifs atteints / non-atteints

## Points atteints

| atteints                    | description                                                                                            |
| --------------------------- | ------------------------------------------------------------------------------------------------------ |
| Interface tailwind          | nous avons mis en place une structure tailwind 2.X.X pour traiter la partie graphique de notre projet. |
| Structure MVC               | Nous avons une Structure MVC au point pour qu'on puise gérer aux mieux notre code                      |
| CRUD                        | Nous avons des équipes ainsi que des profiles qui respecte le CRUD                                     |
| faire une gestion de profil | Nous avons un système de login, logout, Creation de compte qui ont des password hashé                  |

## Points non-atteints

| Non-atteints         | Description                                                                                                                                                                            |
| -------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Création de tournois | Nous n'avons pas eu le temps de mettre en place la structure de création de tournois cependant on trouve toujours les informations pour la gestion du tournois sur la Base de données. |
| Modifier un tournois | Vue que nous n'avons pas pu mettre ne place la création de tournois la modification des tournois n'est également pas mise en place                                                     |

# Bilan des points positifs / négatifs

## Points positifs

| Concept                                | Description                                                                                                                                               |
| -------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Apprentissage nouvelles technologies   | Nous avons pu découvrir et apprendre de nouvelles technologies telles que Tailwind et Alipn.JS.                                                           |
| Réalisation d'un site web opérationnel | Malgré le manque de temps pour la gestion des tournois nous avons pu mettre en place une structure opérationnelle et utile avec les autres point atteints |

## Points négatifs

| Concept         | Description                                                                                                                               |
| --------------- | ----------------------------------------------------------------------------------------------------------------------------------------- |
| Viser trop gros | Nous avons eu les yeux plus grands que le ventre et de ce fait nous n'avons pas pu compléter un parte de notre projet par manque de temps |

## Difficultés particulières rencontrées

### Difficultés rencontrées

| Difficulté                   | Description                                                                                                                                                                                                    | Solution                                         |
| ---------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------ |
| L'envie de trop complexifier | Nous avons eu à plusieurs reprise l'envie d'ajouter des fonctionnalités supplémentaires hors du concepts de base ce qui nous aura régulièrement pris du temps qui n'était pas forcément pour le projet de base | Pour contrer ce problème nous avons investi plus |

## Suites possibles

-   Génération d'un arborescence automatique du matchmaking d'un tournois en fonction des équipes.
-   Implémenter un système de demande et d'acceptation lors de la création d'une équipe avec des conditions de création plus strictes.
-   Ajout a l'accueil un calendrier interactif affichant les lans le tournois et les événements avec les dates et heures et une redirection sur la page en question.
