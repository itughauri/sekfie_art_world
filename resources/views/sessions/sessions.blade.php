@extends('Layouts.app')
@section('content')
@section('title', 'Sessions - Selfie Art')
<div class="container">
    <div class="row">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 s-t">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if (session()->has('delete'))
                        <div class="alert alert-danger">
                            {{ session()->get('delete') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title mt-2">Sessions</h4>
                        </div>
                        <div class="col-md-2 offset-md-6">
                            <a href="{{ route('session') }}" class="btn btn-primary s-btn">New Session</a>
                        </div>
                    </div>
                    <table class="table display responsive s-s" id="session">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Start time</th>
                                <th scope="col">End Time</th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($session as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->to }}</td>
                                    <td>{{ $item->from }}</td>
                                    <td>
                                        <a href="{{ route('session.edit', [$item->id]) }}" class="btn btn-primary"><i class="far fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger delete" data-toggle="modal" data-id="{{ $item->id }}" data-target="#SessionModal"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('sessions.popup.session')
                </div>
            </div>
        </div>
    </div>
</div>
@push('datatables')
    <script>
        $(document).ready(function() {
            $('#session').DataTable();
            $('#SessionModal').appendTo("body");
            $(".delete").click(function(){
            $("#session_id").val($(this).data("id"));
            });
        });
    </script>
@endpush
@endsection
