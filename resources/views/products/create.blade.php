@extends('components.content')
@section('title', 'Daftar Product')
@section('main')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4" style="min-height: 500px;">
        <div class="bg-secondary text-center rounded p-4">
            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="yourname" placeholder="your name" name="name" value="{{  old('name') }}">
                    <label for="yourname">Name Product</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="your-price" placeholder="price" name="price" value="{{  old('price') }}">
                    <label for="your-price">Price</label>
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('image_url') is-invalid @enderror" id="your-image_url" placeholder="image_url" name="image_url" value="{{  old('image_url') }}">
                    <label for="your-image_url">Image Url</label>
                    @error('image_url')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="seller_id">
                      <option selected>Open this select menu</option>
                      @foreach ($sellers as $seller)
                          <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                      @endforeach
                    </select>
                    <label for="floatingSelect">Works with selects</label>
                  </div>
                <button type="submit" class="btn btn-outline-info my-3 ">submit</button>
            </form>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
