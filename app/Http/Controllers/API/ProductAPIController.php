<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductAPIController extends Controller
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
        $product = Product::create($product);
        return response()->json(
            [
                "status" => 201,
                "message" => "product has been saved",
                "data" => $product
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
        $product = Product::with('seller')->find($id);
        if ($product) {
            return new ProductResource($product);
        }
        return response()->json([
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
        $status = Product::where("id", $id)->update($request->all());
        if ($status) {
            $product = Product::find($id);
            return response()->json([
                "message" => "product has been updated",
                "data" => $product
            ]);
        }
        return response()->json(
            ["message" => "id product not found"],
            404
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                "status" => 200,
                "message" => "Product has been removed"
            ], 200);
        }
        return response()->json([
            "status" => 404,
            "message" => 'failed to delete Product'
        ], 404);
    }

    // search
    public function search($name)
    {
        $product = Product::where('name', 'like', "%" . $name . "%")->get();
        if (count($product) < 1) {
            return response()->json([
                "message" => "product not found!"
            ]);
        }
        return new ProductCollection($product);
    }
}
