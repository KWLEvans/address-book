<?php

class Contact
{
    private $name;
    private $email;
    private $phone;

    function __construct($name, $email, $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    function get($property)
    {
        return $this->$property;
    }

    function set($property, $value)
    {
        $this->$property = $value;
    }

    function save()
    {
        array_push($_SESSION["contact_list"], $this);
    }

    static function getAll() {
        return $_SESSION["contact_list"];
    }

    static function deleteAll() {
        $_SESSION["contact_list"] = [];
    }
}

?>
