@extends('Layouts.app')
@section('content')
@section('title', 'Show User - Selfie Art')
<div class="container">
    <div class="row">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-f">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title mt-2">Users</h4>
                        </div>
                        <div class="col-md-2 offset-md-6">
                            <a href="{{  url('/user')  }}" class="btn btn-primary">New User</a>
                        </div>
                    </div>
                    <hr>
                    <table class="table display responsive u-t" id="example">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">City</th>
                            <th>
                                Actions
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->first_name }}</td>
                            <td>{{ $item->last_name }}</td>
                            <td>{{ $item->city }}</td>
                            <td>
                                <a href="{{ url('user/edit-user/'. $item->id) }}" class="btn btn-primary"><i class="far fa-edit"></i></a>
                                <a href="{{ url('user/delete-user/' . $item->id) }}" class="btn btn-danger btn-del"><i class="far fa-trash-alt"></i></a>
                            </td>
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
    <script>
        $(document).ready(function () {
        $('#example').DataTable();
    });
    </script>
    @endpush
@endsection
