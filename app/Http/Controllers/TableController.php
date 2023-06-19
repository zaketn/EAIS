<?php

namespace App\Http\Controllers;

use App\Models\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index(): array
    {
        return Table::query()
            ->select(['id', 'year', 'name'])
            ->get()
            ->groupBy('year')
            ->toArray();
    }

    public function show(string $id): array
    {
        return Table::query()
            ->select('data')
            ->findOrFail($id)
            ->toArray();
    }

    public function store(Request $request): Model|Builder
    {
        $request->validate([
            'year' => 'required',
            'name' => 'required',
            'data' => 'required'
        ]);

        return Table::query()
            ->create([
                'year' => $request->year,
                'name' => $request->name,
                'data' => json_encode($request->data)
            ]);
    }
}
