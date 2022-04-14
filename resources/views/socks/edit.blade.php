@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">Edit Transaction</h5>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                        <form action="{{ route('sock_transection.update', [$transaction->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Amount</label>
                                <input type="text" value="{{ $transaction->amount }}" class="form-control" id="amount" name="amount" aria-describedby="emailHelp" placeholder="Product" required>
                                @error('amount')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="text" value="{{ $transaction->created_at }}" class="form-control" id="date" name="date" aria-describedby="emailHelp" placeholder="Product" required>
                                @error('date')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
