@extends('Layouts.app')
@section('content')
@section('title', 'Checkout - Selfie Art')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">Entry</h5>
                    <div class="card-body">
                        @include('scanner')
                        <div style="display: none;" class="qr-error alert alert-danger">
                            Please fill the required field first
                        </div>
                        <div style="display: none; color:aliceblue;" class="error alert alert-danger">
                            This QR code is not assigned to any session yet
                        </div>
                        @if (session()->has('enter'))
                            <div class="alert alert-success mt-2">
                                {{ session()->get('enter') }}
                            </div>
                        @endif
                        @if (session()->has('entry_error'))
                        <div class="alert alert-danger mt-2">
                            {{ session()->get('entry_error') }}
                        </div>
                    @endif
                        <form action="{{ route('entry.add') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" value="{{ date('Y-m-d') }}" name="date" id="date">
                                <label for="qrID">Scan or Enter QR Code</label>
                                <input type="password" class="form-control" id="qrID" name="qrID"
                                    aria-describedby="emailHelp" placeholder="*****" required>
                                @error('name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mb-2 ">Enter</button>
                            <div class="data" style="display: none">
                                <label  for="">
                                    <h4>Name:</h4>
                                </label>
                                <h6 class="name">

                                </h6>
                                <label  for="">
                                    <h4>Session:</h4>
                                </label>
                                <h6 class="session">

                                </h6>
                            </div>
                        </form>
                        <div style="display: none;" class="qr-success alert alert-success">
                            Enter Successfully
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('datatables')
    <script>
        $(document).ready(function() {

            $('#qrID').keypress(function(e) {
                var key = e.which;
                //scanner animation
                $(".anim-box").css("transform", "scale(1.5, 2)");
                $(".scanner").css("animation-play-state", "running")
                if (key == 13) { // the enter key code
                    e.preventDefault();
                    if ($('#qrID').val() == '') {
                        $(".qr-error").show();
                        $(".error").hide();
                        return false;
                    }
                    $.ajax({
                        url: "{{ route('entry.show') }}",
                        type: "get",
                        data: {
                            qrID: $('#qrID').val(),
                        },
                        success: function(response) {
                            if (response.length === 0) {
                                $(".error").show();
                                $(".qr-error").hide();
                            } else {
                                $(".data").show();
                                $(".qr-error").hide();
                                $(".error").hide();
                                $(".qr-error").hide();
                                $(".qr-success")
                                $(".name").html(response[0].customer).show();
                                $(".session").html(response[0].name).show();
                            }
                            // if(response.success === false){
                            //     alert(response.message);
                            // }
                        }
                    });
                }
            });
        });
    </script>
@endpush
@endsection
