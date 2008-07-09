<?php

namespace tutorial;

class PhoneNumber extends protobuf::Message
{
    const PhoneType_MOBILE = 0;
    const PhoneType_HOME = 1;
    const PhoneType_WORK = 2;

    private static $PhoneType_ENUM = array(0, 1, 2);

    private $number = '';
    private $type = self::PhoneType_HOME;

    public function __get($name)
    {
        switch ($name) {
            case 'number':
            case 'type':
                return $this->$name;
            break;

            default:
                throw new LogicException();
            break;
        }
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case 'number':
                $this->$name = strval($value);
            break;

            case 'type':
                if (!in_array($value, self::$PhoneType_ENUM))
                    throw new UnexpectedValueException();

                $this->$name = intval($value);
            break;

            default:
                throw new LogicException();
            break;
        }
    }
}

class Person extends protobuf::Message
{
    private $name = '';
    private $id = 0;
    private $email = null;
    private $phone = array();

    public function __get($name)
    {
        switch ($name) {
            case 'name':
            case 'id':
            case 'email':
            case 'phone':
                return $this->$name;
            break;

            default:
                throw new LogicException();
            break;
        }
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case 'name':
            case 'email':
                $this->$name = strval($value);
            break;

            case 'id':
                if (!is_numeric($value))
                    throw new UnexpectedValueException();

                $this->$name = intval($value);
            break;

            case 'phone':
                throw new LogicException($name.' is an array. Not allowed to set directly');
            break;

            default:
                throw new LogicException();
            break;
        }
    }

    public function __unset($name)
    {
        switch ($name) {
            case 'email':
                $this->email = null;
            break;

            default:
                throw new LogicException();
            break;
        }
    }
}

/*
// See README.txt for information and build instructions.

package tutorial;

option java_package = "com.example.tutorial";
option java_outer_classname = "AddressBookProtos";

message Person {
  required string name = 1;
  required int32 id = 2;        // Unique ID number for this person.
  optional string email = 3;

  enum PhoneType {
    MOBILE = 0;
    HOME = 1;
    WORK = 2;
  }

  message PhoneNumber {
    required string number = 1;
    optional PhoneType type = 2 [default = HOME];
  }

  repeated PhoneNumber phone = 4;
}

// Our address book file is just one of these.
message AddressBook {
  repeated Person person = 1;
}
*/