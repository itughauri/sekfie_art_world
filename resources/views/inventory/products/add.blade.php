@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">Add New Product</h5>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                        <form action="{{ route('add_product') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" aria-describedby="emailHelp" placeholder="Product" required>
                                @error('product_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add New Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
