# PayAssistant

BankItUp 2017

## Requirements

- MySQL
- PHP 7.1
- Composer

## How to run

```sh
; install composer dependecies
$: composer install --dev

; setup configuration for database migration
$: vim phinx.yml

; execute database migrations
$: vendor/bin/phinx migrate -e development

; database seeds
$: vendor/bin/phinx seed:run

; run development webserver
$: php bin/console server:run
```

## Working with entities & database migration

```sh
; 1) create new database migration
$: vendor/bin/phinx create AddedCommentsTable

; 2) execute migration
$: vendor/bin/phinx migrate -e development

; 3) update entities (add all new properties, setters and getters)

; 4) generate map for entity from database (src/PayAssistantBundle/Resources/config/doctrine/; yml files)
$: php bin/console doctrine:mapping:import PayAssistantBundle yml
```

## Useful scripts

```sh
; generate mappings from database to entity
$: php bin/console doctrine:mapping:import PayAssistantBundle yml

; check mappings, should be OK
$: php bin/console doctrine:schema:validate
```

## How to send call to API

Each call to API needs HTTP headers ```X-Authorization``` or query parameter ```token```.

## Generate APIDOC

You need to installed `npm` plugin "apidoc". `npm install apidoc -g`
Build api: `apidoc -i src/AppBundle/ -o doc`

You HTML docs are available in doc/index.html
