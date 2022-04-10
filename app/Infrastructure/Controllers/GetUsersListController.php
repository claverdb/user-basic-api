<?php

namespace App\Infrastructure\Controllers;

use App\Application\EarlyAdopter\IsEarlyAdopterService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUsersListController extends BaseController
{
    public function __invoke(): JsonResponse
    {
        return response()->json([], Response::HTTP_OK);
    }
}
