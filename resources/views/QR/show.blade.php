@extends('Layouts.app')
@section('content')
@section('title', 'QR - Selfie Art')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                    @if (session()->has('update'))
                        <div class="alert alert-success">
                            {{ session()->get('update') }}
                        </div>
                    @endif
                    @if (session()->has('delete'))
                        <div class="alert alert-danger">
                            {{ session()->get('delete') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title mt-2">QRs</h4>
                        </div>
                        <div class="col-md-2 offset-md-6">
                            <a href="{{ route('QR') }}" class="btn btn-primary">New QR</a>
                        </div>
                    </div>
                    <hr>
                    <table class="table display responsive" id="qr-show">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Date</th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($qr as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->created_at ? $item->created_at : 'Not Added' }}</td>
                                    <td>
                                        <a href="{{ route('qr.edit', [$item->id]) }}" class="btn btn-primary"><i
                                                class="far fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                            data-id="{{ $item->id }}" data-target="#QrModal"><i
                                                class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('QR.popup.qr_popup')
                </div>
            </div>
        </div>
    </div>
</div>

@push('datatables')
    <script>
        $(document).ready(function() {
            $('#qr-show').DataTable();

            $('#QrModal').appendTo("body");

            $(".delete").click(function() {
                $("#qr_id").val($(this).data("id"));
            });
        });
    </script>
@endpush

@endsection
