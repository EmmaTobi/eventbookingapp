<?php

declare(strict_types=1);
namespace Test;

use Illuminate\Database\Capsule\Manager as Capsule;

trait RefreshDatabase 
{

    /**
     * Run migrations and load database with test data
     * @param string $pathToJsonFile Path to data json file 
     * @param bool $silent should Print out or not
     * @return void
     */
    protected function initDatabase(string $pathToJsonFile = "", bool $silent = false): void
    {
        seedDatabase($pathToJsonFile, $silent);
    }

    /**
     * Drop migrations      
     * @param bool $silent should Print out or not
     * @return void
     */
    protected function dropDatabase(bool $silent=false): void
    {
        truncateDatabase();
    }

}

?>