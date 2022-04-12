<?php

namespace App\Application\UserData;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;

class GetUserDataService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * GetUserDataService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @param int $id
     * @return User
     * @throws Exception
     */
    public function execute(int $id): User
    {
        return $this->userDataSource->findById($id);
    }
}
