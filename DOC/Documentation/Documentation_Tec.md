# Documentation technique du projet (E-LAN)

Cette documentation a pour but de fournir toutes les informations techniques nécessaires à un(e) développeur(se) qui rejoindrait l'équipe.  
Il se présente donc en bonne partie sous forme de questions : les questions que poserait un(e) nouvel(le) arrivant(e).

## utilisation de notre site

Notre site vise les communautés proposent des LAN Gaming nous voulons fournir un outil efficace dans la création et l'organisation de LAN et d’événements. Notre application aura également une gestion de tournois à multiples équipes.

## Hébergement

L’hébergement seras fait sur SwissCenter depuis Filezilla.
Mais durant la phase de développement nous accéderont au site en local.

## Accès

Pour pouvoir accéder à notre site web vous devez installer votre interpréteur et lancer le site en local durant la phase de développement. Par la suite nous disposerons d’un accès en ligne.

## Donnée

Ce site va manipuler les données relatives au MCD et MLD depuis une base de données disponible en local. Vous trouverez ses documents dans le GitHub sous [https://github.com/yovatar/E-LAN/tree/master/DOC7Données](https://github.com/yovatar/E-LAN/tree/master/DOC7Données) :
Tables utilisées :

-   Users
-   Events
-   Images
-   Lans
-   Locations
-   Matches
-   Teams

## composants

Le site se compose d'une architecture en MVC.
Et des librairies AlpineJS pour le Java Script et TailwindCSS pour le CSS.

## Prérequis pour rejoindre le développement

Connaissances nécessaires :

-   PHP
-   HTML
-   CSS
-   JS
-   SQL

## Installation obligatoires

-   Interpréteur de code
-   Base de Données
    -   Connexion à la DB
    -   Client SQL
    -   Scripte de création de la DB
-   NPM
    -   NPM Run
    -   NPM Build
-   Hébergement
    -   Filezilla
    -   Serveur PHP

### Installations facultatives

-   Alpine.js devtools extension chrome.
-   Plugin Tailwind Intellisense (sur PHPStorm).
-   Plugin Alpine.js Support (sur PHPStorm).

## Astuces

Tester les messages d'erreur via la fonction toast:

-   Nous pouvons grâce à la fonction Toast faire des affichages de messages d'erreur test parmi lesquels on trouve (Warning, Info, Error et Success). Donc Il est important d'apprendre l'existence de la fonction toast.

## Interpréteur

L’installation est à votre convenance.

## Base de Donné

Le scripte de création de la DB sera en langage SQL.
Et la DB sera mise en place chez un client SQL.
