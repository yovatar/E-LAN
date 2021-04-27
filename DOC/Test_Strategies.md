# Documentation de tests

## Canvas de test

|                    |              |
| ------------------ | ------------ |
| **Bom du rapport** | [name]       |
| **Date**           | [dd/mm/yyyy] |

### Testeur

| Name | Email | Github profile link |
| ---- | ----- | ------------------- |
|      |       |                     |

### Materiel/Software de test

| name   | type     | version | description                                   |
| :----- | :------- | :------ | :-------------------------------------------- |
| php    | software | 7.x.x   | Interpréteur php pour faire tourner le server |
| npm    | software | 7.5.4   | Dependency manager                            |
| chrome | software | 85.x.x  | Navigateur pour tester le site                |

### Tests

| title                                                | description                                                     | date       | result | description du résultat |
| ---------------------------------------------------- | --------------------------------------------------------------- | ---------- | :----: | ----------------------- |
| [View] création de compte entrée valide              | Es-ce que la validation en temps réel fonctionne                | xx/xx/2021 |   ✅   |                         |
| [Controller] validation d'entrées création de compte | Es-ce que la validation d'entrées dans le controller fonctionne | xx/xx/2021 |   ❌   | Injection XSS possibles |

<br>

---

## Fonctionnalités à tester

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
