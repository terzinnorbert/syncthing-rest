<?php

namespace SyncthingRest\Responses;

use Iterator;
use SyncthingRest\Responses\DbBrowse\Entry;

class DbBrowse extends BaseResponse implements Iterator
{
    public function current()
    {
        return new Entry(key($this->response), current($this->response));
    }

    public function next()
    {
        return next($this->response);
    }

    public function valid(): bool
    {
        $key = key($this->response);
        return $key !== null && $key !== false;
    }

    public function rewind()
    {
        reset($this->response);
    }
}