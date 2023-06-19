<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): Collection
    {
        return User::all();
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

    public function current(): ?Authenticatable
    {
        return Auth::user();
    }

    public function updateRole(Request $request): Model
    {
        $user = User::query()->find($request->userId);
        $role = Role::query()->find($request->roleId);

        if($user->exists() && $role->exists()){
            $user->update([
                'role_id' => $role->id
            ]);
        } else{
            abort(404);
        }

        return $user;
    }
}
