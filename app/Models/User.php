<?php 


class User { 

    private $name;
    private $email;
    private $password;
    private $phone;
    private $address;
    

  function __construct($name=null, $email=null, $password=null, $phone=null, $address=null) {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->phone = $phone;
    $this->address = $address;
   
  }
  function get_name() {
    return $this->name;
  }


  function get_email() {
    return $this->email;
  }

  function get_password() {
    return $this->password;
  }

  function get_phone(){
    return $this->phone;
  }

  function get_address(){
    return $this->address;
  }

  function getUser(){
    return array('name'=>$this->get_name(), 'email'=>$this->get_email(), 'phone'=>$this->get_phone(), 'address'=>$this->get_address());
  }

}