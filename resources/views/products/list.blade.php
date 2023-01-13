@extends('components.content')
@section('title', 'Daftar product')
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
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Salse</h6>
                <a href="">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">Code Product</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration + $products->firstItem() -1 }}</td>
                                <td>{{ $product->code_product }}</td>
                                <td>{{ $product->name }}</td>
                                <td>@currency($product->price)</td>
                                <td >
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="max-width: 8rem;">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-sm btn-success me-2" href="/product/{{ $product->id }}"><i class="bi bi-ticket-detailed-fill"></i> Detail</a>
                                        <form action="/product/{{ $product->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="confirm('Delete product {{ $product->name }} ?')"><i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center my-2">
                    {{ $products->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
