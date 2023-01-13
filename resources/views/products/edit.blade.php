@extends('components.content')
@section('title', 'Daftar Product')
@section('main')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4" style="min-height: 500px;">
        <div class="bg-secondary text-center rounded p-4">
            <form action="/product/{{ $product->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="yourname" placeholder="your name" name="name" value="{{  old('name', $product->name) }}">
                    <label for="yourname">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="your-price" placeholder="price" name="price" value="{{  old('price', $product->price) }}">
                    <label for="your-price">Price</label>
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('image_url') is-invalid @enderror" id="your-image_url" placeholder="image_url" name="image_url" value="{{  old('image_url', $product->image_url) }}">
                    <label for="your-image_url">Image Url</label>
                    @error('image_url')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-info my-3 ">update</button>
            </form>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
