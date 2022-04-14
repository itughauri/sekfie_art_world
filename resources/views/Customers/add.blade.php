@extends('Layouts.app')
@section('content')
@section('title', 'Add Customer - Selfie Art')
{{-- <link rel = "shortcut icon" style="border-radius: 50%;" href ="{{ asset('assets/img/selfie.jpeg') }}" type = "image/png"> --}}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
            <div class="card-body">
                <h5 class="card-title">Add Customer</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('customer.update') }}" id="addTicket">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter Name">
                          @error('name')
                            <span class="error">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact Number">
                            @error('cnic')
                            <span class="error">{{ $message }}</span>
                          @enderror
                          </div>
                        <div class="form-group">
                          <label>CNIC</label>
                          <input type="text" class="form-control" id="cnic" name="cnic" placeholder="CNIC">
                          @error('gender')
                            <span class="error">{{ $message }}</span>
                          @enderror
                        </div>

                          <div class="form-group">
                            <label>Age</label>
                            <input type="text" class="form-control" id="age" name="age" placeholder="Age">
                            @error('contact_no')
                            <span class="error">{{ $message }}</span>
                          @enderror
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            @error('age')
                                <span class="error">{{ $message }}</span>
                            @enderror
                          </div>


                          {{-- <div class="form-group">
                            <label>No. of tickets</label>
                            <input type="text" class="form-control" id="no_of_tickets" name="no_of_tickets" placeholder="No. of Tickets">
                            @error('no_of_tickets')
                                <span class="error">{{ $message }}</span>
                            @enderror
                          </div> --}}

                          <div class="form-group">
                            <label for="session">Session</label>
                          <div class="input-group">
                              <select class="custom-select" id="session" name="session">
                                  <option selected name="">Choose...</option>
                                  @foreach ($session as $item)
                                <option value="{{ $item->id }}" name="session">{{ $item->to . ' To ' . $item->from }}</option>
                                @endforeach
                              </select>
                              @error('session')
                          <span class="error">{{ $message }}</span>
                        @enderror
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="gender">Gender</label>
                        <div class="input-group">
                            <select class="custom-select" id="gender" name="gender">
                                <option selected name="" disabled>Choose...</option>
                                <option value="0">Male</option>
                                <option value="-1">Female</option>
                                {{-- @foreach ($session as $item)
                              <option value="{{ $item->id }}" name="session">{{ $item->to . ' To ' . $item->from }}</option>
                              @endforeach --}}
                            </select>
                          </div>
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
