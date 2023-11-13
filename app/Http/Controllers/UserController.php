<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function current(): ?UserResource
    {
        if (auth('sanctum')->check()) {
            return new UserResource(auth('sanctum')->user());
        }

        return null;
    }

    public function updateRole(Request $request): Model
    {
        $user = User::query()->findOrFail($request->userId);
        $role = Role::query()->findOrFail($request->roleId);

        $user->update([
            'role_id' => $role->id
        ]);

        return $user;
    }
}
