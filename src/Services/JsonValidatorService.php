<?php

namespace App\Services;

use JsonSchema\Validator;
use JsonSchema\Constraints\Constraint;
use App\Lib\Config;

class JsonValidatorService implements JsonValidatorContract
{

    protected $suppressErrors = true;
    /**
     * @var string
     */
    protected $schemaJsonPath;

    /**
     * @var string
     */
    protected $validatorJsonPath;

    /**
     * One Args Constructor for JsonValidatorService
     * @param string $jsonArrayPathString Path to data json file
     */
    public function __construct(string $jsonArrayPathString = "")
    {
        $this->schemaJsonPath =  $jsonArrayPathString ?: Config::get('SCHEMA_JSON_PATH');
        $this->validatorJsonPath =  Config::get('JSON_VALIDATOR_JSON_PATH');
    }

    /**
     * Validate data json file 
     * @return void
     */
    public function validate() : bool{
        $validator = new Validator();
        $data =json_decode(file_get_contents($this->schemaJsonPath));
        $validator->validate($data, (object)['$ref' => 'file://' . realpath($this->validatorJsonPath)], Constraint::CHECK_MODE_COERCE_TYPES);
        if ($validator->isValid()) {
            print_r( "The supplied JSON validates against the schema.\n", $this->suppressErrors);
            return true;
        } else {
            print_r( "JSON does not validate. Violations:\n", $this->suppressErrors) ;
            foreach ($validator->getErrors() as $error) {
                print_r($error['property'] . " , " . $error['message'], $this->suppressErrors);
            }
            return false;
        }
    }

    /**
     * Get the Schema Json Path 
     * @return string
     */
    public function getSchemaJsonPath() : string
    {
        return $this->schemaJsonPath;
    }

    /**
     * Set the Schema Json Path 
     * @param string $schemaJsonPath Path to data json file
     * @return void
     */
    public function setSchemaJsonPath(string $schemaJsonPath) : void
    {
        $this->schemaJsonPath = $schemaJsonPath;
    }
}
?>