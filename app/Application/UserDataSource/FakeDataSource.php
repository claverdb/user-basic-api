<?php

namespace App\Application\UserDataSource;

use App\Domain\User;
use Exception;

class FakeDataSource implements UserDataSource
{
    public function findByEmail(string $email): User
    {
        $email_user = 'email@email.com';

        if($email == $email_user){
            return new User(1, $email_user);;
        } else {
            throw(new Exception('User not found'));
        }
    }

    public function listedUsers(): array
    {
        $user1 = new User(1, 'email@email.com');
        $user2 = new User(2, 'email@email.com');
        $user3 = new User(3, 'email@email.com');

        return array($user1, $user2, $user3);
    }
}
