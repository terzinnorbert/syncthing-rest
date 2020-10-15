<?php


namespace SyncthingRest\Responses\SvcReport;

use SyncthingRest\Responses\BaseResponse;

/**
 * Class FolderUsesV3
 * @package SyncthingRest\Responses\SvcReport
 *
 * @method int alwaysWeakHash
 * @method int conflictsDisabled
 * @method int conflictsOther
 * @method int conflictsUnlimited
 * @method int customWeakHashThreshold
 * @method int disableSparseFiles
 * @method int disableTempIndexes
 * @method int fsWatcherEnabled
 * @method int scanProgressDisabled
 */
class FolderUsesV3 extends BaseResponse
{
    public function filesystemType()
    {
        return array_keys($this->response['filesystemType'])[0];
    }

    public function pullOrder()
    {
        return array_keys($this->response['pullOrder'])[0];
    }

    public function fsWatcherDelays()
    {
        return current($this->response['fsWatcherDelays']);
    }
}