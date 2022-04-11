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
    public function noUsersFound()
    {
        $this->userDataSource
            ->expects('listAll')
            ->never();
            //->once();

        $response = $this->get("/api/users/list");

        $response->assertExactJson([]);
    }

}
