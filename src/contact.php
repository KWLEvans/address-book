<?php

class Contact
{
    private $name;
    private $street;
    private $city;
    private $state;
    private $zip;
    private $address;
    private $email;
    private $phone;

    function __construct($name, $street, $city, $state, $zip, $email, $phone)
    {
        $this->name = $name;
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->address = $this->buildAddress();
        $this->email = $email;
        $this->phone = $phone;
    }

    function buildAddress()
    {
      return $this->address = $this->street . " " . $this->city . ", " . $this->state . " " . $this->zip;
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
