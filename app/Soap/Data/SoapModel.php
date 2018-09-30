<?php

namespace App\Soap\Data;

use Illuminate\Database\Eloquent\Collection;

class SoapModel extends Collection
{
    public function __get($key)
    {
        return $this->items[$key];
    }

    public function __set($key, $value)
    {
        $this->items[$key] = $value;
    }
}