<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellerCollection;
use App\Http\Resources\SellerResource;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SellerAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SellerCollection(Seller::with('products')->paginate(10));
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
            "name" => 'required',
            "address" => 'required',
        ]);
        if ($validator->fails()) return response()->json($validator->errors(), 400);
        $seller = $request->all();
        Seller::create($seller);
        return response(
            [
                "status" => 201,
                "message" => "seller has save"
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = Seller::with('products')->where('id', $id)->first();
        if ($seller) return new SellerResource($seller);
        return response([
            "message" => "seller not found"
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required',
            "address" => 'required',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        try {
            $status = Seller::where("id", $id)->update($request->all());
            if ($status) {
                return response([
                    "message" => "seller has updated",
                ]);
            }
            return response(
                ["message" => "id seller not found"],
                404
            );
        } catch (\Throwable $th) {
            return response(
                ["message" => "failed update seller"],
                400
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $seller = Seller::where('id', $id)->first();
            if (!$seller) {
                return response([
                    "status" => 404,
                    "message" => 'failed remove the seller'
                ], 404);
            }
            $seller->delete();
            if (count($seller->products) > 0) {
                Product::where('seller_id', $id)->delete();
            }
            DB::commit();
            return response(
                ["message" => "seller has delete"],
                200
            );
            // return false;
        } catch (\Exception $e) {
            // if error happened, rollback transaction
            DB::rollback();
            return response([
                "status" => 404,
                "message" => 'failed remove the seller'
            ], 404);
        }
    }
}
