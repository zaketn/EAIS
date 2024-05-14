<?php

namespace App\Http\Controllers\Rmsp;

use App\Http\Controllers\Controller;
use App\Models\Rmsp\SupportUnitType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SupportUnitTypeController extends Controller
{
    public function index(): Collection|array
    {
        return SupportUnitType::query()->get();
    }


    public function show(string $id)
    {
        //
    }
}
