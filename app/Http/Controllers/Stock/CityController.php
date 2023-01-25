<?php

declare(strict_types=1);

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\CityFormRequest;
use App\Models\Stock\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    public function index()
    {
        $cities = City::withCount('warehouses')->get();

        return view('theme.pages.Stock.City.index', compact('cities'));
    }

    public function store(CityFormRequest $request)
    {
        $city = new City();

        $city->name = $request->name;

        $city->save();

        if ($request->hasFile('photo')) {
            $city->addMediaFromRequest('photo')->toMediaCollection('cities_photos');
        }

        return redirect(route('commercial:cities'))->with('success', 'la ville a été ajouté avec succès');
    }

    public function delete(Request $request)
    {
        $request->validate(['cityId' => 'required|uuid']);

        $city = City::whereUuid($request->cityId)->firstOrFail();

        $this->authorize('delete', $city);

        if ($city) {
            $city->delete();

            return redirect(route('commercial:cities'))->with('success', 'La ville a éte supprimer avec succès');
        }

        return redirect(route('commercial:cities'))->with('error', '!! error');
    }
}
