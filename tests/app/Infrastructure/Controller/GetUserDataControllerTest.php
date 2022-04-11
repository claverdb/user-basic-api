<?php

namespace Tests\app\Infrastrucutre\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUserDataControllerTest extends TestCase
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
    public function userWithGivenIdReturnsGenericError()
    {
        $this->userDataSource
            ->expects('findById')
            ->never();
        //->with(1)
        //->once()
        //->andThrow(new Exception('Error al realizar la petición'));

        $response = $this->get('/api/users/1');

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
                ->assertExactJson(['error' => 'Hubo un error al realizar la petición']);
    }

    /**
     * @test
     */
    public function userWithNotGivenIdReturnsError()
    {
        $this->userDataSource
            ->expects('findById')
            ->never();

        $response = $this->get('/api/users/');

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertExactJson(['error' => 'El id de usuario es obligatorio']);
    }
}
