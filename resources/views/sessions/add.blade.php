@extends('Layouts.app')
@section('content')
@section('title', 'Add Session - Selfie Art')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
            <div class="card-body">
                <h5 class="card-title">Create Session</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('session.add') }}" id="adduser">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter Name"required>
                          @error('name')
                            <span class="error">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label>Start Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" value="12:00" required>
                            @error('end_time')
                              <span class="error">{{ $message }}</span>
                            @enderror
                          </div>
                        <div class="form-group">
                            <label>End Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" value="12:00" required>
                            @error('start_time')
                            <span class="error">{{ $message }}</span>
                          @enderror
                          </div>

                        <button class="btn btn-primary" style="width: 100%">Add New Session</button>
                      </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
