@extends('Layouts.app')
@section('content')
@section('title', 'Edit User - Selfie Art')

<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="title">Edit User</h4>
                    <form method="post" action="{{ url('user/update-user/' . $edit_user->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">First name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ $edit_user->first_name }}" aria-describedby="emailHelp"
                                placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Last name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ $edit_user->last_name }}" placeholder="enter last name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $edit_user->city }}"
                                placeholder="enter city">
                        </div>

                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
