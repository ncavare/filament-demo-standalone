# Filament Stand Alone Demo App

A demo app to demonstrate how the Filament component works without a full admin panel

This demo include this 3 components :

Filament form builder : https://filamentphp.com/docs/2.x/forms/installation

Filament table builder : https://filamentphp.com/docs/2.x/tables/installation

Filament notfication : https://filamentphp.com/docs/2.x/notifications/installation

## Why?

Filament offers a demo of its application but there is no demo of the components used in standalone mode.

This can be useful if you want to completely customize the layout, have more control.

## Feature

This can list posts and edit a post with comments.

Create and Modify are in the same livewire component.

This saves the post relationships and sends a notification like in the admin panel.

List posts

![screenshot list](./screenshot/screen1.jpg)

Edit post and comments

![screenshot edit](./screenshot/screen2.jpg)


## Installation

Clone the repo locally
```sh
git clone https://github.com/ncavare/filament-demo-standalone.git my-filament-demo-standalone
```

Go to this directory
```sh
cd my-filament-demo-standalone
```

Create .env configuration
```sh
cp .env.example .env
```

Install PHP dependencies
```sh
composer install
```

Build the asset
```sh
npm install
npm run build
```

Generate application key:
```sh
php artisan key:generate
```

Run database migrations
Sai yes to create database/database.sqlite
```sh
php artisan migrate
```

Run database seeder
```sh
php artisan db:seed
```

Create a symlink to the storage:
```sh
php artisan storage:link
```

Run the dev server:
```sh
php artisan serve
```

go to http://127.0.0.1:8000


## Note for developper

Rebuild the asset in real time if you want to customize the js/cs or if you add the tailwind class in the blade files
```sh
npm run dev
```
