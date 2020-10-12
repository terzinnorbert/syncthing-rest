<?php

namespace SyncthingRest\Responses\SystemConfig;

use SyncthingRest\Responses\BaseResponse;

/**
 * Class Option
 * @package SyncthingRest\Responses\SystemConfig
 *
 * @method array listenAddresses
 * @method array globalAnnounceServers
 * @method bool globalAnnounceEnabled
 * @method bool localAnnounceEnabled
 * @method int localAnnouncePort
 * @method string localAnnounceMCAddr
 * @method int maxSendKbps
 * @method int maxRecvKbps
 * @method int reconnectionIntervalS
 * @method bool relaysEnabled
 * @method int relayReconnectIntervalM
 * @method bool startBrowser
 * @method bool natEnabled
 * @method int natLeaseMinutes
 * @method int natRenewalMinutes
 * @method int natTimeoutSeconds
 * @method int urAccepted
 * @method int urSeen
 * @method string urUniqueId
 * @method string urURL
 * @method bool urPostInsecurely
 * @method int urInitialDelayS
 * @method bool restartOnWakeup
 * @method int autoUpgradeIntervalH
 * @method bool upgradeToPreReleases
 * @method int keepTemporariesH
 * @method bool cacheIgnoredFiles
 * @method int progressUpdateIntervalS
 * @method bool limitBandwidthInLan
 * @method array minHomeDiskFree
 * @method int value
 * @method string unit
 * @method string releasesURL
 * @method array alwaysLocalNets
 * @method bool overwriteRemoteDeviceNamesOnConnect
 * @method int tempIndexMinBlocks
 * @method array unackedNotificationIDs
 * @method int trafficClass
 * @method string defaultFolderPath
 * @method bool setLowPriority
 * @method int maxFolderConcurrency
 * @method string crURL
 * @method bool crashReportingEnabled
 * @method int stunKeepaliveStartS
 * @method int stunKeepaliveMinS
 * @method array stunServers
 * @method string databaseTuning
 * @method int maxConcurrentIncomingRequestKiB
 */
class Option extends BaseResponse
{
    const cast = [
        'entity' => [
            'minHomeDiskFree' => MinDiskFree::class,
        ],
        'list' => [

        ],
    ];
// TODO listenAddresses
// TODO globalAnnounceServers
// TODO minHomeDiskFree
// TODO alwaysLocalNets
// TODO unackedNotificationIDs
// TODO stunServers
}