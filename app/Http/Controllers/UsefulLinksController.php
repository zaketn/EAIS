<?php

namespace App\Http\Controllers;

use App\Models\UsefulLinks;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UsefulLinksController extends Controller
{
    public function index(): Collection
    {
        return UsefulLinks::all();
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

