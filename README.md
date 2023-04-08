
## Installation

```bash
1- git clone --branch master https://github.com/ayoub-amzil/weather-app.git
2- cd weather-app
3- composer install
4- Create a copy of the .env.example file in the root directory and rename it to .env
5- Open the .env file and update the following lines to match your database credentials:
        DB_DATABASE=your_database_name
        DB_USERNAME=your_database_username
        DB_PASSWORD=your_database_password
6- php artisan key:generate
7- php artisan migrate
8- php artisan serve
```

    
