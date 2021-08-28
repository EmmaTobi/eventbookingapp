<?php 

namespace App\Controllers;

use App\Lib\Config;
use App\Services\EventService;
use App\Lib\Request;

/**
 * Handles Request Related To Events
 */
class EventController
{
    /**
     * @var EventService
     */
    protected $eventService;

    /**
     * No-args Constructor for EventController
     */
    public function __construct()
    {
        $this->eventService = new EventService();
    }

    /**
     * Handle Get Events requests
     * @param App\Lib\Request $request wraps client request
     * @return void
     */
    public function indexAction(Request $request)
    { 
        $filters = $request->queries;
        $events = $this->eventService->findAllEvents($filters);
        include(Config::get("VIEWS_PATH"). "events.php");
    }
}