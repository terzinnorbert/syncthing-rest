<?php

namespace SyncthingRest\Responses\Stats;

use SyncthingRest\Responses\BaseResponse;

/**
 * Class Folder
 * @package SyncthingRest\Responses\Stats
 *
 * @method string folderID
 * @method string lastScan
 * @method File lastFile
 */
class Folder extends BaseResponse
{
    const cast = [
        'entity' => [
            'lastFile' => File::class,
        ],
    ];
}