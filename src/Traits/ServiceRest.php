<?php

namespace SyncthingRest\Traits;

use SyncthingRest\Responses\SvcDeviceId;
use SyncthingRest\Responses\SvcReport;

trait ServiceRest
{
    /**
     * @param string $id
     * @return SvcDeviceId
     */
    public function getSvcDeviceId($id): SvcDeviceId
    {
        return new SvcDeviceId($this->get('svc/deviceid', compact('id')));
    }

    /**
     * @return array
     */
    public function getSvcLang()
    {
        return $this->get('svc/lang');
    }

    /**
     * @param int $length
     * @return array
     */
    public function getSvcRandomString($length = 20)
    {
        $response = $this->get('svc/random/string', compact('length'));
        return $response ? $response['random'] : null;
    }

    /**
     * @return SvcReport
     */
    public function getSvcReport(): SvcReport
    {
        return new SvcReport($this->get('svc/report'));
    }
}