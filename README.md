# PROJET GROUPE : Agenda d'Événements

## Contexte du projet

L'association "Culture 974" veut un site web pour afficher ses événements culturels (concerts, expos, ateliers) et permettre aux visiteurs de s'inscrire.

## Fonctionnalités demandées :

1.  Voir la liste des événements à venir
2.  Filtrer par catégorie (Concert, Expo, Atelier, Conférence)
3.  S'inscrire à un événement (formulaire simple)
4.  Page admin pour voir les inscriptions

## Répartition des rôles (3 développeurs)

Chaque dev a son périmètre COMPLET (Entité → Controller → Template)

| Dev Responsabilité | Branch Git           | Entité      |
| :----------------: | :------------------: | :---------: |
| Dev 1 Événements   | feature/events       | Event       |
| Dev 2 Catégories   | feature/categories   | Category    |
| Dev 3 Inscriptions | feature/inscriptions | Inscription |

## Backlog Kanban

| BACKLOG | À FAIRE | EN COURS | EN REVIEW | DONE |
| :-----: | :-----: | :------: | :-------: | :--: |
|         |         | WIP: 3   | WIP: 2    |      |

-----

## User Stories par développeur :

### DEV 1 - Événements

#### US1.1 - Entité Event

En tant que développeur je veux créer l'entité Event afin de stocker les événements en BDD.

Critères d'acceptation :

  * Champs: id, titre, description, date, lieu, image (nullable)
  * Relation ManyToOne vers Category
  * Migration exécutée sans erreur

#### US1.2 - Liste des événements

En tant que visiteur je veux voir la liste des événements à venir afin de choisir lequel m'intéresse.

Critères d'acceptation :

  * Route GET /events
  * Affiche titre, date, lieu, catégorie
  * Trié par date (plus proche en premier)
  * Seulement les événements futurs

#### US1.3 - Détail d'un événement

En tant que visiteur je veux voir le détail d'un événement, afin d'avoir toutes les informations.

Critères d'acceptation :

  * Route GET /events/{id}
  * Affiche tous les champs
  * Bouton "S'inscrire" qui redirige vers /inscription/{eventId}
  * Gestion 404 si event n'existe pas

### DEV 2 - Catégories

#### US2.1 - Entité Category

En tant que développeur je veux créer l'entité Category afin de classer les événements.

Critères d'acceptation :

  * Champs: id, nom, couleur (code hex), icone (emoji)
  * Relation OneToMany vers Event
  * Fixtures avec 4 catégories (Concert, Expo, Atelier, Conférence)

#### US2.2 - Liste des catégories

En tant que visiteur, je veux voir les catégories disponibles, afin de filtrer les événements.

Critères d'acceptation :

  * Route GET /categories
  * Affiche nom + icône + nombre d'événements
  * Clic sur catégorie filtre les événements

#### US2.3 - Filtrage par catégorie

En tant que visiteur je veux filtrer les événements par catégorie afin de voir seulement ce qui m'intéresse.

Critères d'acceptation :

  * Route GET /events?category={id}
  * Liste filtrée par catégorie
  * Indication visuelle de la catégorie active

#### US2.4 - Navbar avec catégories

En tant que visiteur je veux voir les catégories dans la navbar, afin de naviguer facilement.

Critères d'acceptation :

  * Menu déroulant dans la navbar
  * Affiche toutes les catégories
  * Intégré dans base.html.twig

### DEV 3 - Inscriptions

#### US3.1 - Entité Inscription

En tant que développeur je veux créer l'entité Inscription afin de stocker les inscriptions aux événements.

Critères d'acceptation :

  * Champs id, nom, email, telephone, nombrePlaces, createdAt
  * Relation ManyToOne vers Event
  * Migration exécutée sans erreur

#### US3.2 - Formulaire d'inscription

En tant que visiteur je veux m'inscrire à un événement afin de réserver ma place.

Critères d'acceptation :

  * Route GET/POST/inscription/{eventId}
  * Formulaire avec email requis
  * Message de confirmation après soumission
  * Redirection vers page de l'événement

-----

#### US3.3 - Page admin inscriptions

En tant qu'admin je veux voir la liste des inscriptions, afin de gérer les participants.

Critères d'acceptation :

  * Route GET /admin/inscriptions
  * Liste toutes les inscriptions avec nom événement
  * Filtrable par événement
  * Affiche le total des places réservées

## Setup initial (à faire ensemble)

### Un seul dev crée le repo GitHub

  * Créer le repo sur GitHub (avec README)
  * Ajouter les autres en collaborateurs

### Tous les devs clonent

``` 
git clone https://github.com/[username]/agenda-events.git
cd agenda-events

```

### Chaque dev crée sa branche

  * Dev 1
    
    ``` 
    git checkout -b feature/events
    
    ```

  * Dev 2
    
    ``` 
    git checkout -b feature/categories
    
    ```

  * Dev 3
    
    ``` 
    git checkout -b feature/inscriptions
    
    ```

## Relations entre entités

``` mermaid
erDiagram
    Category ||--o{ Event : "1:N"
    Event ||--o{ Inscription : "1:N"

    Category {
        id
        nom
        couleur
        icone
    }
    Event {
        id
        titre
        description
        date
        lieu
        category_id
        image
    }
    Inscription {
        id
        nom
        email
        telephone
        nombrePlaces
        event_id
        createdAt
    }

```

*Note: The mermaid diagram is an interpretation of the relationship table for better readability in markdown, based on the following text:*

| Category      |     | Event              |     | Inscription           |
| :-----------: | :-: | :----------------: | :-: | :-------------------: |
| id            | 1:N | id                 | 1:N | id                    |
| nom           |     | titre              |     | nom                   |
| couleur icone |     | description date   |     | email                 |
|               |     | lieu               |     | telephone             |
|               |     | category\_id image |     | nombrePlaces event id |
|               |     |                    |     | createdAt             |

## Checklist de livraison

L'équipe doit avoir :

  * Tableau Kanban à jour (toutes les cartes en "Done")
  * Application fonctionnelle sur http://localhost:8080
  * Pas de conflit non résolu
  * README mis à jour avec les fonctionnalités
