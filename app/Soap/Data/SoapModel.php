<?php

namespace App\Soap\Data;

use JsonSerializable;

class SoapModel implements JsonSerializable
{
    /**
     * Stored the value for all properties
     *
     * @var array
     */
    protected $values;
    
    /**
     * SoapModel construct
     *
     * @param array $values
     */
    public function __construct($values)
    {
        $this->values = $values;
    }

    public function __get($key)
    {
        return $this->values[$key];
    }

    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * Get the data of class as array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->values;
    }

    /**
     * Serialize properties class to json
     *
     * @return string
     */
    public function jsonSerialize() {
        return $this->values;
    }
}