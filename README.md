## Instalation

Untuk menginstall aplikasi ini memerlukan 2 aplikasi, yaitu vs code dan laragon

-   clone aplikasi ini
-   buka laragon lalu buat database baru untuk nama bebas
-   lalu copy file .env copy, dan rename menjadi .env
-   setelah itu buka file .env dan di DB_DATABASE ubah menjadi nama databse yang baru di buat
-   nyalakan server laragon

# lalu ketik di terminal vs code

-   composer install
-   php artisan key:generate
-   php artisan migrate:fresh --seed

# kemudian untuk menyalakan server

-   php artisan serve

## Melakukan testing

Untuk melakukan testing perlu melakukan 2 langkah yaitu:

# ketik di terminal

-   php artisan migrate:fresh --seed
-   php artisan test

## Melihat route

untuk melihat routes yang ada bisa ketik di terminal

-   php artisan route:list
