<?php

namespace Tests\app\Application\UserData;

use App\Application\UserData\GetUserDataService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class GetUserDataServiceTest extends TestCase
{
    private GetUserDataService $getUserDataService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->getUserDataService = new GetUserDataService($this->userDataSource);
    }

    /**
     * @test
     */
    public function userWithGivenIdReturnsGenericError()
    {
        $id = 1;

        $user = new User($id, 'user@user.com');

        $this->userDataSource
            ->expects('findById')
            ->with($id)
            ->once()
            ->andThrow(new Exception('Error al realizar la petición'));

        $this->expectException(Exception::class);

        $this->getUserDataService->execute($id);
    }

    /**
     * @test
     */
    public function userWithGivenIdDoesNotExistAndReturnsError()
    {
        $id = 999;

        $this->userDataSource
            ->expects('findById')
            ->with($id)
            ->once()
            ->andThrow(new Exception('Usuario no encontrado'));

        $this->expectException(Exception::class);

        $this->getUserDataService->execute($id);
    }

    /**
     * @test
     */
    public function userWithGivenIdReturnsUserData()
    {
        $id = 1;
        $user = new User($id, 'user@user.com');

        $this->userDataSource
            ->expects('findById')
            ->with($id)
            ->once()
            ->andReturn($user);

        $result = $this->getUserDataService->execute($id);

        $this->assertEquals($user, $result);
    }
}
