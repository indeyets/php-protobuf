<?php

namespace protobuf;

class Message implements ::Serializable
{
    function serialize(){}
    function unserialize($str){}
}

class Repeated
{
    private $array = array();
    private $class = null;

    public function __construct($class)
    {
        if (!is_string($class))
            throw new UnexpectedValueException();

        $this->class = $class;
    }
}
