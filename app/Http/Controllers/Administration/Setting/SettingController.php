<?php

namespace App\Http\Controllers\Administration\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Company\CompanySettingRequest;
use App\Http\Requests\Setting\Document\DocumentRequest;
use App\Settings\CompanySettings;
use App\Settings\DocumentSettings;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(CompanySettings $settings)
    {
        return view('theme.pages.SettingV2.Company.index', [
            'setting' => $settings,
        ]);
    }

    public function update(
        CompanySettingRequest $request,
        CompanySettings $settings
    ) {
        $settings->name = $request->name;
        $settings->website = $request->website;
        $settings->addresse = $request->addresse;
        $settings->telephone_b = $request->telephone_b;
        $settings->telephone_a = $request->telephone_a;
        $settings->email = $request->email;
        $settings->rc = $request->rc;
        $settings->ice = $request->ice;
        $settings->cnss = $request->cnss;
        $settings->patente = $request->patente;
        $settings->if = $request->if;

        $settings->bank_name = $request->bank_name;
        $settings->bank_rib = $request->bank_rib;

        if ($request->hasFile('logo')) {
            $old = $settings->logo;
            $settings->logo = $request->file('logo')->store('company', ['disk' => 'public']);

            Storage::disk('public')->delete($old);
        }
        $settings->save();

        return redirect()->back()->with('success', 'Update a éte effectuer avec success');
    }

    /*******Invoice *****************/

    public function invoice(DocumentSettings $settings)
    {
        return view('theme.pages.SettingV2.Invoice.index', [
            'setting' => $settings,
        ]);
    }

    public function invoiceUpdate(DocumentRequest $request, DocumentSettings $settings)
    {
        $settings->invoice_start = (int) $request->invoice_start;

        $settings->invoice_prefix = $request->invoice_prefix;

        $settings->save();

        return redirect()->back()->with('success', 'Update a éte effectuer avec success');
    }
}
