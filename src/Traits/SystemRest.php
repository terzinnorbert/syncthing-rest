<?php

namespace SyncthingRest\Traits;


use SyncthingRest\Responses\SystemConfig;
use SyncthingRest\Responses\SystemConnections;
use SyncthingRest\Responses\SystemDebug;
use SyncthingRest\Responses\SystemError;
use SyncthingRest\Responses\SystemLog;

trait SystemRest
{
    /**
     * @param bool $current
     * @return array
     */
    public function getSystemBrowse($current = null)
    {
        return $this->get('system/browse', $current ? compact('current') : []);
    }

    /**
     * @return SystemConfig
     */
    public function getSystemConfig()
    {
        return new SystemConfig($this->get('system/config'));
    }

    /**
     * @return array
     */
    public function getSystemConfigInsync()
    {
        return $this->get('system/config/insync');
    }

    /**
     * @return SystemConnections
     */
    public function getSystemConnections()
    {
        return new SystemConnections($this->get('system/connections'));
    }

    /**
     * @return SystemDebug
     */
    public function getSystemDebug()
    {
        return new SystemDebug($this->get('system/debug'));
    }

    /**
     * @return array
     */
    public function getSystemDiscovery()
    {
        return $this->get('system/discovery');
    }

    /**
     * @return SystemError
     */
    public function getSystemError()
    {
        return new SystemError($this->get('system/error'));
    }

    /**
     * @return SystemLog
     */
    public function getSystemLog()
    {
        return new SystemLog($this->get('system/log'));
    }

    /**
     * @return array
     */
    public function getSystemPing()
    {
        return $this->get('system/ping');

    }

    /**
     * @return array
     */
    public function getSystemStatus()
    {
        return $this->get('system/status');

    }

    /**
     * @return array
     */
    public function getSystemUpgrade()
    {
        return $this->get('system/upgrade');

    }

    /**
     * @return array
     */
    public function getSystemVersion()
    {
        return $this->get('system/version');

    }

    /**
     * @param array $config
     * @return array
     */
    public function postSystemConfig(array $config)
    {
        //cannot unmarshal array into Go struct field VersioningConfiguration.params of type map[string]string fix
        foreach ($config['folders'] as &$folder) {
            if (array_key_exists('versioning', $folder) && empty($folder['versioning']['type'])) {
                unset($folder['versioning']);
            }
        }

        return $this->post('system/config', [], $config);
    }

    /**
     * @param array $enable
     * @param array $disable
     * @return array
     */
    public function postSystemDebug($enable = [], $disable = [])
    {
        $parameters = [];
        if (!empty($enable)) {
            $parameters['enable'] = implode(',', $enable);
        }
        if (!empty($disable)) {
            $parameters['disable'] = implode(',', $disable);
        }

        return $this->post('system/debug', $parameters);
    }

    /**
     * @return array
     */
    public function postSystemErrorClear()
    {
        return $this->post('system/error/clear');
    }

    /**
     * @param string $error
     * @return array
     */
    public function postSystemError($error)
    {
        return $this->post('system/error', [], ['error' => $error]);
    }

    /**
     * @param string $device
     * @return array
     */
    public function postSystemPause($device = null)
    {
        return $this->post('system/pause', is_null($device) ? [] : compact('device'));
    }

    /**
     * @return array
     */
    public function postSystemPing()
    {
        return $this->post('system/ping');
    }

    /**
     * @param string $folder
     * @return array
     */
    public function postSystemReset($folder = null)
    {
        return $this->post('system/reset', is_null($folder) ? [] : compact('folder'));
    }

    /**
     * @return array
     */
    public function postSystemRestart()
    {
        return $this->post('system/restart');
    }

    /**
     * @param string $device
     * @return array
     */
    public function postSystemResume($device = null)
    {
        return $this->post('system/resume', is_null($device) ? [] : compact('device'));
    }

    /**
     * @return array
     */
    public function postSystemShutdown()
    {
        return $this->post('system/shutdown');
    }

    /**
     * @return array
     */
    public function postSystemUpgrade()
    {
        return $this->post('system/upgrade');
    }
}