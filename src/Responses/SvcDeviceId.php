<?php


namespace SyncthingRest\Responses;

/**
 * Class SvcDeviceId
 * @package SyncthingRest\Responses
 *
 * @method error
 * @method id
 */
class SvcDeviceId extends BaseResponse
{
    public function hasError(): bool
    {
        return isset($this->response['error']);
    }
}