<?php

namespace SyncthingRest\Responses\SystemConfig;

use SyncthingRest\Responses\Base\Device as BaseDevice;

/**
 * Class Device
 * @package SyncthingRest\Responses\SystemConfig
 *
 * @method string name
 * @method string[] addresses
 * @method string compression
 * @method string certName
 * @method bool introducer
 * @method bool skipIntroductionRemovals
 * @method bool paused
 * @method array allowedNetworks
 * @method bool autoAcceptFolders
 * @method int maxSendKbps
 * @method int maxRecvKbps
 * @method array ignoredFolders
 * @method array pendingFolders
 * @method int maxRequestKiB
 */
class Device extends BaseDevice
{
// TODO compression
// TODO ignoredFolders
// TODO pendingFolders
}