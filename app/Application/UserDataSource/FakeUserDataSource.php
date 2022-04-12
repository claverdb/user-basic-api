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

    public function listedUsers(): array
    {
        $random_number = rand(1,2);
        if ($random_number == 1){
            $user1 = new User(1, 'email@email.com');
            $user2 = new User(2, 'email@email.com');
            $user3 = new User(3, 'email@email.com');

            return array($user1, $user2, $user3);
        }
        return [];
    }
}
