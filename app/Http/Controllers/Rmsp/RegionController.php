<?php

namespace App\Http\Controllers\Rmsp;

use App\Http\Controllers\Controller;
use App\Models\Rmsp\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(): Collection|array
    {
        return Region::query()->filtered()->get();
    }
    public function show(string $id)
    {
        //
    }
}
