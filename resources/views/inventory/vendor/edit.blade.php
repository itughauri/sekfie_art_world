@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">Edit Vendor</h5>
                    <div class="card-body">
                        <form action="{{ route('update_vendor', [$vendor->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vendor Name</label>
                                <input type="text" class="form-control" id="vendor_name" value="{{ $vendor->name }}" name="vendor_name"  aria-describedby="emailHelp" placeholder="Vendor" required>
                                @error('vendor_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vendor CNIC</label>
                                <input type="text" class="form-control" id="vendor_cnic"  value="{{ $vendor->cnic }}" name="vendor_cnic" aria-describedby="emailHelp" placeholder="Vendor CNIC" required>
                                @error('vendor_cnic')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vendor Contact</label>
                                <input type="text" class="form-control" id="vendor_contact" value="{{ $vendor->contact }}" name="vendor_contact" aria-describedby="emailHelp" placeholder="Vendor Contact" required>
                                @error('vendor_contact')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Vendor</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('datatables')
    <style>

    .error{
        color: red;
    }

    </style>
@endpush

@endsection
