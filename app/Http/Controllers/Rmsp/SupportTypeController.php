<?php

namespace App\Http\Controllers\Rmsp;

use App\Http\Controllers\Controller;
use App\Models\Rmsp\SupportType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SupportTypeController extends Controller
{
    public function index(): Collection|array
    {
        return SupportType::query()->get();
    }

    public function show(string $id)
    {
        //
    }
}
