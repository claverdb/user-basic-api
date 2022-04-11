<?php

namespace App\Infrastructure\Controllers;

//use App\Application\EarlyAdopter\IsEarlyAdopterService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserDataController extends BaseController
{
    public function __invoke(string $id): JsonResponse
    {
        return response()->json([
            'error' => 'Hubo un error al realizar la petición'
        ], Response::HTTP_BAD_REQUEST);
    }
}
