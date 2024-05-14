<?php

namespace App\Http\Controllers\Rmsp;

use App\Http\Controllers\Controller;
use App\Models\Rmsp\SupportForm;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SupportFormController extends Controller
{
    public function index(): Collection|array
    {
        return SupportForm::query()->get();
    }

    public function show(string $id)
    {
        //
    }
}
