<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function createUser(array $attributes): User
    {
        $attributes['password'] = bcrypt($attributes['password']);
        return (new User)->create($attributes);
    }

    public function updateUser(int $id, array $attributes): void
    {
        User::whereId($id)->update($attributes);
    }

    public function deleteUser(int $id): void
    {
        User::whereId($id)->delete();
    }

    public function findUser(int $id, array $columns = ['*']): User
    {
        return User::whereId($id)->firstOrFail($columns);
    }

    public function findUserByEmail(string $email, array $columns = ['*']): User
    {
        return User::whereEmail($email)->firstOrFail($columns);
    }

}
