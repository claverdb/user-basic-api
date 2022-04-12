<?php

namespace App\Application\UserDataSource;

use App\Domain\User;
use Exception;

class FakeUserDataSource implements UserDataSource
{
    public function findByEmail(string $email): User
    {
        if ($email == 'email@email.com') {
            return new User(1, $email);
        }
        throw(new Exception('User not found'));
    }

    public function findById(int $id): User
    {
        if ($id == 1) {
            return new User($id, 'user@user.com');
        }
        throw(new Exception('Usuario no encontrado'));
    }
}
