<?php


namespace SyncthingRest\Responses;

use SyncthingRest\Responses\SystemLog\Log;

/**
 * Class SystemError
 * @package SyncthingRest\Responses
 *
 * @method Log[] messages
 */
class SystemLog extends BaseResponse
{
    const cast = [
        'list' => [
            'messages' => Log::class,
        ],
    ];
}