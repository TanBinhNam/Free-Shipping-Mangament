# frontend

Vue 3.

# backend

Laravel 8.

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=Vue.volar) (and disable Vetur) + [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=Vue.vscode-typescript-vue-plugin).

## Project Setup
### Frontend
`````sh
npm install
`````

#### Compile and Hot-Reload for Development

```sh
npm run dev
```

#### Compile and Minify for Production

```sh
npm run build
```

### Backend

`````sh
php artisan serve
`````

#### Database

`````sh
php artisan migrate
`````

`````sh
php artisan db:seed --class=UserSeeder
`````

`````sh
php artisan db:seed --class=FreeShipSeeder
`````

`````sh
php artisan db:seed --class=ProvinceSeeder
`````