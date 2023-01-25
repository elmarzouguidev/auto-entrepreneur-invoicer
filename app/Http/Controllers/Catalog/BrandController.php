<?php

declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\BrandFormRequest;
use App\Models\Catalog\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')->get();

        return view('theme.pages.Catalog.Brand.index', compact('brands'));
    }

    public function store(BrandFormRequest $request)
    {
        $brand = new Brand();

        $brand->name = $request->name;

        $brand->save();

        if ($request->hasFile('photo')) {
            $brand->addMediaFromRequest('photo')->toMediaCollection('brands_logos');
        }

        return redirect(route('commercial:brands'))->with('success', 'la marque a été ajouté avec succès');
    }

    public function delete(Request $request)
    {
        $request->validate(['brandId' => 'required|uuid']);

        $brand = Brand::whereUuid($request->brandId)->firstOrFail();

        $this->authorize('delete', $brand);

        if ($brand) {
            $brand->products->each->update(['brand_id' => null]);

            $brand->delete();

            return redirect(route('commercial:brands'))->with('success', 'la marque a éte supprimer avec succès');
        }

        return redirect(route('commercial:brands'))->with('error', 'vous nous pouvez pas supprimer cette marque ');
    }
}
