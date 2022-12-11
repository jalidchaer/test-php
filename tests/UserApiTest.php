<?php 

use PHPUnit\Framework\TestCase;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use Psr\Http\Message\ResponseInterface;


class UserApiTest extends TestCase
{  


    public function runApp(
        string $requestMethod,
        string $requestUri,
        array $requestData = null
    ): ResponseInterface {
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        $request = Request::createFromEnvironment($environment);
      

        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }
        $dotenv = Dotenv\Dotenv::createImmutable('./');
        $dotenv->load();
        $app = new App();
        $container = $app->getContainer();
        (include "app/routes.php")($app);
       
        return $app->process($request, new Response());
    }

    private function getConnection(){
        $db = DbConnection::getInstance();
        return $db;
    }

    public function testEndpointThatCreateAnUser(){

        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = $faker->email;
        $password = md5(1234);
        $phone = $faker->phoneNumber;
        $address = $faker->address;

        $response = $this->runApp(
            'POST',
            '/user/create',
            ['name' => $name, 'email' => $email, 'password' => $password, 'phone'=>$phone, 'address'=>$address]
        );

        $result = (string) $response->getBody();
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('email', $result);
    }

    public function testEndpointThatCreateAnUserWithoutAllData(){

        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = $faker->email;
        $password = md5(1234);
       
        $response = $this->runApp(
            'POST',
            '/user/create',
            ['name' => $name, 'email' => $email, 'password' => $password]
        );

        $result = (string) $response->getBody();
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);

    }

    public function testEndpointThatCreateAnUserDoesExist(){

        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = 'test2@gmail.com';
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

        $response = $this->runApp(
            'POST',
            '/user/create',
            ['name' => $name, 'email' => 'test2@gmail.com', 'password' => $password, 'phone'=>$phone, 'address'=>$address]
        );


        $result = (string) $response->getBody();
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);

    }

   
}