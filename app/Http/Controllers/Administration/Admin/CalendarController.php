<?php

namespace App\Http\Controllers\Administration\Admin;

use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function index()
    {
        return view('theme.pages.Calendar.index');
    }
}
