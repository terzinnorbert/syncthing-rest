<?php


namespace SyncthingRest\Responses;

use SyncthingRest\Responses\SystemConfig\Device;
use SyncthingRest\Responses\SystemConfig\Folder;
use SyncthingRest\Responses\SystemConfig\Gui;
use SyncthingRest\Responses\SystemConfig\Ldap;
use SyncthingRest\Responses\SystemConfig\Option;

/**
 * Class SystemConfig
 * @package SyncthingRest\Responses
 *
 * @method int version()
 * @method Folder[] folders()
 * @method Device[] devices
 * @method Gui gui
 * @method Ldap ldap
 * @method Option options
 * @method Device[] remoteIgnoredDevices
 * @method Device[] pendingDevices
 */
class SystemConfig extends BaseResponse
{
    const cast = [
        'entity' => [
            'options' => Option::class,
        ],
        'list' =>
            [
                'folders' => Folder::class,
                'devices' => Device::class,
                'gui' => Gui::class,
                'ldap' => Ldap::class,
                'remoteIgnoredDevices' => Device::class,
                'pendingDevices' => Device::class,
            ],
    ];
}