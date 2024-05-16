<?php

namespace App\Http\Controllers\Rmsp;

use App\Http\Controllers\Controller;
use App\Models\Rmsp\CompanyType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CompanyTypeController extends Controller
{
    public function index(): Collection|array
    {
        return CompanyType::query()->with(['ownerType'])->get();
    }
}
