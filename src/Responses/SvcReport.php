<?php


namespace SyncthingRest\Responses;


use SyncthingRest\Responses\SvcReport\Announce;
use SyncthingRest\Responses\SvcReport\DeviceUses;
use SyncthingRest\Responses\SvcReport\FolderUses;
use SyncthingRest\Responses\SvcReport\FolderUsesV3;
use SyncthingRest\Responses\SvcReport\GuiStats;
use SyncthingRest\Responses\SvcReport\IgnoreStats;
use SyncthingRest\Responses\SvcReport\Relays;

/**
 * Class SvcDeviceId
 * @package SyncthingRest\Responses
 *
 * @method bool alwaysLocalNets
 * @method array blockStats
 * @method bool cacheIgnoredFiles
 * @method bool customDefaultFolderPath
 * @method bool customReleaseURL
 * @method bool customTempIndexMinBlocks
 * @method bool customTrafficClass
 * @method int folderMaxFiles
 * @method int folderMaxMiB
 * @method double hashPerf
 * @method bool limitBandwidthInLan
 * @method string longVersion
 * @method int memorySize
 * @method int memoryUsageMiB
 * @method string natType
 * @method int numCPU
 * @method int numDevices
 * @method int numFolders
 * @method bool overwriteRemoteDeviceNames
 * @method string platform
 * @method bool progressEmitterEnabled
 * @method bool restartOnWakeup
 * @method double sha256Perf
 * @method bool temporariesCustom
 * @method bool temporariesDisabled
 * @method int totFiles
 * @method int totMiB
 * @method array transportStats
 * @method string uniqueID
 * @method bool upgradeAllowedAuto
 * @method bool upgradeAllowedManual
 * @method bool upgradeAllowedPre
 * @method int uptime
 * @method int urVersion
 * @method bool usesRateLimit
 * @method string version
 */
class SvcReport extends BaseResponse
{
    const cast = [
        'entity' => [
            'announce' => Announce::class,
            'deviceUses' => DeviceUses::class,
            'folderUses' => FolderUses::class,
            'folderUsesV3' => FolderUsesV3::class,
            'guiStats' => GuiStats::class,
            'ignoreStats' => IgnoreStats::class,
            'relays' => Relays::class,
        ],
    ];

    public function rescanIntvs()
    {
        return current($this->response['rescanIntvs']);
    }
}