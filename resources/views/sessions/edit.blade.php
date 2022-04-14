@extends('Layouts.app');
@section('content')
@section('title', 'Edit Session - Selfie Art')
<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Session</h4>
                    <form method="post" action="{{ route('session.update' , [$session->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $session->name }}" aria-describedby="emailHelp"
                                placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">From</label>
                            <input type="time" class="form-control" id="from" name="from" value="{{ $session->from }}"
                                placeholder="Enter From">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">To</label>
                            <input type="time" class="form-control" id="to" name="to"
                                value="{{ $session->to }}" placeholder="enter last name">
                        </div>

                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
