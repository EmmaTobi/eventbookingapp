<?php

return  [
        "LOG_PATH" => __DIR__.'/../logs',
        "ROUTE_PATH" =>  __DIR__ . '/../src/Controllers/route.php',
        "SCHEMA_JSON_PATH" =>  __DIR__ . '/../database/migrations/data.json',
        "TEST_DIR" =>  __DIR__ . '/../test/',
        "JSON_VALIDATOR_JSON_PATH" =>  __DIR__ . '/../database/migrations/schema.json',
        "VIEWS_PATH" =>  __DIR__ . '/../public/views/',
        "DEFAULT_VERSION_VALIDATOR" =>  "1.0.0",
        "CONNECTION_DRIVER" =>"mysql",
        "CONNECTION_HOST" => "127.0.0.1",
        "CONNECTION_DATABASE" => "eventbookingapp",
        "CONNECTION_USERNAME" => "root",
        "CONNECTION_PASSWORD" => "Pass@123",
];
?>