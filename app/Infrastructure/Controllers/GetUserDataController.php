<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserData\GetUserDataService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserDataController extends BaseController
{
    private $getUserDataService;

    /**
     * GetUserDataController constructor.
     */
    public function __construct(GetUserDataService $getUserDataService)
    {
        $this->getUserDataService = $getUserDataService;
    }

    public function __invoke(int $id = null): JsonResponse
    {
        if ($id == null) {
            return response()->json([
                'error' => 'El id de usuario es obligatorio'
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = $this->getUserDataService->execute($id);
        } catch (Exception $exception) {
            if ($exception->getMessage() == 'Usuario no encontrado') {
                return response()->json([
                    'error' => $exception->getMessage()
                ], Response::HTTP_BAD_REQUEST);
            } else {
                return response()->json([
                    'error' => 'Hubo un error al realizar la peticion'
                ], Response::HTTP_BAD_REQUEST);
            }
        }

        return response()->json([
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ], Response::HTTP_OK);
    }
}
