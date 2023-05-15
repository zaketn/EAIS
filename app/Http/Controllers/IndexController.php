<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function table_sald()
    {
        return view('table_sald');
    }
    public function table_number_workers()
    {
        return view('table_number_workers');
    }
    public function table_financial_stability()
    {
        return view('table_financial_stability');
    }
    public function table_main_financial()
    {
        return view('table_main_financial');
    }

    public function graph_sald()
    {
        return view('graph_sald');
    }
    public function graph_number_workers()
    {
        return view('graph_number_workers');
    }
    public function graph_financial_stability()
    {
        return view('graph_financial_stability');
    }
    public function graph_main_financial()
    {
        return view('graph_main_financial');
    }

}
