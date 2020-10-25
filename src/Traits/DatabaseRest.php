<?php

namespace SyncthingRest\Traits;

use SyncthingRest\Responses\DbBrowse;
use SyncthingRest\Responses\DbCompletion;
use SyncthingRest\Responses\DbFile;
use SyncthingRest\Responses\DbIgnores;
use SyncthingRest\Responses\DbNeed;
use SyncthingRest\Responses\DbStatus;

trait DatabaseRest
{
    /**
     * @param string $folder
     * @param int    $levels
     * @param string $prefix
     * @return DbBrowse
     */
    public function getDbBrowse($folder, $levels = 0, $prefix = '')
    {
        $parameters = compact('folder', 'levels');
        if (!empty($prefix)) {
            $parameters['prefix'] = $prefix;
        }

        return new DbBrowse($this->get('db/browse', $parameters));
    }

    /**
     * @param string $device
     * @param string $folder
     * @return DbCompletion
     */
    public function getDbCompletion($device = null, $folder = null): DbCompletion
    {
        $parameters = [];
        if (!empty($device)) {
            $parameters['device'] = $device;
        }
        if (!empty($folder)) {
            $parameters['folder'] = $folder;
        }
        return new DbCompletion($this->get('db/completion', $parameters));
    }

    /**
     * @param string $folder
     * @param string $file
     * @return DbFile
     */
    public function getDbFile($folder, $file): DbFile
    {
        return new DbFile($this->get('db/file', compact('folder', 'file')));
    }

    /**
     * @param string $folder
     * @return DbIgnores
     */
    public function getDbIgnores($folder): DbIgnores
    {
        return new DbIgnores($this->get('db/ignores', compact('folder')));
    }

    /**
     * @param string $folder
     * @param int    $page
     * @param int    $perPage
     * @return DbNeed
     */
    public function getDbNeed($folder, $page = null, $perPage = null): DbNeed
    {
        $parameters = compact('folder');
        if (!is_null($page)) {
            $parameters['page'] = $page;
        }
        if (!is_null($perPage)) {
            $parameters['perpage'] = $perPage;
        }

        return new DbNeed($this->get('db/need', $parameters));
    }

    /**
     * @param string $folder
     * @return DbStatus
     */
    public function getDbStatus($folder): DbStatus
    {
        return new DbStatus($this->get('db/status', compact('folder')));
    }

    /**
     * @param string $folder
     * @param array  $ignores
     * @return array
     */
    public function postDbIgnores($folder, array $ignores)
    {
        return $this->post(
            'db/ignores',
            compact('folder'),
            [
                'ignore' => array_values($ignores),
            ]
        );
    }

    /**
     * @param string $folder
     * @return array
     */
    public function postDbOverride($folder)
    {
        return $this->post('db/override', compact('folder'));
    }

    /**
     * @param string $folder
     * @param string $file
     * @return array
     */
    public function postDbPrio($folder, $file)
    {
        return $this->post('db/prio', compact('folder', 'file'));
    }

    /**
     * @param string $folder
     * @return array
     */
    public function postDbRevert($folder)
    {
        return $this->post('db/revert', compact('folder'));
    }

    /**
     * @param      $folder
     * @param null $sub
     * @param null $next
     * @return array
     */
    public function postDbScan($folder = null, $sub = null, $next = null)
    {
        $parameters = [];
        if (!is_null($folder)) {
            $parameters = compact('folder');
        }
        if (!is_null($sub)) {
            $parameters['sub'] = $sub;
        }
        if (!is_null($next)) {
            $parameters['next'] = $next;
        }

        return $this->post('db/scan', $parameters);
    }
}