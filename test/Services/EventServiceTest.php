<?php

declare(strict_types=1);
namespace Test\Services;

use App\Services\EventService;
use App\Lib\Config;
use Test\TestCase;
use Test\RefreshDatabase;

class EventServiceTest extends TestCase
{
    use RefreshDatabase;
    
    private $eventService;

    /**
     * Test init lifecycle
     */
    protected function setUp(): void
    {
        $this->initDatabase(Config::get("TEST_DIR") . "data.json", true);
        $this->eventService = new EventService();
    }

    /**
     * Test findAllEvents Method on EventService with valid Data
     */
    public function testFindAllEventsWithValidData(): void
    {
        $events = $this->eventService->findAllEvents();
        $this->assertSame(8,  $events->count());  // Total expected records in database is 8
        //filter by employee_name
        $filters = ["employee_name" => "Emmanuel Fred"];
        $events = $this->eventService->findAllEvents($filters);
        $this->assertSame(1,  $events->count()); // Total expected records in database is 1
        //filter by event_name
        $filters = ["event_name" => "code.talks"];
        $events = $this->eventService->findAllEvents($filters);
        $this->assertSame(2,  $events->count()); // Total expected records in database is 2
        //filter by event_date
        $filters = ["event_date" => "2020-09-04 06:00:00"];
        $events = $this->eventService->findAllEvents($filters);
        $this->assertSame(2,  $events->count()); // Total expected records in database is 2
        //filter by event_date
        $filters = ["event_date" => "2020-09-04 06:00:00", "employee_name" => "Emmanuel Fred"];
        $events = $this->eventService->findAllEvents($filters);
        $this->assertSame(0,  $events->count()); // Total expected records in database is 0
        //filter by event_date, event_name,  employee_name
        $filters = ["event_date" => "2019-09-04 04:00:00", "employee_name" => "Daniel Schofield",
                    "event_name" => "Javascript 7 crash course"];
        $events = $this->eventService->findAllEvents($filters);
        $this->assertSame(1,  $events->count()); // // Total expected records in database is 1
    }

    /**
     * Test findAllEvents Method on EventService with invalid Data
     */
    public function testFindAllEventsWithInValidData(): void
    {
        //filter by employee_name
        $filters = ["employee_name" => ""];
        $events = $this->eventService->findAllEvents($filters);
        $this->assertSame(8,  $events->count()); // Total expected records in database is 1
        //filter by event_name
        $filters = ["event_name" => ""];
        $events = $this->eventService->findAllEvents($filters);
        $this->assertSame(8,  $events->count()); // Total expected records in database is 2
        //filter by event_date
        $filters = ["event_date" => ""];
        $events = $this->eventService->findAllEvents($filters);
        $this->assertSame(8,  $events->count()); // Total expected records in database is 2
        //filter by event_date
        $filters = ["event_date" => "gibberish"];
        $events = $this->eventService->findAllEvents($filters);
        $this->assertSame(0,  $events->count()); // Total expected records in database is 0
        //filter by not supported query
        $filters = ["color" => "gibberishcolor"];
        $events = $this->eventService->findAllEvents($filters);
        $this->assertSame(8,  $events->count());
    }

    /**
     * Test destroy lifecycle
     */
    protected function tearDown(): void
    {
        $this->dropDatabase(true);
    }

}

?>