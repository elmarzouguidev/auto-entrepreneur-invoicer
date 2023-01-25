<?php

declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\CategoryFormRequest;
use App\Models\Catalog\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('theme.pages.Catalog.Category.index', compact('categories'));
    }

    public function store(CategoryFormRequest $request)
    {
        $category = new Category();

        $category->name = $request->name;

        $category->save();

        if ($request->hasFile('photo')) {
            $category->addMediaFromRequest('photo')->toMediaCollection('categories_logos');
        }

        return redirect(route('commercial:categories'))->with('success', 'la catégorie a été ajouté avec succès');
    }

    public function delete(Request $request)
    {
        $request->validate(['categoryId' => 'required|uuid']);

        $category = Category::whereUuid($request->categoryId)->firstOrFail();

        $this->authorize('delete', $category);

        if ($category) {
            $category->products->each->update(['category_id' => null]);

            $category->delete();

            return redirect(route('commercial:categories'))->with('success', 'la catégorie a éte supprimer avec succès');
        }

        return redirect(route('commercial:categories'))->with('error', 'vous nous pouvez pas supprimer cette catégorie car il a des produis');
    }
}
