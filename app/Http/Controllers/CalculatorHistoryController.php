<?php

namespace App\Http\Controllers;

use App\Http\Resources\CalculatorHistoryResource;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Route;

class CalculatorHistoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CalculatorHistoryResource::collection(History::all());
    }

    public function create(Request $request)
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
    /**
     * Save the data to the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveData(Request $request)
    {
        $requestData = [
            'user_id' => $request->user()->id,
            'variables' => $request->input('variables'),
        ];

        $savedData = CalculatorHistoryResource::saveData($requestData);

        return response()->json([
            'message' => 'Сохранено',
            'data' => new CalculatorHistoryResource($savedData)
        ], 200);
    }

    public function getRecord($id)
    {
        $history = CalculatorHistoryResource::getRecord($id);

        return response()->json([
            'data' => $history
        ], 200);
    }
}
