<?php

namespace Eadmin;

class Config
{
    private $table_prefix = 'test';

    public function __get($name)
    {
        return isset($this->$name) ? $this->$name : '';
    }

}