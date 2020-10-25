<?php

namespace SyncthingRest\Responses;

use SyncthingRest\Responses\DbNeed\File;

/**
 * Class DbNeed
 * @package SyncthingRest\Responses
 *
 * @method int page
 * @method int perpage
 * @method array progress
 * @method array queued
 * @method array rest
 */
class DbNeed extends BaseResponse
{
    const cast = [
        'list' => [
            'progress' => File::class,
            'queued' => File::class,
            'rest' => File::class,
        ],
    ];
}