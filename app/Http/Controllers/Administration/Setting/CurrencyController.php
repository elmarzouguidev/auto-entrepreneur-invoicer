<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Currency\CurrencyFormRequest;
use App\Models\Utilities\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();

        return view('theme.pages.SettingV2.Currency.index', [
            'currencies' => $currencies,
        ]);
    }

    public function store(CurrencyFormRequest $request)
    {
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->symbole = $request->symbole;
        $currency->save();

        return redirect(route('admin:settings.currency'))->with('success', 'La method a éte crée avec succès');
    }

    public function delete(Request $request)
    {
        $currency = Currency::whereUuid($request->currencyId)->first();

        if ($currency) {
            $currency->delete();

            return redirect(route('admin:settings.currency'))->with('success', 'La method a éte supprimer avec succès');
        }

        return redirect(route('admin:settings.currency'))->with('error', 'vous nous pouvez pas supprimer cette method');
    }
}
