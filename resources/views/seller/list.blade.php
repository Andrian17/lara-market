@extends('components.content')
@section('title', 'Daftar Seller')
@section('main')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        @if (session()->has('message'))
            {!!  session('message') !!}
        @endif
        <div class="bg-secondary text-center rounded p-4">
            <div class="my-2 d-flex justify-content-start">
                <a class="btn btn-outline-info " href="{{ route('seller.create') }}"><i class="bi bi-plus-square me-2"></i>Add Seller</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $seller)
                            <tr>
                                <td>{{ $loop->iteration + $sellers->firstItem() -1 }}</td>
                                <td>{{ $seller->name }}</td>
                                <td>{{ $seller->address }}</td>
                                <td class="d-flex">
                                    <a class="btn btn-sm btn-success me-2" href="/seller/{{ $seller->id }}"><i class="bi bi-ticket-detailed-fill"></i> Detail</a>
                                    <form action="/seller/{{ $seller->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger me-2" onclick="return confirm('Delete seller {{ $seller->name }} ?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                    <a href="/seller/{{ $seller->id }}/edit" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-pencil-square"></i>Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center my-2">
                    {{ $sellers->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
