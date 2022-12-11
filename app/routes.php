<?php

declare(strict_types=1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

return function ($app) {

    $app->post('/user/create', function (Request $request, Response $response, array $args) {
  
        $data = $request->getParsedBody();
        $userController = new UserController();
        try{
           $result = $userController->createUser($data);
           return $response->withJson(['result'=>$result, 'success' => true], 201);
        }catch(Exception $e){
           return $response->withJson(['result'=>$e->getMessage(), 'success' => false], 400);
          
        }
   });

   return $app;
};