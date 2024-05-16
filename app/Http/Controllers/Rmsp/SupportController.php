<?php

namespace App\Http\Controllers\Rmsp;

use App\Http\Controllers\Controller;
use App\Models\Rmsp\Support;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Request $request) : Collection|array
    {
        $supports = Support::query()->filtered();

        return $supports->get();
    }
}
