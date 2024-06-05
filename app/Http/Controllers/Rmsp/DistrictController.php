<?php

namespace App\Http\Controllers\Rmsp;

use App\Http\Controllers\Controller;
use App\Models\Rmsp\District;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(): Collection|array
    {
        return District::query()->get();
    }
    public function show(string $id)
    {
        //
    }
}
