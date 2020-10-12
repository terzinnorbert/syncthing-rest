<?php

namespace SyncthingRest\Responses;

class BaseResponse
{
    const cast = [];
    protected $response;
    /**
     * @var null
     */
    private $key = null;

    public function __construct($response, $key = null)
    {
        $this->response = $response;
        $this->key = $key;
    }

    public function __call($name, $arguments)
    {
        if (isset(static::cast["list"]) && array_key_exists($name, static::cast["list"])) {
            $response = $this->response[$name];
            foreach ($response as $key => &$item) {
                $item = $this->castClass(static::cast["list"][$name], $item, $key);
            }
            return $response;
        }
        if (isset(static::cast["entity"]) && array_key_exists($name, static::cast["entity"])) {
            return $this->castClass(static::cast["entity"][$name], $this->response[$name]);
        }
        return $this->response[$name] ?? null;
    }

    private function castClass($class, $data, $key = null)
    {
        return new $class($data, $key);
    }

    public function key()
    {
        return $this->key;
    }
}