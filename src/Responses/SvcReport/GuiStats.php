<?php

namespace SyncthingRest\Responses\SvcReport;

use SyncthingRest\Responses\BaseResponse;

/**
 * Class GuiStats
 * @package SyncthingRest\Responses\SvcReport
 *
 * @method int debugging
 * @method int enabled
 * @method int insecureAdminAccess
 * @method int insecureAllowFrameLoading
 * @method int insecureSkipHostCheck
 * @method int listenLocal
 * @method int listenUnspecified
 * @method int useAuth
 * @method int useTLS
 */
class GuiStats extends BaseResponse
{
    public function theme()
    {
        return array_keys($this->response['theme'])[0];
    }
}