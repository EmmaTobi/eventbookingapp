<?php

namespace App\Services;

use JsonSchema\Validator;
use JsonSchema\Constraints\Constraint;
use App\Lib\Config;

interface JsonValidatorContract
{
    public function validate() : bool;

    public function getSchemaJsonPath() : string;
}
?>