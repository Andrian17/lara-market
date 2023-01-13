@extends('components.content')
@section('title', 'Detail Product')
@section('main')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4" style="min-height: 550px;">
        <div class="container bg-dark text-center rounded p-4">
            <div class="row d-flex justify-content-center g-4">
                <div class="col-sm-6 col-xl-4">
                    <a href="/product" class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-ui-checks-grid fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Product</p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <a href="/seller" class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-people fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Seller</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
