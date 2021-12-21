<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyoffersController extends Controller
{
    public function index()
    {
        return view('wemarkthespot.my-offers');
    }
}
