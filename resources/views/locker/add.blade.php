@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">Add New Locker</h5>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if (session()->has('exists'))
                    <div class="alert alert-danger">
                        {{ session()->get('exists') }}
                    </div>
                @endif
                        <form action="{{ route('lockers.add') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Locker Name</label>
                                <input type="text" class="form-control" id="locker_name" name="locker_name" aria-describedby="emailHelp" placeholder="Locker Name" required>
                                @error('product_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Add New Locker
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
