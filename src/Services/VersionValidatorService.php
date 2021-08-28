<?php

namespace App\Services;

use App\Lib\Config;
use \Carbon\Carbon;

class VersionValidatorService implements VersionValidatorContract
{
    public function validate(string $needle, string $validatorVersionFormat) : bool{
        switch($validatorVersionFormat){
            case VersionValidatorContract::VERSION_1_0_17_60:
                return $this->validationForVersion_1_0_17_60( $needle);
                break;
            default :
                return false;
        }
    }

    public function applyValidation(array $data, string $key,  string $validatorVersionFormat) : array{
        switch($validatorVersionFormat){
            case VersionValidatorContract::VERSION_1_0_17_60:
                return $this->applyValidationForVersion_1_0_17_60( $data, $key, $validatorVersionFormat);
                break;
            default :
                return $data;
        }
    }

    protected function validationForVersion_1_0_17_60(string $needle) : bool
    {
        if(!empty($needle)){
            $matchPlusSignResultArray = explode("+",  $needle);
            $matchDotSignResultArray = explode(".",  $matchPlusSignResultArray[0]);
            if(count($matchDotSignResultArray) == 3){
                switch(count($matchPlusSignResultArray)){
                    case 2 :
                        return $this->matchVersion_1_0_17_60((int)$matchDotSignResultArray[0], (int)$matchDotSignResultArray[1], 
                                                    (int)$matchDotSignResultArray[2], (int)$matchPlusSignResultArray[1]);
                        break;
                    case 1 :
                        return $this->matchVersion_1_0_17_60((int)$matchDotSignResultArray[0], (int)$matchDotSignResultArray[1],
                                                    (int)$matchDotSignResultArray[2]);
                        break;
                    }
            }
        }
        return false;
    }

    protected function applyValidationForVersion_1_0_17_60(array $data, $key, $version) : array
    {
        return array_map(function($item) use ($key, $version){
            if(isset($item[$key]) &&  $this->validate($item[$key], $version )){
                $item["event_date"] = Carbon::parse($item["event_date"], "Europe/Berlin")->setTimeZone("UTC")->toDateTimeString();
                return $item;
            }
            return $item;
        }, $data);
    }

    protected function matchVersion_1_0_17_60(int $firstSegment, int $secondSegment, int $thirdSegment, int $fourthSegment = null) : bool{
        $control = false;
        if(($firstSegment > 0 ? ($firstSegment > 1 ? $control = true : true   ) : false ) && $control  )
            return true;
        if(($secondSegment >= 0 ? ($secondSegment > 0 ? $control = true : true   ) : false )   && $control)
            return true;
        return ($thirdSegment >= 17) && ($fourthSegment ? $fourthSegment >= 60 : true);
    }

}

?>