<?php

namespace Tests\app\Application\UsersList;

use App\Application\UsersList\GetUsersListService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class GetUsersListServiceTest extends TestCase
{
    private GetUsersListService $getUsersListService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->getUsersListService = new GetUsersListService($this->userDataSource);
    }

    /**
     * @test
     */
    public function emtpyUserListFound()
    {
        $this->userDataSource
            ->expects('listedUsers')
            ->withNoArgs()
            ->once();

        $getUsersListService = $this->getUsersListService->execute();

        $this->assertEquals($getUsersListService, []);
    }

    /**
     * @test
     */
    public function notEmptyUserListFound()
    {
        $user1 = new User(1, 'email@email.com');
        $user2 = new User(2, 'email@email.com');
        $user3 = new User(3, 'email@email.com');

        $users_array = array($user1, $user2, $user3);

        $this->userDataSource
            ->expects('listedUsers')
            ->withNoArgs()
            ->once()
            ->andReturn($users_array);

        $getUsersListService = $this->getUsersListService->execute();

        $this->assertEquals($getUsersListService, $users_array);
    }

    /**
     * @test
     */
    public function genericErrorGiven()
    {
        $this->userDataSource
            ->expects('listedUsers')
            ->withNoArgs()
            ->once()
            ->andThrow(new Exception('Any exception'));

        $this->expectException(Exception::class);

        $this->getUsersListService->execute();
    }
}
