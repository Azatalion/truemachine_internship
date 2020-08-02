<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class MainController extends Controller
{
    public function product($code) 
    {
        $product = Product::where('code', $code)->first();
        return view ('product', compact('product'));
    }

    public function products(Request $request) 
    {
        $productsQuery;
        if ($request->filled('categories') && $request->categories != 0) {
            $onwerIds = (int)$request->categories;
            $productsQuery = Product::whereHas('categories', function($q) use($onwerIds) {
                $q->whereIn('categories.id', [$onwerIds]);
            });
        }
        else
            $productsQuery = Product::query()->with('categories');
        $products = $productsQuery->paginate(6);
        $categories = Category::get();
        return view ('products', compact('products', 'categories'));
    }
}
