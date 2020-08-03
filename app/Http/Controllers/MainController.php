<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Category;
use App\Product;
use App\Review;

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

        if ($request->categories != 0) {
            $onwerIds = (int)$request->categories;
            $productsQuery = Product::whereHas('categories', function($q) use($onwerIds) {
                $q->whereIn('categories.id', [$onwerIds]);
            })->get();
        }
        else
            $productsQuery = Product::query()->with('categories')->get();

        if ($request->orders == 1) {
            $productsQuery = $productsQuery->sortBy(function($product, $key) {
                return $product->averrageMark();
            });
        }
        else if ($request->orders == 2) {
            $productsQuery = $productsQuery->sortByDesc(function($product, $key) {
                return $product->averrageMark();
            });
        }
        else if ($request->orders == 3) {
            $productsQuery = $productsQuery->sortBy(function($product, $key) {
                return $product->reviewsCount();
            });
        }
        else if ($request->orders == 4) {
            $productsQuery = $productsQuery->sortByDesc(function($product, $key) {
                return $product->reviewsCount();
            });
        }
        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $products = new LengthAwarePaginator($productsQuery->forPage($currentPage, 6), 
            $productsQuery->count(), 
            6, 
            $currentPage,
            ['path' => url('/products?orders='.$request->orders)
        ]);
        
        $categories = Category::get();
        return view ('products', compact('products', 'categories'));
    }
}
