@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">Stock</h5>
                    <div class="card-body">
                        <table class="table display responsive s-s" id="stock">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Qty</th>

                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($stocks as $i => $stock)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $stock->product_name }}</td>
                                <td>{{ $stock->qty }}</td>

                              </tr>
                            @endforeach

                            </tbody>
                          </table>
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

    <script>
        $(document).ready(function () {
        $('#stock').DataTable();
    });
    </script>
@endpush

@endsection
