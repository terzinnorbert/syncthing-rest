<?php
/**
 * @author Terzin Norbert <terzin.norbert@gmail.com>
 * @license MIT
 */

namespace SyncthingRest;

use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;
use SyncthingRest\Traits\DatabaseRest;
use SyncthingRest\Traits\EventRest;
use SyncthingRest\Traits\StatisticsRest;
use SyncthingRest\Traits\ServiceRest;
use SyncthingRest\Traits\SystemRest;

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
    use DatabaseRest;
    use EventRest;
    use StatisticsRest;
    use ServiceRest;
    use SystemRest;

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
     * @param $time
     * @return Carbon
     */
    public static function convertTime($time)
    {
        $time = explode('.', $time);
        $parse = $time[0];

        if (array_key_exists(1, $time)) {
            $parse .= '.'.(int)substr($time[1], 0, 6);
        }

        return Carbon::parse($parse);
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
        return $uri.(!empty($parameters) ? '?'.http_build_query($parameters) : '');
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