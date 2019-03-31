<?php

namespace SyncthingRest\Traits;

trait StatisticsRest
{
    /**
     * @return array
     */
    public function getStatsDevice()
    {
        return $this->get('stats/device');
    }

    /**
     * @return array
     */
    public function getStatsFolder()
    {
        return $this->get('stats/folder');
    }

}