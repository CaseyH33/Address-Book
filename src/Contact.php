<?php
  class Contact
  {
    private $name;
    private $phone_number;
    private $address;

    function __construct($name, $number, $address)
    {
      $this->name = $name;
      $this->phone_number = $number;
      $this->address = $address;
    }

    function getName()
    {
      return $this->name;
    }

    function setName($new_name)
    {
      $this->name = $new_name;
    }

    function getPhoneNumber()
    {
      return $this->phone_number;
    }

    function setPhoneNumber($new_number)
    {
      $this->phone_number = $new_number;
    }

    function getAddress()
    {
      return $this->address;
    }

    function setAddress($new_address)
    {
      $this->address = $new_address;
    }

//pushes new contact into the list_of_contacts array, therefore saving it
    function save()
    {
      array_push($_SESSION['list_of_contacts'], $this);
    }

    static function getAll()
    {
      return $_SESSION['list_of_contacts'];
    }

//sets list_of_contacts to a blank array, erasing all current contacts
    static function deleteAll()
    {
      $_SESSION['list_of_contacts'] = array();
    }
  }
?>
