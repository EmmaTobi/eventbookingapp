# Event Booking Application

## Requirements

PHP VERSION >= 7.0

Composer needs to be installed for php dependencies management

NOTE:  For the Following instructions, navigate into your project base directory via terminal
## Setup Application

Assuming $PROJECT_DIR=eventbookingapp

*  Run ```composer install```

*  To set your database connection, navigate to $PROJECT_DIR/config/app.php

*  Optional : To run test  ```./vendor/bin/phpunit test ```

Navigate to your $PROJECT_DIR and run :

*  Optional : ```php database/migrations/migration_down.php``` - To Drop Migrations

*  ```php database/migrations/migration_up.php``` - To Run Migrations

*  ```php database/migrations/seeder.php``` - To Load Database with data


## Startup Application

* Navigate to $PROJECT_DIR
* Run ```php -S localhost:8000 public/index.php```
* Navigate to your browser, then Goto http://localhost:8000
* A welcome screen similar to the image below should be visible

![Welcome Screen](welcome.png?raw=true "Welcome Screen")
