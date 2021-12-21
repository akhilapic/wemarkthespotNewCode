<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportManagementController extends Controller
{
    public function index()
    {
        return view('wemarkthespot.report-management');
    }
}
