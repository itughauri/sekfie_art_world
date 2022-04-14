@extends('Layouts.app')
@section('content')
@section('title', 'Stock - Selfie Art')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Add Socks Stock
                    </h5>
                    <form action="" class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="no_of_socks">Quantity</label>
                                <input type="number" id="no_of_socks" class="form-control" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
