<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home() : View
    {
        return view('home');
    }

    public function tables() : View
    {
        return view('tables');
    }

    public function statistics(): View
    {
        return view('statistics');
    }
}
