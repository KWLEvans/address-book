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

    static function getByName($contact_name)
    {
        foreach ($_SESSION["contact_list"] as $contact) {
            if ($contact->name == $contact_name) {
                return $contact;
            }
        }
    }

    static function delete($contact_object)
    {
        $target = array_search($contact_object, $_SESSION["contact_list"]);
        unset($_SESSION["contact_list"][$target]);
    }

    static function getAll() {
        return $_SESSION["contact_list"];
    }

    static function deleteAll() {
        $_SESSION["contact_list"] = [];
    }
}

?>
