<?php

namespace App\Services;

use App\Lib\Config;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Collection;

/**
 * Service class handling operations related to events
 */
class EventService implements EventContract
{

    const SUPPORTED_FILTERS = [ "employee_name" => null, "event_name" => null, "event_date" => null];

    /**
     * Find all events
     * @param array $filters query filters for events records
     * @return Illuminate\Support\Collection collection of events matching filters
     */
    public function findAllEvents(array $filters = [])  : Collection
    {
        $filters = array_intersect_key($filters, self::SUPPORTED_FILTERS);
        $query = Capsule::table("events");
        foreach($filters as $filterKey=>$filterValue){
            $query->where(trim($filterKey), "like",  '%'. trim($filterValue). '%');
        }
        return $query->get();
    }

}
?>