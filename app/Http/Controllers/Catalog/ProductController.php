<?php

declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\ProductFormRequest;
use App\Http\Requests\Catalog\UpdateProductFormRequest;
use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use App\Models\Catalog\Unite;
use App\Models\Utilities\Tax;
use App\Services\Commercial\Taxes\TVACalulator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use TVACalulator;

    public function index()
    {
        $products = Product::with(['category:id,name', 'brand:id,name', 'unite:id,name', 'tax:id,taux_percent'])->get();

        $categories = Category::select(['id', 'name'])->get();

        $brands = Brand::select(['id', 'name'])->get();

        $unites = Unite::select(['id', 'name', 'symbole'])->get();

        $taxes = Tax::select(['id', 'name', 'taux_percent'])->get();

        return view('theme.pages.Catalog.Product.index', compact('products', 'categories', 'brands', 'unites', 'taxes'));
    }

    public function store(ProductFormRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price_brut = $request->price_brut ?? 0;
        $product->price_net = $request->price_net ?? 0;
        $product->sku = strtoupper($request->sku);
        $product->price_buy = $request->price_buy;
        $product->price_sell = $request->price_sell;

        if ($request->hasFile('photo')) {
            $product->addMediaFromRequest('photo')->toMediaCollection('products_photos');
        }

        $request->whenFilled('category', function ($category) use ($product) {
            $product->category()->associate($category)->save();
        });

        $request->whenFilled('brand', function ($brand) use ($product) {
            $product->brand()->associate($brand)->save();
        });

        $request->whenFilled('unite', function ($unite) use ($product) {
            $product->unite()->associate($unite)->save();
        });

        $request->whenFilled('taxe', function ($taxe) use ($product) {
            $product->tax()->associate($taxe)->save();

            $totalPrice = $this->caluculateTotalWithTax($product->price_sell, $product->tax?->taux_percent);

            $taxePrice = $this->calculateOnlyTax($product->price_sell, $product->tax?->taux_percent);

            $product->price_sell_total = $totalPrice;

            $product->price_tax = $taxePrice;
        });

        $product->save();

        return redirect(route('commercial:products'))->with('success', 'le produit a été ajouté avec succès');
    }

    public function edit(Product $product)
    {
        $categories = Category::select(['id', 'name'])->get();

        $brands = Brand::select(['id', 'name'])->get();

        $unites = Unite::select(['id', 'name', 'symbole'])->get();

        $taxes = Tax::select(['id', 'name', 'taux_percent'])->get();

        return view('theme.pages.Catalog.Product.edit.index', compact('product', 'unites', 'taxes', 'categories', 'brands'));
    }

    public function update(UpdateProductFormRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price_brut = $request->price_brut ?? 0;
        $product->price_net = $request->price_net ?? 0;
        $product->sku = strtoupper($request->sku);
        $product->price_buy = $request->price_buy;
        $product->price_sell = $request->price_sell;

        if ($request->hasFile('photo')) {
            $product->clearMediaCollection('products_photos');

            $product->addMediaFromRequest('photo')->toMediaCollection('products_photos');
        }

        $request->whenFilled('category', function ($category) use ($product) {
            $product->category()->associate($category)->save();
        });

        $request->whenFilled('brand', function ($brand) use ($product) {
            $product->brand()->associate($brand)->save();
        });

        $request->whenFilled('unite', function ($unite) use ($product) {
            $product->unite()->associate($unite)->save();
        });

        $request->whenFilled('taxe', function ($taxe) use ($product) {
            $product->tax()->associate($taxe)->save();

            $totalPrice = $this->caluculateTotalWithTax($product->price_sell, $product->tax?->taux_percent);

            $taxePrice = $this->calculateOnlyTax($product->price_sell, $product->tax?->taux_percent);

            $product->price_sell_total = $totalPrice;

            $product->price_tax = $taxePrice;
        });

        $product->save();

        return redirect(route('commercial:products'))->with('success', 'le produit a été modifier avec succès');
    }

    public function delete(Request $request)
    {
        $request->validate(['productId' => 'required|uuid']);

        $product = Product::whereUuid($request->productId)->firstOrFail();

        $this->authorize('delete', $product);

        if ($product) {
            if ($product->adjustments) {
                $product->adjustments->each->delete();
            }

            $product->delete();

            return redirect(route('commercial:products'))->with('success', 'Le produit a éte supprimer avec succès');
        }

        return redirect(route('commercial:products'))->with('error', 'vous nous pouvez pas supprimer ce produit car il a des commands');
    }
}
