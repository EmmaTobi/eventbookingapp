<?php

namespace App\Services;

use App\Lib\Config;

interface VersionValidatorContract 
{
    const VERSION_1_0_17_60 = "1.0.0";

    public function validate(string $needle, string $validatorVersionFormat) : bool;

}

?>