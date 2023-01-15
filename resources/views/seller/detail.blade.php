@extends('components.content')
@section('title', 'Detail Seller')
@section('main')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        @if (session()->has('message'))
            {!!  session('message') !!}
        @endif
        @if ($errors->any())
            <div class="alert alert-danger mt-3 p-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="bg-secondary text-center rounded p-1">
            <div class="card bg-dark">
                <div class="card-header">
                  Seller
                </div>
                <div class="card-body">
                  <h5 class="card-title">{{ $seller->name }}</h5>
                  <p class="card-text">{{ $seller->address }}</p>
                  <div class="list-products container">
                    @if (count($seller->products) > 0)
                        <p>List Prodcut By {{ $seller->name }}</p>
                        <div class="row mx-auto">
                            @foreach ($seller->products as $product)
                            <div class="col-md-4 p-2 my-2">
                                <div class="card">
                                    <a href="/product/{{ $product->id }}">
                                        <img src="{{ $product->image_url }}" class="card-img-top" alt="product-{{ $product->name }}">
                                    </a>
                                    <div class="card-body">
                                        <p class="card-text">code product : {{ $product->code_product }}</p>
                                        <p class="card-text">{{ $product->name }}</p>
                                        <p class="card-text">@currency($product->price)</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-bold text-warning">Tidak ada produk untuk ditampilkan</p>
                    @endif

                  </div>
                </div>
              </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
