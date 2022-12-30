# Symfony TP bonus fin semaine 1
### ➔ Objectifs : vérifier/valider votre bonne compréhension des bases de Symfony.
### ➔ Faites en fonction des modules que vous avez vus (mais vous devriez être au moins au module 6 : les formulaires).

>•Créer un projet Symfony 5.4 permettant de gérer des produits (voir tableau ci-dessous). Il devra être possible d’ajouter, de modifier, de supprimer un produit et d’en afficher la liste.
>
>• Le projet devra intégrer Bootstrap (ou ne pas perdre de temps sur le front, faire au plus simple).
>
>• La base de données devra se nommer « sfbonus ».
>
>• Un menu devra afficher les liens vers la page d’accueil et la liste des produits
>
>• La page d’accueil doit présenter la liste des produits, un bouton « ajouter un produit » et pour chaque produit un lien sur son nom mène à la page détail >ainsi qu’un lien (ou autre) pour éditer le produit.
>
>• Créer une entité Category (voir tableau ci-dessous).
>
>• Configurer la relation Produit/Catégorie : chaque produit appartient à une catégorie (CRUD des catégories si vous êtes arrivé au module 7).
>
>• Ajouter au menu un lien vers la liste des catégories.

>
## Get started :
> Clonez le projet
## Configuration : 
>Créez un fichier '` .env.local `' à la racine et ajoutez la configuration de la connexion à la BDD.

## Installation : 

### <span style="color:green">installer le projet et les dépendances : </span>
> composer install

### <span style="color:green">Creation de la base de données : </span>
> php bin/console doctrine:database:create

### <span style="color:green">Creation de migration :  </span>
> php bin/console make:migration


### <span style="color:green">Migrer : </span>
> php bin/console doctrine:migrations:migrate

## Conclusion :
 <span style="color:green">Let's Go !</span>

 ### Auteurs
![forthebadge](https://forthebadge.com/images/badges/built-by-developers.svg)
> **Georges Ramos** _alias_ [@Jokdeve-Looper](https://github.com/Jokdeve-0)

