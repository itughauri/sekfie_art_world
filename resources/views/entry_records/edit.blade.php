@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">Edit Record</h5>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                        <form action="{{ route('entry_record.update', [$record->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Customer Name</label>
                                <input type="text" value="{{ $record->customer->name }}" class="form-control" id="customer_name" name="customer_name" aria-describedby="emailHelp" placeholder="Name" required>
                                @error('customer_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="session">Select Session</label>
                                <div class="input-group">
                                    <select class="custom-select" style="" id="session" name="session">
                                        <option  name="">Choose...</option>
                                        @foreach ($session as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name . ' -- ' . $item->to . ' To ' . $item->from }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('session')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
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
