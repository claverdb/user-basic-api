<?php

namespace App\Application\UsersList;

use App\Application\UserDataSource\UserDataSource;
use Exception;

class GetUsersListService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * IsEarlyAdopterService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function execute(): array
    {
        return $this->userDataSource->listedUsers();
    }
}
