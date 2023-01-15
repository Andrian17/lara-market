<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Seller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->with('seller')->paginate(20);
        return view('products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sellers = Seller::all();
        return view('products.create', compact('sellers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $validator = $request->validate([
            'seller_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'image_url' => 'required'
        ]);
        $validator['code_product'] = uniqid();
        if ($validator) {
            Product::create($validator);
            return redirect()->route('product.index')
                ->with('message', '<div class="alert alert-info" role="alert">
                                    Product has save
                               </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validator = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image_url' => 'required'
        ]);
        if ($validator) {
            $product->update($validator);
            return redirect()->route('product.index')
                ->with('message', '<div class="alert alert-info" role="alert">
                                        Product has updated
                                   </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('product.index')
                ->with('message', '<div class="alert alert-info" role="alert">
                                        product has deleted
                                    </div>');
        } catch (\Throwable $th) {
            return redirect()->route('product.index')
                ->with('message', '<div class="alert alert-danger" role="alert">
                                        failed to remove the product
                                    </div>');
        }
    }
}
