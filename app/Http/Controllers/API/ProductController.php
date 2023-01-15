<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductCollection(Product::with('seller')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "seller_id" => 'required',
            "name" => 'required',
            "price" => 'required|numeric',
            "image_url" => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $product = $request->all();
        $product["code_product"] = uniqid();
        Product::create($product);
        return response(
            [
                "status" => 201,
                "message" => "Product has save"
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->with('seller')->first();
        if ($product) {
            return new ProductResource($product);
        }
        return response([
            "status" => 404,
            "message" => "product not found!"
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "seller_id" => 'required',
            "name" => 'required',
            "price" => 'required|numeric',
            "image_url" => 'required'
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        Product::where("id", $id)->update($request->all());
        return response([
            "message" => "product has updated",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->delete();
            return response([
                "status" => 200,
                "message" => "Product has delete!"
            ], 200);
        }
        return response([
            "status" => 404,
            "message" => 'failed remove the product'
        ], 404);
    }
}
