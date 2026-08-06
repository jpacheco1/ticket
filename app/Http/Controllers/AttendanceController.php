<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    function index()
    {
        return view('attendance.index');
    }
}
