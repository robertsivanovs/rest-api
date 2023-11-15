# Clarity test task #1 app

Tech stack used for building the application

### Back end:

1. Laravel 10 [Laravel Framework (https://laravel.com/)]
2. MySQL
   
### Front end:

1. HTML5
2. CSS3
2. JavaScript - InertiaJs/Vue.js

### Setup instructions:

1. Clone the repository
2. Create an empty DB
3. Rename file ".env.example" to ".env"
4. Setup DB configuration in ".env" file
5. Run "composer install" from project root
6. Run "php artisan migrate" from project root
7. Run "php artisan db:seed" from project root (to seed the database with sample data)
8. Run "php artisan key:generate" from project root
9. Run "npm install" from project root
10. Run "npm run dev" from project root
11. Run "php artisan serve" from project root (or use any other local server Nginx/Apache etc)

    The first app should be up and running at this point.
    config/secondapp.php contains the URL to the second app, you should adjust this.

    Coin rewards that are awarded to each user every 24 hours or to new users can
    be found in config/coinrewards.php

-- Might need to adjust permissions if on Linux

Sample user Data:

             email => test@example.com
             password => password

             email => topg@example.com
             password => password

             email => testuser@example.com
             password => password

             email => admin@example.com   // Admin
             password => password

Second app setup instructions are in the second app Readme file.

### Preview:
 
### Admin dashboard:
![Dashboard view](https://i.imgur.com/HStK7lD.png "Dashboard view")
