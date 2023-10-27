<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use App\Models\CalculatorParameters;
use Illuminate\Http\Request;

class CalculatorParametersController extends Controller
{
    public function index()
    {
        return CalculatorParameters::all();
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

    public function update(Request $request, string $slug)
    {
        $request->validate([
           'value' => 'required|numeric'
        ]);

        $oParameter = CalculatorParameters::query()
            ->where('slug', $slug)
            ->firstOrFail();

        return $oParameter->update([
            'value' => $request->post('value')
        ]);
    }

    public function destroy(string $id)
    {
        //
    }
}
