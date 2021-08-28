<?php

declare(strict_types=1);
namespace Test\Services;

use Test\TestCase;
use App\Services\VersionValidatorService;
use App\Lib\Config;

class VersionValidatorServiceTest extends TestCase
{

    protected $eventsData = [
        [
            "event_date" => "2019-09-04 08:00:00",
            "version" => "1.0.17+42"
        ],
        [
            "event_date" => "2019-09-04 08:00:00",
            "version" => "1.0.17+60"
        ],
        [
            "event_date" => "2019-09-04 08:00:00",
            "version" => "1.0.17+61"
        ],
        [
            "event_date" => "2019-09-04 08:00:00",
            "version" => "1.1.1"
        ],
    ];

    private $versionValidatorService;

    protected function setUp(): void
    {
        $this->versionValidatorService = new VersionValidatorService();
    }

    /**
     * Test validate Method on VersionValidatorService Class
     */
    public function testValidate(): void
    {
        $version =  "1.0.17+42";
        $expected = false;
        $result = $this->versionValidatorService->validate($version, Config::get("DEFAULT_VERSION_VALIDATOR"));
        $this->assertSame($expected, $result);
        $version =  "1.0.17+60";
        $expected = true;
        $result = $this->versionValidatorService->validate($version, Config::get("DEFAULT_VERSION_VALIDATOR"));
        $this->assertSame($expected, $result);
        $version =  "1.1.2";
        $expected = true;
        $result = $this->versionValidatorService->validate($version, Config::get("DEFAULT_VERSION_VALIDATOR"));
        $this->assertSame($expected, $result);
        $version =  "";
        $expected = false;
        $result = $this->versionValidatorService->validate($version, Config::get("DEFAULT_VERSION_VALIDATOR"));
        $this->assertSame($expected, $result);
        $version =  "gib.ber.ish";
        $expected = false;
        $result = $this->versionValidatorService->validate($version, Config::get("DEFAULT_VERSION_VALIDATOR"));
        $this->assertSame($expected, $result);
        $expected = false;
        $result = $this->versionValidatorService->validate($version, "gibberish");
        $this->assertSame($expected, $result);
    }

    /**
     * Test applyValidation Method on VersionValidatorService Class with Valid Data
     */
    public function testApplyValidationWithValidData(): void
    {
        $expected =[
            [
                "event_date" => "2019-09-04 08:00:00",
                "version" => "1.0.17+42"
            ],
            [
                "event_date" => "2019-09-04 06:00:00",
                "version" => "1.0.17+60"
            ],
            [
                "event_date" => "2019-09-04 06:00:00",
                "version" => "1.0.17+61"
            ],
            [
                "event_date" => "2019-09-04 06:00:00",
                "version" => "1.1.1"
            ],
        ];
        $result = $this->versionValidatorService->applyValidation($this->eventsData, "version",  Config::get("DEFAULT_VERSION_VALIDATOR"));
        $this->assertSame($expected, $result);
    }

     /**
     * Test applyValidation Method on VersionValidatorService Class with Valid Data
     */
    public function testApplyValidationWithInValidData(): void
    {
        $expected =[
            [
                "event_date" => "2019-09-04 08:00:00",
                "version" => "1.0.17+42"
            ],
            [
                "event_date" => "2019-09-04 06:00:00",
                "version" => "1.0.17+60"
            ],
            [
                "event_date" => "2019-09-04 06:00:00",
                "version" => "1.0.17+61"
            ],
            [
                "event_date" => "2019-09-04 06:00:00",
                "version" => "1.1.1"
            ],
        ];
        //invalid data key passed
        $result = $this->versionValidatorService->applyValidation($this->eventsData, "gibberish",  Config::get("DEFAULT_VERSION_VALIDATOR"));
        $this->assertSame($this->eventsData, $result);
        //invalid version number
        $result = $this->versionValidatorService->applyValidation($this->eventsData, "version", "gibberish");
        $this->assertSame($this->eventsData, $result);
        //empty data
        $result = $this->versionValidatorService->applyValidation([], "version", "gibberish");
        $this->assertSame([], $result);
    }

}

?>