<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Category;

class ApiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('categories')->get();
        return response()->json(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product($request->only('code', 'name', 'description', 'image'));
        if ($request->file('image') != null) {
            $path = $request->file('image')->store('products');
            $params['image'] = $path;
        }
        $product->save();

        foreach($request->only('category_id') as $category_id) 
            $product->categories()->attach($category_id);

        $products = Product::with('categories')->get();
        return response()->json(compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $product = Product::where('code', $code)->get();
        return response()->json(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $code)
    {
        $product = Product::where('code', $code)->first();
        $params = $request->only('code', 'name', 'description', 'image');
        unset($params['image']);
        if ($request->has('image')) {
            Storage::delete($product->image);
            $path = $request->file('image')->store('products');
            $params['image'] = $path;
        }
        $product->update($params);
        $product->categories()->sync($request->only('category_id')['category_id']);

        $products = Product::with('categories')->get();
        return response()->json(compact('products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $product = Product::where('code', $code)->first();
        $product->categories()->detach();
        $product->delete();

        $products = Product::with('categories')->get();
        return response()->json(compact('products'));
    }
}
