<?php

namespace App\Http\Controllers;

use App\Http\Resources\CalculatorHistoryResource;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CalculatorHistoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CalculatorHistoryResource::collection(History::all());
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
        return CalculatorHistoryResource::collection(History::query()->firstWhere('id', $id));
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
