@extends('Layouts.app')
@section('content')
@section('title', 'Sock - Selfie Art')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    <h5 class="card-title">
                        Assign locker
                    </h5>
                    <div class="card-body">
                       <div class="mb-3">
                        @include('scanner')
                       </div>
                        <div style="display: none" class="empty alert alert-danger">
                            All fields are required
                        </div>
                        <div style="display: none" class="invalid-locker alert alert-danger">

                        </div>
                        <div style="display: none" class="already-allotted alert alert-danger">

                        </div>
                        <div style="display: none" class="allotted alert alert-danger">

                        </div>
                        <div class="form-group">
                            <label for="session">Select Locker</label>
                            <div class="input-group">
                                <select class="custom-select" id="locker_id" name="locker_id">
                                    <option selected disabled>Choose...</option>
                                    @foreach ($lockers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                                @error('locker_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Scan QR Code</label>
                            <input type="password" class="form-control" id="qr_id" name="qr_id"
                                placeholder="*****">
                            @error('qr_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div style="display: none;" class="locker-success alert alert-success">
                            Locker assigned successfully
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

            $("#qr_id").keypress(function(e) {
                var key = e.which;
                //scanner animation
                $(".anim-box").css("transform","scale(1.5, 2)");
                $(".scanner").css("animation-play-state","running")
                if (key === 13) {
                    if ($("#qr_id").val() == ''  &&  $("#locker_id").val()  ==  '') {
                        $(".empty").show();
                        $(".invalid-locker").hide();
                        return false;
                    } else {
                        $(".empty").hide();
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('lockers.assign') }}",
                            type: 'post',
                            data: {
                                qr: $('#qr_id').val(),
                                locker_id: $('#locker_id option:selected').val(),
                            },
                            success: function(response) {
                                // console.log(response);
                                if(response.success === false && response.message === 'QR not existed'){
                                    $(".invalid-locker").html(response.message).show();
                                    $(".already-allotted").html(response.message).hide();
                                    $(".locker-success").html(response.message).hide();
                                    $(".allotted").html(response.message).hide();
                                }else if(response.success === false && response.message === 'QR not assigned to any session yet'){
                                    $(".already-allotted").html(response.message).show();
                                    $(".invalid-locker").html(response.message).hide();
                                    $(".locker-success").html(response.message).hide();
                                    $(".allotted").html(response.message).hide();
                                }else if(response.success === true && response.message === 'Locker assigned successfully'){
                                    $(".locker-success").html(response.message).show();
                                    $(".invalid-locker").html(response.message).hide();
                                    $(".already-allotted").html(response.message).hide();
                                    $(".allotted").html(response.message).hide();
                                }else{
                                if(response.success === false && response.message === 'Locker is already assigned'){
                                    $(".allotted").html(response.message).show();
                                }
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
