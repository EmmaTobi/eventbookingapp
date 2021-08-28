<?php

declare(strict_types=1);
namespace Test\Services;

use App\Lib\Config;
use Test\TestCase;
use App\Services\JsonValidatorService;

class JsonValidatorServiceTest extends TestCase
{
    private $jsonValidatorService;

    /**
     * @Test init lifecycle
     */
    protected function setUp(): void
    {
        $this->jsonValidatorService = new JsonValidatorService();
    }

    /**
     * @Test validate Method on JsonValidatorService with valid data
     */
    public function testValidateValid(): void
    {
        $this->jsonValidatorService->setSchemaJsonPath(Config::get("TEST_DIR") . "data.json");
        $actual = $this->jsonValidatorService->validate();
        $this->assertSame(true, $actual);
    }

    /**
     * @Test validate Method on JsonValidatorService with invalid data
     */
    public function testValidateInValid(): void
    {
        $this->jsonValidatorService->setSchemaJsonPath(Config::get("TEST_DIR") . "invalid_one.json");
        $actual = $this->jsonValidatorService->validate();
        $this->assertSame(false, $actual);
        $this->jsonValidatorService->setSchemaJsonPath(Config::get("TEST_DIR") . "invalid_two.json");
        $actual = $this->jsonValidatorService->validate();
        $this->assertSame(false, $actual);
    }

}

?>