@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">

                    </h5>
                    <div class="card-body">
                       <div class="mb-3">
                        @include('scanner')
                       </div>
                        <div style="display: none" class="sock-error-2 alert alert-danger">
                            All fields are required
                        </div>
                        <div style="display: none" class="invalid-qr alert alert-danger">
                            Invalid QR
                        </div>
                        <div style="display: none" class="assign-error alert alert-danger">
                            This QR code is not assigned to any session yet
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Scan or Enter QR Code</label>
                            <input type="password" class="form-control" id="qrID" name="qr"
                                aria-describedby="emailHelp" placeholder="*****">
                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div style="display: none;" class="qr-success alert alert-success">
                            Locker given successfully
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('socks.popup.payment')
</div>
@push('datatables')
    <script>
        $(document).ready(function() {
                        // AUTO FETCH PRICE
            fetchPrice();
            function fetchPrice(){
                $.ajax({
                    url : 'http://localhost/selfi-world-main/public/api/socks/price',
                    type : 'get',
                    success : function(response){
                        $('#amount').val(response);
                    }
                });
            };
            $("#qrID").keypress(function(e) {
                var key = e.which;
                //scanner animation
                $(".anim-box").css("transform","scale(1.5, 2)");
                $(".scanner").css("animation-play-state","running")
                if (key === 13) {
                    if ($("#qrID").val() == '') {
                        $(".sock-error-2").show();
                        $(".invalid-qr").hide();
                        return false;
                    } else {
                        $(".sock-error-2").hide();
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('socks.get') }}",
                            type: 'post',
                            data: {
                                qr: $('#qrID').val(),
                            },
                            success: function(response) {
                                if (response.success === true  && response.message === 'Lockers given successfully') {
                                    $(".assign-error").hide();
                                    $(".error-2").hide();
                                    $(".invalid-qr").hide();
                                    $(".sock-error").hide();
                                    $(".sock-error-2").hide();
                                    $(".qr-success").show();
                                } else if(response.success === false && response.message == 'Invalid QR' ) {
                                    $(".invalid-qr").show();
                                    $(".assign-error").hide();
                                }else if(response.success === false && response.message == 'This QR code is not assigned to any session yet'){
                                    $("#SockModal").modal().show();
                                    $('#SockModal').appendTo("body").modal('hide');
                                    $('#qrValue').val($('#qrID').val())
                                    $(".invalid-qr").hide();
                                }
                                else if(response === 'hello'){
                                    $(".invalid-qr").hide();
                                    $(".assign-error").show();
                                }
                                else{
                                    $(".invalid-qr").hide();
                                    $(".invalid-qr").show();
                                    $(".sock-error-2").hide();
                                    $(".qr-success").hide();
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
