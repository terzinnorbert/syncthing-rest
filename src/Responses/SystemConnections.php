<?php


namespace SyncthingRest\Responses;


use SyncthingRest\Responses\SystemConnections\Connection;

/**
 * Class SystemConnections
 * @package SyncthingRest\Responses
 *
 * @method Connection total
 * @method Connection[] connections
 */
class SystemConnections extends BaseResponse
{
    const cast = [
        'entity' => [
            'total' => Connection::class,
        ],
        'list' =>
            [
                'connections' => Connection::class,
            ],
    ];
}