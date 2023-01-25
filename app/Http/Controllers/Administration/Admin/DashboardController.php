<?php

namespace App\Http\Controllers\Administration\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Finance\Bill;
use App\Models\Finance\Estimate;
use App\Models\Finance\Invoice;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $clientsData = Client::has('invoices')
            ->withSum('invoices', 'price_total')
            ->withSum(['invoices as price_total_paid' => function ($query) {
                $query->has('bill');
            }], 'price_total')
            ->limit(20)
            ->get();

        $clients = $clientsData->sortBy([['invoices_sum_price_total', 'desc']]);

        if (request()->has('appFilter') && request()->filled('appFilter')) {
            // QueryBuilderRequest::setArrayValueDelimiter('|');

            $invoices = QueryBuilder::for(Invoice::dashboard())
                ->allowedFilters([
                    AllowedFilter::scope('GetPeriod', 'filters_periods'),
                    AllowedFilter::scope('DateBetween', 'filters_date'),

                ]);

            $bills = QueryBuilder::for(Bill::dashboard())
                ->allowedFilters([
                    AllowedFilter::scope('GetPeriod', 'filters_periods'),
                    AllowedFilter::scope('DateBetween', 'filters_date'),

                ]);

            $estimates = QueryBuilder::for(Estimate::dashboard())
                ->allowedFilters([
                    AllowedFilter::scope('GetPeriod', 'filters_periods'),
                    AllowedFilter::scope('DateBetween', 'filters_date'),

                ]);

            $allInvoices = $invoices->get();

            $allbills = $bills->get();

            $allEstimates = $estimates->get();

            $estimatesNotInvoiced = $allEstimates->filter(function ($estimate) {
                return ! $estimate->is_invoiced;
            })->count();

            $estimatesAccepted = $allEstimates->filter(function ($estimate) {
                return $estimate->is_invoiced;
            })->count();

            $estimatesExpired = $allEstimates->filter(function ($estimate) {
                return $estimate->due_date->isPast() && ! $estimate->is_invoiced;
            })->count();

            $invoicesNotPaid = $allInvoices->filter(function ($invoice) {
                return $invoice->status == 'non-paid' && ! $invoice->due_date->isPast();
            })->count();

            $invoicesPaid = $allInvoices->filter(function ($invoice) {
                return $invoice->status == 'paid';
            })->count();

            $invoicesRetard = $allInvoices->filter(function ($invoice) {
                // dd($invoice->due_date->isPast(),now()->toDateString());
                return $invoice->due_date->isPast() && $invoice->status == 'non-paid';
            })->count();

            $chiffreAff = collect($allInvoices)->sum('price_total');

            /*$chiffreTVA = collect($bills)->filter(function ($bill, $key) {
                return $bill->bill()->exists();
            })->sum('price_tva');*/
            $chiffreTVA = collect($allbills)->sum('price_tva');
            //dd($chiffreTVA);

            /*$chiffreBills = $allInvoices->filter(function ($invoice) {
                return $invoice->bill()->exists();
            })->sum('price_total');*/

            $chiffreBills = collect($allbills)->sum('price_total');

            $latest = [
                'invoices' => $allInvoices->take(5),
                'estimates' => $allEstimates->take(5),
                'clients' => Client::latest()->select(['id', 'uuid', 'created_at', 'entreprise'])->take(5)->get(),
            ];

            $allInvoices = $allInvoices->count();
            $allEstimates = $allEstimates->count();
        } else {
            $chiffreAff = Invoice::sum('price_total');
            $chiffreBills = Bill::sum('price_total');
            $chiffreTVA = Bill::sum('price_tva');

            $allInvoices = Invoice::count();

            $allEstimates = Estimate::count();

            $invoicesNotPaid = Invoice::doesntHave('bill')->count();
            $invoicesRetard = Invoice::doesntHave('bill')->whereDate('due_date', '<=', now()->toDateString())->count();

            $invoicesPaid = Invoice::whereStatus('paid')->has('bill')->count();

            $estimatesExpired = Estimate::where('is_invoiced', false)->whereDate('due_date', '<', now()->toDateString())->count();
            $estimatesNotInvoiced = Estimate::where('is_invoiced', false)->count();
            $estimatesAccepted = Estimate::where('is_invoiced', true)->count();

            $latest = [
                'invoices' => Invoice::latest()->select(['id', 'uuid', 'full_number', 'created_at'])->take(5)->get(),
                'estimates' => Estimate::latest()->select(['id', 'uuid', 'full_number', 'created_at'])->take(5)->get(),
                'clients' => Client::latest()->select(['id', 'uuid', 'created_at', 'entreprise'])->take(5)->get(),
            ];
        }

        $chart_options = [
            'chart_title' => 'Chiffre d affaire',
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
            'chart_title' => 'Règlement',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Finance\Bill',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'price_total',
            'chart_type' => 'bar',
            'chart_color' => '85, 110, 230',

        ];

        $chart_options3 = [
            'chart_title' => 'Les 5 Produits les plus vendu',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Catalog\Product',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'price_total',
            'chart_type' => 'bar',
            'chart_color' => '85, 110, 230',

        ];
        $chart_options4 = [
            'chart_title' => 'Les 5 Produits les plus rentable',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Catalog\Product',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'price_total',
            'chart_type' => 'bar',
            'chart_color' => '85, 110, 230',

        ];
        $chart = new LaravelChart($chart_options);

        $chart3 = new LaravelChart($chart_options2);

        $chart4 = new LaravelChart($chart_options3);

        $chart5 = new LaravelChart($chart_options4);

        return view(
            'theme.pages.Home.index',
            compact(
                'latest',
                'chiffreAff',
                'chiffreBills',
                'chiffreTVA',
                'invoicesPaid',
                'invoicesNotPaid',
                'invoicesRetard',
                'allInvoices',
                'allEstimates',
                'estimatesNotInvoiced',
                'estimatesExpired',
                'estimatesAccepted',
                'chart',
                'chart3',
                'chart4',
                'chart5',
                'clients'
            )
        );
    }
}
