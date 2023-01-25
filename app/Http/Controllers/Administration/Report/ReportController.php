<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Report;

use App\Http\Controllers\Controller;
use App\Models\Client;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ReportController extends Controller
{
    public function index()
    {
        $chart_options = [
            'chart_title' => "Chiffre d'affaire",
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Finance\Invoice',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'price_total',
            'chart_type' => 'line',
            'chart_color' => '85, 110, 230',

        ];

        $chart_options2 = [
            'chart_title' => 'Encaissements',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Finance\Bill',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'price_total',
            'chart_type' => 'bar',
            'chart_color' => '85, 110, 230',

        ];

        $chart = new LaravelChart($chart_options);

        $chart2 = new LaravelChart($chart_options2);

        $clientsData = Client::has('invoices')
            ->withSum('invoices', 'price_total')
            ->withSum(['invoices as price_total_paid' => function ($query) {
                $query->has('bill');
            }], 'price_total')
            ->get();

        $clients = $clientsData->sortBy([['invoices_sum_price_total', 'desc']]);

        return view('theme.pages.Report.__datatable.index', compact('clients', 'chart', 'chart2'));
    }
}
