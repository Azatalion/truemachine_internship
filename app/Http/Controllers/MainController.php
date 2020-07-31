<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class MainController extends Controller
{
    public function product($categoryCode, $productCode) 
    {
        $product = Product::where('code', $productCode)->first();
        return view ('product', compact('product'));
    }

    public function products(Request $request) 
    {
        $productsQuery = Product::query()->with('category');
        if ($request->filled('categories') && $request->categories != 0) {
            $productsQuery->where('category_id', $request->categories);
        }
        $products = $productsQuery->paginate(6);
        $categories = Category::get();
        return view ('products', compact('products', 'categories'));
    }
}
