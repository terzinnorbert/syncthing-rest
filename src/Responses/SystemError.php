<?php


namespace SyncthingRest\Responses;

use SyncthingRest\Responses\SystemError\Error;

/**
 * Class SystemError
 * @package SyncthingRest\Responses
 *
 * @method Error errors
 */
class SystemError extends BaseResponse
{
    const cast = [
        'list' => [
            'errors' => Error::class,
        ],
    ];
}