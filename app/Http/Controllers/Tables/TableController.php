<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function meta() : array
    {
        return Table::query()
            ->select(['year'])
            ->distinct()
            ->get()
            ->toArray();
    }

    public function getTablesList(Request $request) : array
    {
        return Table::query()
            ->select(['id', 'name'])
            ->where([
                'year' => $request->year
            ])
            ->distinct()
            ->get()
            ->toArray();
    }

    public function get(Request $request)
    {
        return Table::query()
            ->select('data')
            ->findOrFail($request->id)
            ->toArray();
    }
}
