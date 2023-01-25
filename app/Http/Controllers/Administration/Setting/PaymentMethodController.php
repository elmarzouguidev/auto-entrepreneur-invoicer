<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Payment\PaymentMethodFormRequest;
use App\Models\Utilities\PaymentType;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $methods = PaymentType::all();

        return view('theme.pages.SettingV2.payment-method.index', [
            'methods' => $methods,
        ]);
    }

    public function store(PaymentMethodFormRequest $request)
    {
        $method = new PaymentType();
        $method->name = $request->name;
        $method->save();

        return redirect(route('admin:settings.payment'))->with('success', 'La method a éte crée avec succès');
    }

    public function delete(Request $request)
    {
        $method = PaymentType::whereUuid($request->methodId)->first();

        if ($method) {
            $method->delete();

            return redirect(route('admin:settings.payment'))->with('success', 'La method a éte supprimer avec succès');
        }

        return redirect(route('admin:settings.payment'))->with('error', 'vous nous pouvez pas supprimer cette method');
    }
}
