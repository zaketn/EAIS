<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function current(): ?UserResource
    {
        if (auth('sanctum')->check()) {
            return new UserResource(auth('sanctum')->user());
        }

        return null;
    }
}
