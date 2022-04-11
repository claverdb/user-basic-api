<?php

namespace Tests\app\Infrastrucutre\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUsersListControllerTest extends TestCase
{
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function noListedUsersFound()
    {
        $this->userDataSource
            ->expects('listedUsers')
            ->once();

        $response = $this->get("/api/users/list");

        $response->assertStatus(Response::HTTP_OK)->assertExactJson([]);
    }

    /**
     * @test
     */
    public function listedUsers()
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

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson([['id' => 1],['id' => 2],['id' => 3]]);
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
            ->andThrow(new Exception("Any exception"));

        $response = $this->get("/api/users/list");

        $response->assertStatus(Response::HTTP_BAD_REQUEST)->assertExactJson([
            'error' => "Hubo un error al realizar la peticion"
        ]);
    }
}
