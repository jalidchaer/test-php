<?php

declare(strict_types=1);



interface UserRepositoryInterface
{
    public function findAll();
    public function findById($id);
    public function findUserByEmail($email);
    public function save(User $user);
    public function update(User $user, $id);
    public function delete($id);
}