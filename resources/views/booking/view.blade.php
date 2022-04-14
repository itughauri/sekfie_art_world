@extends('Layouts.app')
@section('content')
@section('title', 'Sessions - Selfie Art')
<div class="container">
    <div class="row">
        <div class=" col-md-12 s-t">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('sold'))
                        <div class="alert alert-success">
                            {{ session()->get('sold') }}
                        </div>
                    @endif

                    @if (session()->has('allotted'))
                        <div class="alert alert-danger">
                            {{ session()->get('allotted') }}
                        </div>
                    @endif

                    @if (session()->has('notexisted'))
                        <div class="alert alert-danger">
                            {{ session()->get('notexisted') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title mt-2">Bookings</h4>
                        </div>
                        <div class="col-md-8 d-flex justify-content-end">
                            <a href="{{ route('booking_record.report') }}" class="btn btn-primary d-flex align-items-center text-center">Generate Report</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>Filter by Data</label><br>
                            <input type="date" class="form-control" id="filterDate" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Select Session</label>
                            <select class="custom-select" id="filterSession">
                                <option selected disabled>Select from the following</option>
                                @foreach ($session as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Action</label><br>
                            <button type="submit" class="btn btn-danger" id="delBtn">Delete All Bookings</button>
                            <button type="button" class="btn btn-primary" id="filterBtn">Filter</button>
                            <button type="button" class="btn btn-info" id="resetBtn"
                                onclick="window.location.reload()">Reset</button>
                        </div>
                    </div>
                    <div class="error alert alert-danger" style="display: none; color: white;"></div>
                    <div class="alert alert-success success" id="del-req" style="display: none"></div>
                    <table class="table display responsive s-s" id="booking_records">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Contact No.</th>
                                <th>CNIC</th>
                                <th>Total No. of Tickets</th>
                                <th>Session</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="booking-body">
                            @foreach ($records as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->contact_no }}
                                    <td>{{ $item->cnic }}
                                    <td>{{ $item->customer_id }}
                                    <td>{{ $item->session }}
                                    <td>{{ $item->date }}
                                    <td>{{ $item->status }}
                                        @php
                                            $currentTime    = strtotime(now());
                                            $sessionEndTime = strtotime($item->from);
                                            $time           = $sessionEndTime - $currentTime;
                                        @endphp
                                    <td class="">
                                        <button type="button" class="btn btn-primary view" data-toggle="modal"
                                            data-id="{{ $item->id }}" data-session="{{ $item->session_id }}" data-date="{{  $item->date }}" data-customers="{{ $item->customers_id }}"
                                            data-target="#BookModal"><i class="fas fa-check-circle"></i></button>
                                       @if( $time <= 2700 )
                                            <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                            data-id="{{ $item->customers_id }}" data-target="#DelModal"><i
                                                class="far fa-trash-alt"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (session()->has('delete'))
                        <div class="alert alert-danger">
                            {{ session()->get('delete') }}
                        </div>
                    @endif
                    @include('booking.popup.booking_popup')
                    @include('booking.popup.booking_popup_del')
                </div>
            </div>
        </div>
    </div>
</div>
@push('datatables')
    <script>
        $(document).ready(function() {

            // alert($("#time").val() - $("#second_time").val());

            $('#DelModal').appendTo("body");

            $(".delete").click(function() {
                $("#customer_id").val($(this).data("id"));
            });

            $('#booking_records').DataTable();
            $(document).on('click', '.view', function() {
                $('#BookModal').appendTo("body");
                $("#id").val($(this).data('id'));

                let date = $(this).data('date');
                let session = $(this).data('session');
                let customer_id = $(this).data("customers");

                $("#customers_id").val($(this).data('customers'));
                $(".view-table").html('');
                $(".assign-box").html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('booking.no_of_tickets') }}",
                    type: 'post',
                    data: {
                        customer_id: customer_id,
                        date : date,
                        session : session
                    },
                    success: function(response) {
                        response.forEach(arr => {
                            $(".assign-box").append(`
                                <input type="hidden" name="session_tickets[]" value="${arr.id}">
                                <input type='text' class='form-control mt-2' id='qr_code' name='qr_code[]' placeholder='QR Code' required>`
                            );
                        })
                    }
                });
            });
            $(document).on('click', '#assign', function() {
                if ($("#qr_code").val() == '') {
                    $(".error-1").show();
                    $("#error").hide();
                    $("#error-1").hide();
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('booking.view') }}",
                        type: 'post',
                        data: {
                            customers_id: $("#customers_id").val(),
                            id: $("#id").val(),
                            qr_id: $("#qr_code").val(),
                        },
                        success: function(response) {
                            if (response === 'success') {
                                $("#error").hide();
                                $("#qr_code").val('');
                                $(".error-1").hide();
                                $("#error-1").hide();
                                $("#success").show();
                                $(".exists").hide();
                            } else if (response === 'exists') {
                                $(".exists").show();
                                $(".error-1").hide();
                                $("#error-1").hide();
                                $("#success").hide();
                                $("#error").hide();
                            } else {
                                $(".error-1").hide();
                                $("#error-1").hide();
                                $("#success").hide();
                                $(".exists").hide();
                                $("#error").show();
                            }
                        }
                    });
                }
            });

            $("#delBtn").on('click', () => {
                const date = $("#filterDate").val();
                const session = $("#filterSession").val();
                if (date === '' || session === '') {
                    $("#del_sessions").show();
                    $("#booking-body").show();
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('booking.delete_all_sessions') }}",
                        type: 'post',
                        data: {
                            date: date,
                            session: session
                        },
                        success: function(response) {
                            if (response.success === true) {
                                $(".error").html(response.message).hide();
                                $(".success").html(response.message).show();
                                $("#booking-body").hide();
                            } else {
                                $("#booking-body").show();
                                $(".error").html(response.message).show();
                                $(".success").html(response.message).hide();
                            }
                        }
                    });
                }
            });

            $('#filterBtn').on('click', () => {
                const date = $('#filterDate').val();
                $('#booking-body').html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('booking.orderby.date') }}",
                    data: {
                        date: date
                    },
                    type: 'get',
                    success: function(response) {
                        for ($i = 0; $i < response.length; $i++) {
                            f
                            $("#booking-body").append("<tr><td>" + (response.length) +
                                "</td><td>" +
                                response[$i].name + "</td><td>" + response[$i].contact_no +
                                "</td><td>" + response[$i].cnic + "</td><td>" + response[
                                    $i].customer_id + "</td><td>" + response[$i].session +
                                "</td><td>" + response[$i].status + "</td><td>" + response[
                                    $i].date +
                                "</td><td> <button type='button' class='btn btn-primary view' data-toggle='modal' data-id='{{ $item->id }}' data-customers='{{ $item->customers_id }}' data-target='#BookModal'><i class='fas fa-check-circle'></i></button><button type='button' class='btn btn-danger delete' data-toggle='modal' data-id='{{ $item->customers_id }}' data-target='#DelModal' ><i class='far fa-trash-alt'></i></button></td></tr>"
                            )
                        }
                    }
                });
            })

            $('#filterBtn').on('click', () => {
                const session = $('#filterSession').val();
                $('#booking-body').html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('booking.orderby.session') }}",
                    data: {
                        session: session
                    },
                    type: 'get',
                    success: function(response) {
                        for ($i = 0; $i < response.length; $i++) {
                            $("#booking-body").append("<tr><td>" + (response.length) +
                                "</td><td>" +
                                response[$i].name + "</td><td>" + response[$i].contact_no +
                                "</td><td>" + response[$i].cnic + "</td><td>" + response[
                                    $i].customer_id + "</td><td>" + response[$i].session +
                                "</td><td>" + response[$i].status + "</td><td>" + response[
                                    $i].date +
                                "</td><td> <button type='button' class='btn btn-primary view' data-toggle='modal' data-id='{{ $item->id }}' data-customers='{{ $item->customers_id }}' data-target='#BookModal'><i class='fas fa-check-circle'></i></button><button type='button' class='btn btn-danger delete' data-toggle='modal' data-id='{{ $item->customers_id }}' data-target='#DelModal' ><i class='far fa-trash-alt'></i></button></td></tr>"
                            )
                        }
                    }
                });
            })
        });
    </script>
@endpush
@endsection
