@extends('components.content')
@section('title', 'Detail Product')
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
                  Product
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="max-width: 22rem;">
                    </div>
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->code_product }}</p>
                    <p class="card-text">@currency($product->price)</p>
                  <div class="list-products container">
                    <p>List Prodcut By <a href="/seller/{{ $product->seller->id }}">{{ $product->seller->name }}</a></p>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
