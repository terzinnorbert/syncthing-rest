<?php

namespace SyncthingRest\Traits;

trait ServiceRest
{
    /**
     * @param string $id
     * @return array
     */
    public function getSvcDeviceId($id)
    {
        return $this->get('svc/deviceid', compact('id'));
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
        return $this->get('svc/random/string', compact('length'));
    }

    /**
     * @return array
     */
    public function getSvcReport()
    {
        return $this->get('svc/report');
    }
}