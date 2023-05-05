# KPP Technical Test

A Simple Laravel application to manage Fishing Vessel data.

## Installation
1. Clone this repo
2. Within the new directory run the following
   1. `composer install`
   2. `cp .env.example .env`
   3. `php artisan key:generate`
   4. `php artisan storage:link`
   5. `php artisan migrate`

During the installation process an admin account is created, this account has all permissions by default and any new ones as they are created.

email: `admin@example.com`<br>
password: `password`
