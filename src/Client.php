<?php
/**
 * @author Terzin Norbert <terzin.norbert@gmail.com>
 * @license MIT
 */

namespace SyncthingRest;

use Psr\Http\Message\ResponseInterface;

/**
 * Class SyncthingRestClient
 */
class Client
{
    const REST_SUFFIX = '/rest/';
    /**
     * @var Client
     */
    private $curl;

    /**
     * SyncthingRestClient constructor.
     * @param $baseUrl
     * @param $apiKey
     */
    public function __construct($baseUrl, $apiKey)
    {
        $this->curl = new \GuzzleHttp\Client(
            [
                'base_uri' => trim($baseUrl, '/').self::REST_SUFFIX,
                'headers'  => [
                    'Content-Type' => 'application/json',
                    'X-API-Key'    => $apiKey,
                ],
            ]
        );
    }

    /**
     * @return array
     */
    public function getSystemBrowse()
    {
        return $this->get('system/browse');
    }

    /**
     * @return array
     */
    public function getSystemConfig()
    {
        return $this->get('system/config');
    }

    /**
     * @return array
     */
    public function getSystemConfigInsync()
    {
        return $this->get('system/config/insync');
    }

    /**
     * @return array
     */
    public function getSystemConnections()
    {
        return $this->get('system/connections');
    }

    /**
     * @return array
     */
    public function getSystemDebug()
    {
        return $this->get('system/debug');
    }

    /**
     * @return array
     */
    public function getSystemDiscovery()
    {
        return $this->get('system/discovery');
    }

    /**
     * @return array
     */
    public function getSystemError()
    {
        return $this->get('system/error');
    }

    /**
     * @return array
     */
    public function getSystemLog()
    {
        return $this->get('system/log');
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
     * @param string $folder
     * @param int $levels
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
     * @param int $page
     * @param int $perPage
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
     * @param int $since
     * @param int $limit
     * @param string[] $events
     * @return array
     */
    public function getEvents($since = null, $limit = null, $events = [])
    {
        $parameters = [];
        if (!is_null($since)) {
            $parameters['since'] = $since;
        }
        if (!is_null($limit)) {
            $parameters['limit'] = $limit;
        }
        if (!empty($events)) {
            $parameters['events'] = implode(',', $events);
        }

        return $this->get('events', $parameters);
    }

    /**
     * @return array
     */
    public function getStatsDevice()
    {
        return $this->get('stats/device');
    }

    /**
     * @return array
     */
    public function getStatsFolder()
    {
        return $this->get('stats/folder');
    }

    /**
     * @param string $id
     * @return array
     */
    public function getSvcDeviceid($id)
    {
        return $this->get('svc/deviceid', compact('id'));
    }

    /**
     * @return array
     */
    public function getSvcLang()
    {
        return $this->get('svc/lang');
    }

    /**
     * @param int $length
     * @return array
     */
    public function getSvcRandomString($length = 20)
    {
        return $this->get('svc/random/string', compact('length'));
    }

    /**
     * @return array
     */
    public function getSvcReport()
    {
        return $this->get('svc/report');
    }

    /**
     * @param array $config
     * @return array
     */
    public function postSystemConfig(array $config)
    {
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
     * @param string $device
     * @param string $addr
     * @return array
     */
    public function postSystemDiscovery($device, $addr)
    {
        return $this->post('system/discovery', compact('device', 'addr'));
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

    /**
     * @param string $folder
     * @param array $ignores
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
     * @param $folder
     * @param null $sub
     * @param null $next
     * @return array
     */
    public function postDbScan($folder, $sub = null, $next = null)
    {
        $parameters = compact('folder');
        if (!is_null($sub)) {
            $parameters['sub'] = $sub;
        }
        if (!is_null($next)) {
            $parameters['next'] = $next;
        }

        return $this->post('db/scan', $parameters);
    }


    /**
     * @param string $uri
     * @param array $parameters
     * @return array
     */
    protected function get($uri, $parameters = [])
    {
        $result = $this->curl->get(
            $this->buildUri($uri, $parameters)
        );

        return $this->json($result);
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @param array $payload
     * @return array
     */
    protected function post($uri, $parameters = [], $payload = [])
    {
        $result = $this->curl->post(
            $this->buildUri($uri, $parameters),
            !empty($payload) ? ['body' => json_encode($payload)] : []
        );

        return $this->json($result);
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @return string
     */
    private function buildUri($uri, array $parameters)
    {
        return $uri.(!empty($parameters) ? '?'.http_build_query(compact('folder')) : '');
    }

    /**
     * @param ResponseInterface $result
     * @return array
     */
    private function json(ResponseInterface $result)
    {
        return json_decode($result->getBody()->getContents(), true);
    }
}