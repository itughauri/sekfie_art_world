@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')
<div class="container">
    <div class="card">
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
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
        @if (session()->has('exists'))
        <div class="alert alert-danger">
            {{ session()->get('exists') }}
        </div>
    @endif
            <div class="row">
                <div class="col-md-4">
                    <h4 class="card-title">Lockers</h4>
                </div>
                <div class="col-md-2 offset-md-6">
                    <a href="{{ route('lockers.add.view') }}" class="btn btn-primary s-btn mb-3">New Locker</a>
                </div>
            </div>
            <table class="table display responsive s-s" id="lockers">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">Locker Name</th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lockers as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <a href="{{ route('lockers.edit.view' , [$item->id]) }}" class="btn btn-primary"><i class="far fa-edit"></i></a>
                <button type="button" class="btn btn-danger delete" data-toggle="modal" data-id="{{ $item->id }}" data-target="#LockerModal"><i class="far fa-trash-alt"></i></button>
            </td>
          </tr>
          @endforeach
                </tbody>
            </table>
            @include('locker.popup.product_popup')
        </div>
    </div>
</div>

@push('datatables')
    <style>
        .error {
            color: red;
        }

    </style>

<script>
    $(document).ready(function () {
    $('#lockers').DataTable();

    $('#LockerModal').appendTo("body");

    $(".delete").click(function(){
    $("#locker_id").val($(this).data("id"));
        });
});
</script>
@endpush

@endsection
