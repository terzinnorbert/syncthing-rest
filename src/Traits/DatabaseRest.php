<?php

namespace SyncthingRest\Traits;

trait DatabaseRest
{
    /**
     * @param string $folder
     * @param int    $levels
     * @param string $prefix
     * @return array
     */
    public function getDbBrowse($folder, $levels = 0, $prefix = '')
    {
        $parameters = compact('folder', 'levels');
        if (!empty($prefix)) {
            $parameters['prefix'] = $prefix;
        }

        return $this->get('db/browse', $parameters);
    }

    /**
     * @param string $device
     * @param string $folder
     * @return array
     */
    public function getDbCompletion($device, $folder)
    {
        return $this->get('db/completion', compact('device', 'folder'));
    }

    /**
     * @param string $folder
     * @param string $file
     * @return array
     */
    public function getDbFile($folder, $file)
    {
        return $this->get('db/file', compact('folder', 'file'));
    }

    /**
     * @param string $folder
     * @return array
     */
    public function getDbIgnores($folder)
    {
        return $this->get('db/ignores', compact('folder'));
    }

    /**
     * @param string $folder
     * @param int    $page
     * @param int    $perPage
     * @return array
     */
    public function getDbNeed($folder, $page = null, $perPage = null)
    {
        $parameters = compact('folder');
        if (!is_null($page)) {
            $parameters['page'] = $page;
        }
        if (!is_null($perPage)) {
            $parameters['perpage'] = $perPage;
        }

        return $this->get('db/need', $parameters);
    }

    /**
     * @param string $folder
     * @return array
     */
    public function getDbStatus($folder)
    {
        return $this->get('db/status', compact('folder'));
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