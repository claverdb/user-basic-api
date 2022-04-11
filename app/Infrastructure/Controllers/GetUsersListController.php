<?php

namespace App\Infrastructure\Controllers;

use App\Application\UsersList\GetUsersListService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUsersListController extends BaseController
{
    private $getUsersListService;

    /**
     * GetUsersListService constructor.
     */
    public function __construct(GetUsersListService $getUsersListService)
    {
        $this->getUsersListService = $getUsersListService;
    }

    public function __invoke(): JsonResponse
    {
        $users_id = [];

        try {
            $getUsersList = $this->getUsersListService->execute();
        } catch (Exception $exception) {
            return response()->json([
                'error' => "Hubo un error al realizar la peticion"
            ], Response::HTTP_BAD_REQUEST);
        }
        foreach ($getUsersList as $user) {
            $users_id[] = ["id" => $user->getId()];
        }

        return response()->json($users_id, Response::HTTP_OK);
    }
}
