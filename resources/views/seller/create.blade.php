@extends('components.content')
@section('title', 'Daftar Seller')
@section('main')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4" style="min-height: 500px;">
        <div class="bg-secondary text-center rounded p-4">
            <form action="{{ route('seller.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="yourname" placeholder="your name" name="name" value="{{  old('name') }}">
                    <label for="yourname">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="your-address" placeholder="your address" name="address" value="{{  old('address') }}">
                    <label for="your-address">Address</label>
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-info my-3 ">submit</button>
            </form>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
