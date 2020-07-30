<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function product($category_code, $product_code) {
        $product = Product::where('code', $product_code)->first();
        return view ('product', compact('product'));
    }

    public function categories() {
        $categories = Category::get();
        return view ('categories', compact('categories'));
    }

    public function category($code) {
        $category = Category::where('code', $code)->first();
        $category->setRelation('products', $category->products()->paginate(6));
        return view ('category', compact('category'));
    }

    public function products(Request $request) {
        $productsQuery = Product::query();
        if ($request->route()->named('products')) 
        {
            if ($request->filled('categories') && $request->categories != 0) {
                $productsQuery->where('category_id', $request->categories);
            }
            $products = $productsQuery->paginate(6);
            $categories = Category::get();
            return view ('products', compact('products', 'categories'));
        }
        else {
            $products = Product::get();
            return response()->json(compact('products'),200);
        }
    }
}
