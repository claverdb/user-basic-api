<?php

namespace App\Infrastructure\Controllers;

//use App\Application\EarlyAdopter\IsEarlyAdopterService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserDataController extends BaseController
{
    public function __invoke(string $id = null): JsonResponse
    {
        if($id == null){
            return response()->json([
                'error' => 'El id de usuario es obligatorio'
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'error' => 'Hubo un error al realizar la petición'
        ], Response::HTTP_BAD_REQUEST);
    }
}
