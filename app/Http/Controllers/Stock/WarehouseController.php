<?php

declare(strict_types=1);

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\WarehouseFormRequest;
use App\Models\Stock\City;
use App\Models\Stock\Warehouse;
use App\Models\User;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::with(['city:id,name', 'user:id,nom,prenom'])
            ->withCount('products')
            ->get();

        $cities = City::select(['id', 'name'])->get();

        $users = User::select(['id', 'nom', 'prenom'])->get();

        return view('theme.pages.Stock.Warehouse.index', compact('warehouses', 'cities', 'users'));
    }

    public function store(WarehouseFormRequest $request)
    {
        $warehouse = new Warehouse();
        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->map = $request->map;

        $warehouse->save();

        $request->whenFilled('city', function ($city) use ($warehouse) {
            $warehouse->city()->associate($city)->save();
        });

        $request->whenFilled('user', function ($user) use ($warehouse) {
            $warehouse->user()->associate($user)->save();
        });

        return redirect(route('commercial:warehouses'))->with('success', 'le dépot a été ajouté avec succès');
    }

    public function delete(Request $request)
    {
        $request->validate(['warehouseId' => 'required|uuid']);

        $warehouse = Warehouse::whereUuid($request->warehouseId)->firstOrFail();

        $this->authorize('delete', $warehouse);

        if ($warehouse) {
            $warehouse->adjustments->each->delete();

            $warehouse->delete();

            return redirect(route('commercial:warehouses'))->with('success', 'Le dépot a éte supprimer avec succès');
        }

        return redirect(route('commercial:warehouses'))->with('error', '!! error');
    }
}
