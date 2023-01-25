<?php

namespace App\Http\Controllers\Administration\Import;

use App\Http\Controllers\Controller;

class CSVImportController extends Controller
{
    public function index()
    {
        return view('theme.pages.Importer.index');
    }
}
