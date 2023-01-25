<?php

declare(strict_types=1);

namespace App\Http\Controllers\Commercial\Buy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commercial\Buy\BuyEstimateFormRequest;
use App\Http\Requests\Commercial\Buy\BuyEstimateUpdateFormRequest;
use App\Models\Finance\Buy\BuyEstimate;
use App\Models\Utilities\Tax;
use App\Repositories\Provider\ProviderInterface;
use App\Services\Commercial\Taxes\TVACalulator;
use Illuminate\Http\Request;

class BuyEstimateController extends Controller
{
    use TVACalulator;

    public function index()
    {
        $estimates = BuyEstimate::with('provider')->get();

        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        $providers = app(ProviderInterface::class)->Providers();

        return view('theme.pages.Commercial.Buy.BuyEstimate.index', compact('estimates', 'taxes', 'providers'));
    }

    public function create()
    {
        $providers = app(ProviderInterface::class)->Providers();

        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        return view('theme.pages.Commercial.Buy.BuyEstimate.create.index', compact('providers', 'taxes'));
    }

    public function store(BuyEstimateFormRequest $request)
    {
        $estimate = new BuyEstimate();
        $estimate->price_ht = $request->price_ht;
        $estimate->code = $request->code;
        $estimate->condition_general = $request->notes;
        $estimate->estimate_date = $request->date('estimate_date');

        if ($request->hasFile('estimate_file')) {
            $estimate->addMediaFromRequest('estimate_file')->toMediaCollection('buy_estimates');
        }

        $request->whenFilled('taxe', function ($taxe) use ($estimate) {
            $estimate->taxe()->associate($taxe)->save();

            $totalPrice = $this->caluculateTotalWithTax($estimate->price_ht, $estimate->taxe?->taux_percent);

            $taxePrice = $this->calculateOnlyTax($estimate->price_ht, $estimate->taxe?->taux_percent);

            $estimate->price_total = $totalPrice;

            $estimate->price_tva = $taxePrice;
        });

        $request->whenFilled('provider', function ($provider) use ($estimate) {
            $estimate->provider()->associate($provider)->save();
        });

        $estimate->save();

        return redirect(route('buy:estimates.index'))->with('success', 'le devis a été crée avec succès');
    }

    public function edit(BuyEstimate $estimate)
    {
        $providers = app(ProviderInterface::class)->Providers();

        $taxes = Tax::select(['id', 'taux_percent', 'name'])->get();

        return view('theme.pages.Commercial.Buy.BuyEstimate.edit.index', compact('estimate', 'taxes', 'providers'));
    }

    public function update(BuyEstimateUpdateFormRequest $request, BuyEstimate $estimate)
    {
        $estimate->price_ht = $request->price_ht;
        $estimate->code = $request->code;
        $estimate->condition_general = $request->notes;
        $estimate->estimate_date = $request->date('estimate_date');

        if ($request->hasFile('estimate_file')) {
            $estimate->clearMediaCollection('buy_estimates');

            $estimate->addMediaFromRequest('estimate_file')->toMediaCollection('buy_estimates');
        }

        $request->whenFilled('taxe', function ($taxe) use ($estimate) {
            $estimate->taxe()->associate($taxe)->save();

            $totalPrice = $this->caluculateTotalWithTax($estimate->price_ht, $estimate->taxe?->taux_percent);

            $taxePrice = $this->calculateOnlyTax($estimate->price_ht, $estimate->taxe?->taux_percent);

            $estimate->price_total = $totalPrice;

            $estimate->price_tva = $taxePrice;
        });

        $request->whenFilled('provider', function ($provider) use ($estimate) {
            $estimate->provider()->associate($provider)->save();
        });

        $estimate->save();

        return redirect(route('buy:estimates.index'))->with('success', 'le devis a été modifier avec succès');
    }

    public function delete(Request $request)
    {
        $request->validate(['estimateId' => 'required|uuid']);

        $estimate = BuyEstimate::whereUuid($request->estimateId)->firstOrFail();

        $this->authorize('delete', $estimate);

        if ($estimate) {
            $estimate->delete();

            return redirect(route('buy:estimates.index'))->with('success', 'Le DEVIS  a éte supprimer avec succès');
        }

        return redirect(route('buy:estimates.index'))->with('error', 'vous nous pouvez pas supprimer ce DEVIS ');
    }
}
