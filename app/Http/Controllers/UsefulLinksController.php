<?php

namespace App\Http\Controllers;

use App\Models\UsefulLinks;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UsefulLinksController extends Controller
{
    public function index(): Collection
    {
        return UsefulLinks::query()->where('draft', false)->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request) : bool
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'url' => 'required|url'
        ]);

        $result = UsefulLinks::query()->create([
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'url' => $request->post('url'),
            'draft' => true
        ]);

        return (bool)$result;
    }

    public function show(string $id)
    {
        //
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
}

