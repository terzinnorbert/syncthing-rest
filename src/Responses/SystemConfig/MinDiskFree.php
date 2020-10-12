<?php


namespace SyncthingRest\Responses\SystemConfig;

use SyncthingRest\Responses\BaseResponse;

/**
 * @method int value
 * @method string unit
 */
class MinDiskFree extends BaseResponse
{
    public function __toString()
    {
        return $this->value() . ' ' . $this->unit();
    }
}