@extends('Layouts.app');
@section('content')
@section('title', 'User - Selfie Art')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="">
            <div class="card required">
            <div class="card-body">
                <h5 class="card-title">Add User</h5>
                <div class="card-body">

                    <form method="POST" action="{{ url('user/add') }}" id="adduser">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">First Name</label>
                          <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby="emailHelp" placeholder="Enter first name" required>
                          @error('first_name')
                            <span class="error">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Last Name</label>
                          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required>
                          @error('last_name')
                            <span class="error">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                            @error('city')
                            <span class="error">{{ $message }}</span>
                          @enderror
                          </div>
                        <button class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection





