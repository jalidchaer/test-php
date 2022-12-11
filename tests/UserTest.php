<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{

    public function testThatWeCanGetUser(){
        $user = new User('Joe','joe@gmail.com','1234','4446556','street 1'); 
        $this->assertEquals($user->get_name(), 'Joe');
        $this->assertEquals($user->get_email(), 'joe@gmail.com');
        $this->assertEquals($user->get_password(), '1234');
        $this->assertEquals($user->get_phone(), '4446556');
        $this->assertEquals($user->get_address(), 'street 1');
    }
    
}