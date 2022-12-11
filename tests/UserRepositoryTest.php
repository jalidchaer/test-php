<?php 

use PHPUnit\Framework\TestCase;


class UserRepositoryTest extends TestCase
{
    private $userRepository;

    public function setup(): void
    {
        $this->userRepository = new UserRepository();
    }

   private function getConnection(){
     $db = DbConnection::getInstance();
     return $db;
   }


    public function testThatCreateAnewUser(){
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = $faker->email;
        $password = md5(1234);
        $phone = $faker->phoneNumber;
        $address = $faker->address;

        $user = new User($name, $email, $password, $phone, $address);
        $result = $this->userRepository->save($user);
        $this->assertTrue($result);
       
    }


    public function testThatUpdateAnUser(){

        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = $faker->email;
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
         $id = $db->lastInsertId();
        
        $userToUpdate = new User($name, $email, $password, '111111', $address);
        $result = $this->userRepository->update($userToUpdate, $id);
        $this->assertTrue($result);
       
    }

    public function testThatDeleteAnUser(){

        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = $faker->email;
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
         $id = $db->lastInsertId();
        
        $result = $this->userRepository->delete($id);
        $this->assertTrue($result);
       
    }

    public function testThatGetAnUserById(){
       
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = $faker->email;
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
         $id = $db->lastInsertId();
         $result = $this->userRepository->findById($id);
         $this->assertEquals($result->email, $email);
    }

    public function testThatGetAnUserByEmail(){

        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = $faker->email;
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
         $result = $this->userRepository->findUserByEmail($email);
         $this->assertEquals($result->email, $email);

    }


    public function testThatGetAllUser(){
        $result = $this->userRepository->findAll();
        $this->assertIsArray($result);

    }

    
}