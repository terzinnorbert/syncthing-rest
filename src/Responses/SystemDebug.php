<?php


namespace SyncthingRest\Responses;

use SyncthingRest\Responses\SystemDebug\Facility;

/**
 * Class SystemDebug
 * @package SyncthingRest\Responses
 *
 * @method array enabled
 * @method Facility facilities
 */
class SystemDebug extends BaseResponse
{
    const cast = [
        'entity' => [
            'facilities' => Facility::class,
        ],
    ];
}