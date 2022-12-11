<?php

class UserService { 
     
    protected $userRepository;

    function __construct() {
      $this->userRepository = new UserRepository();
    }

    public function createUser($data){

        if(empty($data['name']) || empty($data['email']) || empty($data['password']) || empty($data['phone']) || empty($data['address'])){
            throw new InvalidArgumentException('All data is required');
        }

     
        $name = $data['name'];
        $email = $data['email'];
        $password = md5($data['password']);
        $phone = $data['phone'];
        $address = $data['address'];
        
        // check if exist email
        $userExist = $this->userRepository->findUserByEmail($email);
        
        if($userExist){
            throw new Exception('Email already exists');
        }else{
            $user = new User($name, $email, $password, $phone, $address);
            $userCreated =   $this->userRepository->save($user);
            $result = false;
            if($userCreated){
               $result = (object)$user->getUser();
            }
           return $result;
        }
    }

}