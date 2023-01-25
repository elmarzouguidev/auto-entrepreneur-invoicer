<?php

namespace App\Http\Controllers\Administration\Admin;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('theme.pages.Contact.index');
    }
}
