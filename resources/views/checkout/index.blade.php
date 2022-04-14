@extends('Layouts.app')
@section('content')
@section('title', 'Checkout - Selfie Art')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">Exit</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-2">
                                @include('scanner')
                            </div>
                        </div>
                        <div style="display: none;" class="qr-error alert alert-danger">
                            Please fill the required field first
                        </div>
                        <div style="display: none;" class="error-show-1 alert alert-danger">
                            This QR code is not assigned to any session yet
                        </div>
                        <div style="display: none; color: rgb(255, 255, 255);" class="error alert alert-danger">
                            QR not available
                        </div>
                        <div class="form-group">
                            <label for="qrID">Scan or Enter QR Code</label>
                            <input type="password" class="form-control" id="qrID" name="qr"
                                aria-describedby="emailHelp" placeholder="*****">
                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div style="display: none;" class="qr-success alert alert-success">
                            Checkout Successfully
                        </div>
                        <div class="d-md-flex  justify-content-center counter">
                            <h4 class="entry-counter-header">Entries:</h4><span style="display: inline-block" class="d-flex align-items-center no_of_entries alert alert-success mr-2 ml-2 text-center"></span>
                            <h4 class="exit-counter-header">Exits:</h4><span style="display: inline-block" class="no_of_exits alert alert-danger ml-1"></span>
                        </div>
                        <div class="d-flex justify-content-end">
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
            $("#qrID").keypress(function(e) {
                var key = e.which;
                $(".anim-box").css("transform", "scale(1.5, 2)");
                $(".scanner").css("animation-play-state", "running")
                if (key === 13) {
                    $(".no_of_entries").html('');
                    $(".no_of_exits").html('');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('exit.entries_counter') }}",
                        type: 'post',
                        data: {
                            qr: $('#qrID').val(),
                        },
                        success: function(response){
                            $(".no_of_entries").html(response);
                        }
                    });

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('exit.exit_counter') }}",
                        type: 'post',
                        data: {
                            qr: $('#qrID').val(),
                        },
                        success: function(response){
                            $(".no_of_exits").html(response);
                        }
                    });

                    if ($("#qrID").val() == '') {
                        $(".qr-error").show();
                        return false;
                    } else {
                        $(".qr-error").hide();
                        $.ajax({
                            url: "{{ route('qr.checkout') }}",
                            type: 'post',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                qr: $('#qrID').val(),
                                date: moment().format("YYYY-MM-DD")
                            },
                            success: function(response) {
                                if (response.success === true) {
                                    $(".error-show-1").hide();
                                    $(".qr-error").hide();
                                    $(".error").hide();
                                    $(".qr-success").show();
                                } else {
                                    $(".qr-error").hide();
                                    $(".qr-success").hide();
                                    $(".error").hide();
                                    $(".error-show-1").show();
                                }
                                if (response === 'hello') {
                                    $(".qr-error").hide();
                                    $(".error-show-1").hide();
                                    $(".error").show();
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>
@endpush
@endsection
