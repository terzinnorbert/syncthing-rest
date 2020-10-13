<?php

namespace SyncthingRest\Traits;

use SyncthingRest\Responses\Stats\Device;
use SyncthingRest\Responses\Stats\Folder;

trait StatisticsRest
{
    /**
     * @return array
     */
    public function getStatsDevice()
    {
        $devices = $this->get('stats/device');
        return array_map(static function ($deviceID, $device) {
            $device['deviceID'] = $deviceID;
            return new Device($device);
        }, array_keys($devices), $devices);
    }

    /**
     * @return array
     */
    public function getStatsFolder()
    {
        $folders = $this->get('stats/folder');
        return array_map(static function ($folderID, $folder) {
            $folder['folderID'] = $folderID;
            return new Folder($folder);
        }, array_keys($folders), $folders);
    }

}