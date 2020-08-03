<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Product;
use App\Review;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function product_review($code) 
    {
        $product = Product::where('code', $code)->first();
        return view ('product_review', compact('product'));
    }

    public function add_review($code, ReviewRequest $request) 
    {
        $params = ['text' => $request->only('text')['text'],
            'mark' => $request->only('mark')['mark'],
            'product_id' => Product::where('code', $code)->first()->id,
            'user_name' => Auth::user()->name,
        ];
        Review::create($params);
        return redirect()->route('product', Product::where('code', $code)->first()->code);
    }
}
