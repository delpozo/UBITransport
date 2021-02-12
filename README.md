# API de  notation d'élèves  
## Installation
Installation via git :

HTTPS
```sh
https://github.com/delpozo/UbiTransport.git
```

SSH
```sh
git@github.com:delpozo/UbiTransport.git
```
Installation des dépendances 
```sh
$ composer install
```
> ** Remarque: ** Cette version de l'API  nécessite une version PHP 7.2 ou supérieure.
### Préparation de la base de données
>Merci de Modifier les paramètres de connexion dans le fichier .env 
>
MYSQL
```yaml
DATABASE_URL="mysql://user:password@127.0.0.1:3306/db_name?mariadb=5.7"
```
PostgresSql 
```yaml
DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
```
Création de la base de données et du schéma de données 
```sh
   php bin/console doctrine:database:create
   ```
```sh
   php bin/console doctrine:schema:create
   ```
Serveur
Vous pouvez lancer le serveur PHP via les commandes suivantes :
```sh
$ php -S localhost:8000 -t public/
 ```
Ou via le serveur Symfony qui fait partie du Symfony binaire créé lorsque vous [installez Symfony](https://symfony.com/download) et prend en charge Linux, macOS et Windows.
```sh
$ symfony serve
 ```
#### Data Fixture
```sh
php bin/console doctrine:fixture:load
```
 >Fixtures (jeu de données) est
> un ensemble de données qui permet d’avoir un environnement de développement proche d’un environnement de production avec des données de test. 
##### Les fixtures se situent dans le dossier src, le dossier s’appelle DataFixtures

## Usage
#### URL de L'API
>http://localhost:8000/api/

>> http://host:Port/api/

#### [Lien de documentation swagger]("http://localhost:8000/api/") 
> http://host:Port/api/

Parfois, vous voudrez peut-être avoir l'API à un emplacement et l'interface utilisateur Swagger à un emplacement différent. 
Cela peut être fait en désactivant l'interface utilisateur Swagger à partir du fichier de configuration API Platform et en 
 ajoutant manuellement le contrôleur de l'interface utilisateur Swagger.
Pour désactiver la documentation, modifier le fichier api_platform.yaml
```yaml
# api/config/packages/api_platform.yaml
api_platform:
    # ...
    enable_swagger_ui: false
    enable_re_doc: false
```
Pour modifier L'URI de la documentation, modifier le fichier routes.yaml
```yaml
# app/config/routes.yaml
swagger_ui:
    path: /docs
    controller: api_platform.swagger.action.ui
```

### Elève 
##### ELEVE_API_IRL : /api/eleves
![](https://i.ibb.co/chDKDkt/Capture-Eleve.png) 
### Note 
![](https://i.ibb.co/5nwFhmS/Capture-Note.png)

Exemple Request body de note:
```http request
{
  "valeur": 22,
  "matiere": "string",
  "eleve": "/api/eleves/1"
}

```

>En cas d'envoi une valeur inférieure à 0 ou supérieur à 20 l'api retournera le message d'erreur suivant :

```http request
{
  "@context": "/api/contexts/ConstraintViolationList",
  "@type": "ConstraintViolationList",
  "hydra:title": "An error occurred",
  "hydra:description": "valeur: Note entre 0 et 20",
  "violations": [
    {
      "propertyPath": "valeur",
      "message": "Note entre 0 et 20",
      "code": "2d28afcb-e32e-45fb-a815-01c431a86a69"
    }
  ]
}
```


### Filtre de recherche
Les supports de filtres `exact`, `partial`, `start`, `end` et les `word_start` stratégies correspondantes :

> `partial` stratégie utilise `LIKE %text%`pour rechercher les champs qui contiennent text.

> `start` stratégie utilise `LIKE text%` pour rechercher les champs commençant par text.

 `end` stratégie utilise `LIKE %text` pour rechercher les champs qui se terminent par text.

> `word_start` stratégie utilise `LIKE text% OR LIKE % text%` pour rechercher des champs contenant des mots commençant par text.

Nous avons activé la stratégie `exacte` pour les deux entités  sur l'id et matière pour l'entité note
>exemple
>![](https://i.ibb.co/CwXR4k5/Capturerech.png)
### Pagination et Tri
## Pagination 

```yaml
        pagination:
            items_per_page: 30 #Nombre des pages par defaut
            client_enabled: true
            enabled_parameter_name : pagination
            client_items_per_page: true # client-side  permet de spécifier le nombre des objets par page 
            items_per_page_parameter_name: itemsPerPage #  nom de paramètre
```            
#### Tri
Nous avons configuré le triage  en ordre descendant sur le champ createdAt.
pour le modifier envoyer `&ordre=`


#### TimestampTrait
les champs `createdAt` , `createdAt` , `createdAt` ,  `deletedAt` , `isdeleted`
sont  optionnels dans les requêtes POST et PUT. Ces champs sont  automatiquement perssités par un `EventSubsciber`
> pour l'afficher dans le JsonResponse d'élève par exemple il  faut ajouter le groupe 
 >exemple :
 ```php

     /**
      * @ORM\Column(type="string", length=60)
      * @Groups({"get-eleve", "get-all-eleve"})
      */
     private $varr; 

 ```
    
