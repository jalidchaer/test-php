<?php


include( "app/config/database/DbConnection.php");

class UserRepository implements UserRepositoryInterface{ 
    protected $db;

    function __construct() {
        $this->db = DbConnection::getInstance();
    }

    public function findAll(){
        $result =  $this->db->query("SELECT * FROM user order by id desc");
        return $result->fetchAll(PDO::FETCH_ASSOC);
     }

    public function findById($id){
       $result = $this->db->query("SELECT * FROM user where id='$id'");
       return $result->fetch(PDO::FETCH_OBJ);
    }


    public function findUserByEmail($email){
        $result =  $this->db->query("SELECT * FROM user where email='$email'");
        return $result->fetch(PDO::FETCH_OBJ);
    }


    public function save(User $user){
        $name = $user->get_name();
        $email = $user->get_email();
        $password = $user->get_password();
        $phone = $user->get_phone();
        $address = $user->get_address();
        try {
        $result =  $this->db->prepare("INSERT INTO user (name,email,password,phone,address)
        values('$name','$email','$password','$phone','$address')");
        return $result->execute();
        } catch(PDOExecption $e) {
             return  $e->getMessage();
        }
    }

    public function update(User $user, $id){
        $name = $user->get_name();
        $password = $user->get_password();
        $phone = $user->get_phone();
        $address = $user->get_address();
        try {
           $query =  $this->db->prepare("UPDATE user set name = '$name', password = '$password', phone = '$phone', address = '$address' where id = '$id'");
           $query->execute();
           $userUpdated = $query->rowCount();
           $result = false;
           if($userUpdated){
              $result = true;
           }
         return $result;
        } catch(PDOExecption $e) {
             return  $e->getMessage();
        }

    }

    public function delete($id){
        try {
           $query =  $this->db->prepare("DELETE from user where id = '$id'");
           $query->execute();
           $userDeleted = $query->rowCount();
           $result = false;
           if($userDeleted){
              $result = true;
           }
            return $result;
         } catch(PDOExecption $e) {
            return  $e->getMessage();
       }
    }



}