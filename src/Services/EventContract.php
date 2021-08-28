<?php

namespace App\Services;

use Illuminate\Support\Collection;

/**
 * Interface defining possible operations related to events
 */
interface EventContract
{

    /**
     * Find all events
     * @param array $filters query filters for events records
     * @return Illuminate\Support\Collection collection of events matching filters
     */
    public function findAllEvents(array $filters = []) : Collection;

}
?>