<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class UserController { 
     
    protected $userService;

    function __construct() {
      $this->userService = new UserService();
    }

    public function createUser($data){ 

       $result = $this->userService->createUser($data);
       return $result;

    }
    

}