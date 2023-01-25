<?php

declare(strict_types=1);

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Models\Finance\Invoice;

class SellsController extends Controller
{
    public function index()
    {
        $totalSells = Invoice::sum('price_total');
        $totalSellsTaxes = Invoice::sum('price_total');

        return view('theme.pages.Statistic.Sell.index');
    }
}
