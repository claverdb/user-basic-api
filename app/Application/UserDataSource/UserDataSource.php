<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

interface UserDataSource
{
    public function findByEmail(string $email): User;

    public function findById(int $id): User;

    public function listedUsers(): array;
}
