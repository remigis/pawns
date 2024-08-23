<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function createUser(array $attributes):User;
    public function updateUser(int $id, array $attributes);
    public function deleteUser(int $id);
    public function findUser(int $id, array $columns = ['*']):User;
    public function findUserByEmail(string $email, array $columns = ['*']):User;
}
