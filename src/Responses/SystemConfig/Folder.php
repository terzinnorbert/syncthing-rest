<?php

namespace SyncthingRest\Responses\SystemConfig;

use SyncthingRest\Responses\Base\Device as BaseDevice;
use SyncthingRest\Responses\BaseResponse;

/**
 * Class Folder
 * @package SyncthingRest\Responses\SystemConfig
 *
 * @method string id
 * @method string label
 * @method string filesystemType
 * @method string path
 * @method string type
 * @method Device[] devices
 * @method int rescanIntervalS
 * @method bool fsWatcherEnabled
 * @method int fsWatcherDelayS
 * @method bool ignorePerms
 * @method bool autoNormalize
 * @method int copiers
 * @method int pullerMaxPendingKiB
 * @method int hashers
 * @method string order
 * @method bool ignoreDelete
 * @method int scanProgressIntervalS
 * @method int pullerPauseS
 * @method int maxConflicts
 * @method bool disableSparseFiles
 * @method bool disableTempIndexes
 * @method bool paused
 * @method int weakHashThresholdPct
 * @method string markerName
 * @method bool copyOwnershipFromParent
 * @method int modTimeWindowS
 * @method int maxConcurrentWrites
 * @method bool disableFsync
 * @method string blockPullOrder
 */
class Folder extends BaseResponse
{
    const cast = [
        'entity' => [
            'minDiskFree' => MinDiskFree::class,
            'versioning' => Versioning::class,
        ],
        'list' => [
            'devices' => BaseDevice::class,
        ],
    ];

    /*
    TODO devices
    TODO filesystemType
    TODO type
    TODO order
    TODO blockPullOrder
     */
}