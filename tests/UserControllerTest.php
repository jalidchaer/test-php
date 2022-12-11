<?php 

use PHPUnit\Framework\TestCase;


class UserControllerTest extends TestCase
{  

    private $userController;

    public function setup(): void
    {
        $this->userController = new UserController();
    }

    private function getConnection(){
        $db = DbConnection::getInstance();
        return $db;
    }
   

    public function testThatCreateUser(){
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = $faker->email;
        $password = md5(1234);
        $phone = $faker->phoneNumber;
        $address = $faker->address;
        $data = array('name'=>$name, 'email'=>$email, 'password'=>$password, 'phone'=>$phone, 'address'=>$address);
        $userController = $this->createMock(UserController::class);
        $userController->method('createUser')->willReturn((object)$data);
        $result = $userController->createUser($data);
     
        $this->assertEquals($email, $result->email);
    }


    public function testWhenUserDoesExist(){
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = 'test1@gmail.com';
        $password = md5(1234);
        $phone = $faker->phoneNumber;
        $address = $faker->address;

        $db = $this->getConnection();
        $query = "INSERT INTO user VALUES (NULL, :name , :email, :password, :phone, :address  )";
        $resultSet = $db->prepare($query);
        
         $params = array(
             "name" => $name,
             "email" => $email,
             "password"=> $password,
             "phone"=>$phone,
             "address"=>$address
         );

        $resultSet->execute($params);
        $data = array('name'=>$name,'email'=>'test1@gmail.com', 'password'=>$password, 'phone'=>$phone, 'address'=>$address);
        $this->expectException(Exception::class);
        $result = $this->userController->createUser($data);
       
     }

     public function testWhenInsertUserWithoutData(){
        $data = array();
        $this->expectException(InvalidArgumentException::class);
        $result = $this->userController->createUser($data);
     }

    
}