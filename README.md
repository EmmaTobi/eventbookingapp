# Event Booking Application

## Requirements

PHP VERSION >= 7.0

Composer needs to be installed for php dependencies management

NOTE:  For the Following instructions, navigate into your project base directory via terminal
## Setup Application

Assume $PROJECT_DIR=eventbookingapp

To set your database connection, navigate to $PROJECT_DIR/config/app.php

Navigate to your $PROJECT_DIR and run :

*  ```php database/migrations/migration_up.php``` - To Run Migrations

*  ```php database/migrations/seeder.php``` - To Load Database with data

*  Optional : ```php database/migrations/migration_down.php``` - To Drop Migrations

## Test

Run  ```./vendor/bin/phpunit test ```


## Startup Application

* Navigate to $PROJECT_DIR
* Run ```php -S localhost:8000```
* Navigate to your browser, then Goto http://localhost:8000
* A welcome screen similar to the image below should be visible

![Welcome Screen](welcome.png?raw=true "Welcome Screen")
