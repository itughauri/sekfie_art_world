@extends('Layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add QR</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('qr.add') }}" id="adduser">
                                @csrf
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        aria-describedby="emailHelp" placeholder="Enter code" required>
                                    @error('code')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
