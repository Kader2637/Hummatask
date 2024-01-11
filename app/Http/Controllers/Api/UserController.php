<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * user
     *
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        return ResponseHelper::success(UserResource::make(auth()->user()));
    }
}
