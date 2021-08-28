<?php

use App\Lib\Config;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use App\Services\JsonValidatorService;
use App\Services\VersionValidatorService;
use App\Models\Event;

/**
 * Seed Database
 * @param string $jsonArrayPathString Path to data json file
 * @param bool $silent Should print out or not
 * @return void
 */
function seedDatabase(string $jsonArrayPathString="", $silent = false){
    print_r("Running Database Seeder \n", $silent);
    $jsonValidatorService = new JsonValidatorService($jsonArrayPathString);
    $versionValidatorService = new VersionValidatorService();
    $validated = $jsonValidatorService->validate();
    if($validated){
        $data = json_decode(file_get_contents($jsonValidatorService->getSchemaJsonPath()), true);
        $data = $versionValidatorService->applyValidation($data, "version", Config::get('DEFAULT_VERSION_VALIDATOR'));
        Event::insert($data);
        print_r("Database Seeder Ran Successfully \n", $silent);
    }else{
        print_r("Schema Json not Validated. ", $silent);
        print_r("Database Seeder Run Unsuccessful \n", $silent);
    }
}

/**
 * Startup Database
 * @param bool $silent Should print out or not
 * @return void
 */
function migrationsUp(bool $silent=false){
    print_r("Running Migrations \n", $silent);
    Capsule::schema()->create('events', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('participation_id');
        $table->string('employee_name');
        $table->string('employee_mail');
        $table->integer('event_id');
        $table->string('event_name');
        $table->string('participation_fee');
        $table->datetime('event_date');
        $table->string('version');
    });
    print_r( "Migrations Ran Successfully \n", $silent);
}

/**
 * Drop Database
 * @param bool $silent Should print out or not
 * @return void
 */
function migrationsDown(bool $silent=false){
    print_r("Dropping Migrations \n", $silent);
    Capsule::schema()->dropIfExists('events');
    print_r("Migrations Dropped \n", $silent);
}

/**
 * Truncate Database
 * @return void
 */
function  truncateDatabase(){
    $colname = 'Tables_in_' . Config::get('CONNECTION_DATABASE');

    $tables = Capsule::select('SHOW TABLES');
    foreach($tables as $table) {
        $droplist[] = $table->$colname;
    }
    $droplist = implode(',', $droplist);

    Capsule::beginTransaction();
    Capsule::statement("TRUNCATE TABLE $droplist");
    Capsule::commit();
}

?>