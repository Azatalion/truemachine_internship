<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Review;
use App\Product;

use Closure;

class HasReview
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $product = Product::where('code', $request->product)->first();
        if ($product->reviews->contains('user_name', Auth::user()->name)) {
            return redirect()->route('product', $request->product);
        }
        return $next($request);
    }
}
