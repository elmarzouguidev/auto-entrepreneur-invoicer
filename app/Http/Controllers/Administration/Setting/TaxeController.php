<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Taxes\TaxeFormRequest;
use App\Models\Utilities\Tax;
use Illuminate\Http\Request;

class TaxeController extends Controller
{
    public function index()
    {
        $taxes = Tax::all();

        return view('theme.pages.SettingV2.Taxe.index', [
            'taxes' => $taxes,
        ]);
    }

    public function store(TaxeFormRequest $request)
    {
        $taxe = new Tax();
        $taxe->name = $request->name;
        $taxe->taux_percent = $request->taux_percent.'%';
        $taxe->save();

        return redirect(route('admin:settings.taxes'))->with('success', 'La taxe a éte crée avec succès');
    }

    public function delete(Request $request)
    {
        $taxe = Tax::whereUuid($request->taxeId)->first();

        if ($taxe && ! $taxe->products()->exists()) {
            $taxe->delete();

            return redirect(route('admin:settings.taxes'))->with('success', 'La taxe a éte supprimer avec succès');
        }

        return redirect(route('admin:settings.taxes'))->with('error', 'vous nous pouvez pas supprimer cette taxe car il a des produits');
    }
}
