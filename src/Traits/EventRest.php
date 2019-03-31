<?php

namespace SyncthingRest\Traits;

trait EventRest
{
    /**
     * @param int      $since
     * @param int      $limit
     * @param string[] $events
     * @param int      $timeout
     * @return array
     */
    public function getEvents($since = null, $limit = null, $events = [], $timeout = 60)
    {
        $parameters = [];
        if (!is_null($since)) {
            $parameters['since'] = $since;
        }
        if (!is_null($limit)) {
            $parameters['limit'] = $limit;
        }
        if (!empty($events)) {
            $parameters['events'] = implode(',', $events);
            $parameters['timeout'] = $timeout;
        }

        return $this->get('events', $parameters);
    }
}