@extends('Layouts.app')
@section('content')
@section('title', 'Checkout - Selfie Art')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
            <div class="card-body">
                <h5 class="card-title">Free Lockers</h5>
                <div class="card-body">
                    @include('scanner')
                    <div style="display: none;" class="qr-error alert alert-danger">
                        Please fill the required field first
                    </div>
                    <div style="display: none; color:aliceblue;" class="error alert alert-danger">
                        This QR code is not assigned to any session yet
                    </div>
                    @if (session()->has('enter'))
                        <div class="alert alert-success">
                            {{ session()->get('enter') }}
                        </div>
                    @endif
                        <div class="form-group">
                            <label for="qrID">Scan or Enter QR Code</label>
                            <input type="password" class="form-control" id="qrID" name="qrID" aria-describedby="emailHelp" placeholder="*****">
                            @error('name')
                              <span class="error">{{ $message }}</span>
                            @enderror
                          </div>
                        <div style="display: none;" class="success alert alert-success">
                            Locker free Successfully
                        </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@push('datatables')
    <script>
        $(document).ready(function(){

            $('#qrID').keypress(function(e) {
                var key = e.which;
                //scanner animation
                $(".anim-box").css("transform","scale(1.5, 2)");
                $(".scanner").css("animation-play-state","running")
                if (key == 13) { // the enter key code
                    e.preventDefault();
                    if ($('#qrID').val() == '') {
                        $(".qr-error").show();
                        $(".error").hide();
                        return false;
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('lockers.free') }}",
                        type: "get",
                        data: {
                            qrID: $('#qrID').val()
                        },
                        success: function(response) {
                            console.log(response);
                            if(response.success == true){
                                $(".success").html(response.message).show();
                                $(".error").hide();
                            }else if (response.success  === false){
                                $(".error").html(response.message).show();
                                $(".success").hide();
                                $(".qr-error").hide();
                                // $(".qr-success")
                                // $("#customer_name").val(response[0].customer);
                                // $("#customer_session").val(response[0].name);
                            }
                            // if(response === 'empty'){
                            //     $(".qr-error").show();
                            // }
                            }
                    });
                }
            });
        });
    </script>
@endpush
@endsection

