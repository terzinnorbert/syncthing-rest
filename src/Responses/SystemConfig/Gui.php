<?php

namespace SyncthingRest\Responses\SystemConfig;

use SyncthingRest\Responses\BaseResponse;

/**
 * Class Gui
 * @package SyncthingRest\Responses\SystemConfig
 *
 * @method bool enabled
 * @method string address
 * @method string unixSocketPermissions
 * @method string user
 * @method string password
 * @method string authMode
 * @method bool useTLS
 * @method string apiKey
 * @method bool insecureAdminAccess
 * @method string theme
 * @method bool debugging
 * @method bool insecureSkipHostcheck
 * @method bool insecureAllowFrameLoading
 */
class Gui extends BaseResponse
{

}