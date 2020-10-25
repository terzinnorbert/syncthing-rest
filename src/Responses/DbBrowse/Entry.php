<?php

namespace SyncthingRest\Responses\DbBrowse;

use SyncthingRest\Responses\DbBrowse;

class Entry
{
    const PARAMETER_DATETIME = 0;
    const PARAMETER_SIZE = 1;
    private $name;
    private $parameters;

    public function __construct($name, $parameters)
    {
        $this->name = $name;
        $this->parameters = $parameters;
    }

    public function isFolder(): bool
    {
        return !array_key_exists(0, $this->parameters);
    }

    public function isFile(): bool
    {
        return !$this->isFolder();
    }

    public function name(): string
    {
        return $this->name;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return string|null
     */
    public function date()
    {
        return $this->isFile() ? $this->parameters[self::PARAMETER_DATETIME] : null;
    }

    /**
     * @return int|null
     */
    public function size()
    {
        return $this->isFile() ? $this->parameters[self::PARAMETER_SIZE] : null;
    }

    public function hasChildren(): bool
    {
        return $this->isFolder() && !empty($this->parameters);
    }

    /**
     * @return DbBrowse|null
     */
    public function children()
    {
        if ($this->isFolder()) {
            return new DbBrowse($this->parameters);
        }
        return null;
    }
}