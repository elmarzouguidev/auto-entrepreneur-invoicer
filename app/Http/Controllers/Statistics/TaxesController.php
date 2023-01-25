<?php

declare(strict_types=1);

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;

class TaxesController extends Controller
{
    public function index()
    {
        return redirect()->route('commercial:sells');
    }
}
