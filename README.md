# Brand-List-App
Brand List App An application built using Laravel and HTML CSS. This application lets you manage brands.

## Technologies
Project is created with:

- Laravel: 11.10.0
- PHP: 8.3.8
- MYSQL: 8.1.0

## Requirements
- Stable version of [Docker](https://docs.docker.com/engine/install/)
- Compatible version of [Docker Compose](https://docs.docker.com/compose/install/#install-compose)

## How To Deploy

#### Backend-api Laravel

#### For first time only !
- `git clone https://github.com/nathanigor123/Brand-List-App.git`
- `cd Brand-List-App/backend-api-laravel`
- `cp .env.example .env`
- `docker compose up -d --build`
- `docker compose exec brand-list-api-app  composer install`
- `docker compose exec brand-list-api-app  php artisan key:generate`
- `docker compose exec brand-list-api-app  php artisan migrate --seed`


#### Front-end Html
- `cd Brand-List-App/front-end`
- `docker compose up -d --build`
- `Open: http://localhost:4200`

#### From the second time onwards (Backend and Front-end)
- `docker compose up -d`
- `docker compose down`

