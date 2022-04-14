@extends('Layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title">Edit QR</h4>
                <form method="post" action="{{ url('/QR/update/' . $qr->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Code</label>
                        <input type="text" class="form-control" id="code" name="code"
                            value="{{ $qr->code }}" aria-describedby="emailHelp"
                            placeholder="Enter first name">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
