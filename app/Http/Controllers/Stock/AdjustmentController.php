<?php

declare(strict_types=1);

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\AdjustmentFormRequest;
use App\Models\Catalog\Product;
use App\Models\Stock\Adjustment;
use App\Models\Stock\AdjustmentProduct;
use App\Models\Stock\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdjustmentController extends Controller
{
    public function index()
    {
        $adjustments = Adjustment::with(['warehouse:id,name', 'adjustmentsProducts', 'histories'])->withCount('adjustmentsProducts')->get();
        $warehouses = Warehouse::select(['id', 'name'])->get();
        $products = Product::select(['id', 'name'])->get();

        return view('theme.pages.Stock.Adjustment.index', compact('adjustments', 'warehouses', 'products'));
    }

    public function store(AdjustmentFormRequest $request)
    {
        DB::transaction(function () use ($request) {
            $adjustment = new Adjustment();

            $adjustment->reference = $request->reference;

            $adjustment->date = now();

            $adjustment->warehouse()->associate($request->warehouse);

            $adjustment->user()->associate(auth()->user());

            $products = $request->getProducts()->map(function ($item) use ($request, $adjustment) {
                if ($item && $item['qte'] > 0 && $item['type'] === 'sub') {
                    $product = AdjustmentProduct::whereProductId($item['product_id'])
                        ->whereWarehouseId($request->warehouse)
                        ->first();

                    if (! $product || $product && $product->totalQte($request->warehouse) < $item['qte']) {
                        throw ValidationException::withMessages([
                            'product_stock_exists' => "La quantité montionner n'exists pas dans L'ENTREPÔT {$adjustment->warehouse?->name}",
                        ]);
                    }
                }

                return collect($item)->merge(['date' => now(), 'warehouse_id' => $request->warehouse]);
            })->toArray();

            $adjustment->save();

            if (! empty($products)) {
                $adjustment->adjustmentsProducts()->createMany($products);
            }

            $adjustmentProducts = $adjustment->adjustmentsProducts()->get();

            $productsHistories = $adjustmentProducts->map(function ($item) use ($adjustment) {
                $historyMessage = $item->type === 'add' ? "a ajouter une quantité de  {$item->qte}({$item->product?->unite?->name}) pour le produit ({$item->product?->name}) sur l'entrepôt {$adjustment->warehouse?->name}"
                    : "a soustraire une quantité de {$item->qte}({$item->product?->unite?->name}) pour le produit ({$item->product?->name}) depuis l'entrepôt {$adjustment->warehouse?->name}";

                return [
                    'user_id' => auth()->id(),
                    'user' => auth()->user()->full_name,
                    'detail' => $historyMessage,
                    'action' => $item->type,
                ];
            })->toArray();

            if (! empty($productsHistories)) {
                $adjustment->histories()->createMany($productsHistories);
            }
        });

        return redirect(route('commercial:adjustments'))->with('success', "l'ajustement a été ajouté avec succès");
    }

    public function oldStore(AdjustmentFormRequest $request)
    {
        $adjustment = new Adjustment();
        $adjustment->reference = $request->reference;

        $adjustment->date = now();
        $adjustment->warehouse()->associate($request->warehouse);
        $adjustment->product()->associate($request->product);
        $adjustment->user()->associate(auth()->user());

        if ($request->type === 'add') {
            $addj = Adjustment::where([
                'product_id' => $request->product,
                'warehouse_id' => $request->warehouse,
            ])->first();

            if ($addj && $addj->type === 'add' && $request->type === 'add') {
                $addj->qte_net += $request->qte_net;
                $addj->save();
            } else {
                $adjustment->qte_net = $request->qte_net;

                $adjustment->save();
            }
        } else {
            $addj = Adjustment::where([
                'product_id' => $request->product,
                'warehouse_id' => $request->warehouse,
            ])->first();
            if ($addj && $addj->type === 'add' && $addj->qte_net >= $request->qte_net && $request->type === 'sub') {
                $addj->qte_net -= $request->qte_net;
                $addj->save();
            }
        }

        return redirect(route('commercial:adjustments'))->with('success', "l'ajustement a été ajouté avec succès");
    }

    public function delete(Request $request)
    {
        $request->validate(['adjustmentId' => 'required|uuid']);

        $adjustment = Adjustment::whereUuid($request->adjustmentId)->firstOrFail();

        $this->authorize('delete', $adjustment);

        if ($adjustment) {
            $adjustment->adjustmentsProducts->each->delete();

            $adjustment->histories->each->delete();

            $adjustment->delete();

            return redirect(route('commercial:adjustments'))->with('success', "L' ajustement a éte supprimer avec succès");
        }

        return redirect(route('commercial:adjustments'))->with('error', '!! error');
    }
}
