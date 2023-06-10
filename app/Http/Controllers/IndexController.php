<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        return view('home');
    }
    
    public function graph_sald()
    {
        return view('graph_sald');
    }

    public function graph_financial_stability()
    {
        return view('graph_financial_stability');
    }
}
