<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::latest()->with('products')->paginate(10);
        return view('seller.list', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSellerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSellerRequest $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);
        if ($validator) {
            Seller::create($validator);
            return redirect()->route('seller.index')
                ->with('message', '<div class="alert alert-info" role="alert">
                                        Seller has been saved
                                   </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {

        return view('seller.detail', compact('seller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        // dd($seller);
        return view('seller.edit', compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSellerRequest  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSellerRequest $request, Seller $seller)
    {
        $validator = $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);
        if ($validator) {
            $seller->update($validator);
            return redirect()->route('seller.index')
                ->with('message', '<div class="alert alert-info" role="alert">
                                        Seller has been updated
                                   </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        try {
            DB::beginTransaction();
            $seller->delete();
            if (count($seller->products) > 0) {
                Product::where('seller_id', $seller->id)->delete();
            }
            return redirect()->route('seller.index')
                ->with('message', '<div class="alert alert-info" role="alert">
                                        Seller has been deleted
                                   </div>');
            DB::commit();
        } catch (\Exception $e) {
            // if error happened, rollback transaction
            DB::rollback();
            return redirect()->route('seller.index')
                ->with('message', '<div class="alert alert-danger" role="alert">
                                        failed to remove the seller
                                    </div>');
        }
    }
}
