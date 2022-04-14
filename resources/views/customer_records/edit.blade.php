@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">Edit Record</h5>
                    <div class="card-body">
                        <form action="{{ route('record.update', [$customer->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" value="{{ $customer->name }}"
                                    name="customer_name" aria-describedby="emailHelp" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact Number</label>
                                <input type="text" class="form-control" id="contact_no" value="{{ $customer->contact_no }}"
                                    name="contact_no" aria-describedby="emailHelp" placeholder="Contact Number" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Customer CNIC</label>
                                <input type="text" class="form-control" id="customer_cnic"
                                    value="{{ $customer->cnic }}" name="customer_cnic" aria-describedby="emailHelp"
                                    placeholder="CNIC" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Record</button>
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
