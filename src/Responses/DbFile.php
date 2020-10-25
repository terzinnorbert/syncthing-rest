<?php

namespace SyncthingRest\Responses;

use SyncthingRest\Responses\DbFile\File;

/**
 * Class DbFile
 * @package SyncthingRest\Responses
 *
 * @method mixed availability
 * @method File global
 * @method File local
 */
class DbFile extends BaseResponse
{
    const cast = [
        'entity' => [
            'global' => File::class,
            'local' => File::class,
        ],
    ];
}