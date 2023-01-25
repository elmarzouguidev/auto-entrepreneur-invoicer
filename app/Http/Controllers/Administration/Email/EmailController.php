<?php

namespace App\Http\Controllers\Administration\Email;

use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function index()
    {
        return view('theme.pages.Email.index');
    }

    public function show()
    {
        return view('theme.pages.Email.read.index');
    }
}
