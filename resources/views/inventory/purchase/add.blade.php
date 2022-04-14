@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">New Purchase</h5>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <form action="{{ route('add_purchase') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="product_name">Product</label>
                                <div class="input-group">
                                    <select class="custom-select" id="product_name" name="product_name" required>
                                        <option selected name="" selected disabled>Choose...</option>
                                        @foreach ($products as $product )

                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                                @error('product_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Price"
                                    required>
                                @error('price')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number" class="form-control" id="qty" name="qty" placeholder="Qty"
                                    required>
                                @error('qty')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="vendor">Vendor</label>
                                <div class="input-group">
                                    <select class="custom-select" id="vendor" name="vendor" required>
                                        <option selected name="" selected disabled>Choose...</option>
                                        @foreach ($vendors as $vendor )

                                        <option value="{{ $vendor->id }}">{{ $vendor->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                @error('vendor')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add To Stock</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('datatables')
    <style>
        .error {
            color: red;
        }

    </style>
@endpush

@endsection
