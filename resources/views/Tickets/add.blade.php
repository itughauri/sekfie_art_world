@extends('Layouts.app')
@section('content')
@section('title', 'Add Ticket - Selfie Art')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card required">
                <div class="card-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <h5 class="card-title">Generate Ticket</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="">
                                <h5>Date: {{ date('Y-m-d') }}</h5>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="d-flex justify-content-end">
                                <h5>Time: {{ date('H-i-s') }}</h5>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ticket.store') }}" id="ticket_submit">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div style="display: none"> {{ $time = date('H') }} </div>
                                    <div class="form-group">
                                        <label for="session">Select Session</label>
                                        <div class="input-group">
                                            <select class="custom-select" style="" id="session" name="session">
                                                <option selected name="">Choose...</option>
                                                @foreach ($sessions as $item)
                                                    @if ($time < 14)
                                                        @if (str_contains($item->name, 'Morning'))
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name . ' -- ' . $item->to . ' To ' . $item->from }}
                                                            </option>
                                                        @endif
                                                    @else
                                                        @if (str_contains($item->name, 'Evening'))
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name . ' -- ' . $item->to . ' To ' . $item->from . ' - ' . $item->created_at }}
                                                            </option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('session')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 no-gutters text-center d-flex align-items-center justify-content-end align-items-center">
                                    <div class="form-group">
                                        <div class="row no-gutters mt-4">
                                            <div class="col-md-9 mt-1">
                                                <h6>Remaining Tickets</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>
                                                    <span class=" ticket-counter alert alert-success" style="display: inline-block" id="remaining_tickets">0</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" id="cnic_label">Find Customer by CNIC or Contact
                                            No.</label>
                                        <input type="text" class="form-control" id="find" name="find"
                                            placeholder="Enter CNIC or Contact" required>
                                        @error('find')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 justify-content-center d-flex align-items-center">
                                    <h3>OR</h3>
                                </div>
                                <div class="col-md-4 d-flex align-items-center" style="text-align: center">
                                    <button type="button" class="btn btn-block btn-primary tickets" data-toggle="modal"
                                        id="buttonforpopup" data-target="#ticketModal">
                                        Add New Customer
                                    </button>
                                </div>
                            </div>
                            <div style="display: none;" class="notfound alert alert-danger">
                                Customer Not Existed
                            </div>
                            <div style="display: none;" class="cnic-error alert alert-danger">
                                CNIC or Contact is Required
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="hidden" class="form-control" id="customer_id" name="customer_id"
                                            placeholder="Customer ID">
                                        <input type="text" class="form-control" id="ticket_name" name="ticket_name"
                                            placeholder="Customer Name">
                                        @error('ticket_name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input type="text" class="form-control" id="customer_age" name="customer_age"
                                            placeholder="Customer Age">
                                        @error('ticket_name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="text" class="form-control" id="customer_contact_number"
                                            name="customer_contact_number" placeholder="Customer Contact Number">
                                        @error('customer_contact_number')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CNIC</label>
                                        <input type="text" class="form-control" id="customer_cnic"
                                            name="customer_cnic" placeholder="Customer CNIC ">
                                        @error('customer_cnic')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="customer_email" name="customer_email"
                                    placeholder="Customer Email">
                                @error('customer_email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group" style="display: none" id="qrAllottedDiv">
                                <h5><span class=" ticket-counter alert alert-danger" id="qrAllotted"></span></h5>
                            </div>
                            <div class="form-group">
                                <label for="no_of_tickets"  class="label_tickets">Number of
                                    tickets</label>
                                <input type="number" class="form-control" name="no_of_tickets"
                                    id="no_of_tickets">
                                <button type="button"  name="ticket_form"
                                    class="btn btn-primary ticket_form mt-2">Confirm</button>
                                <table class="table table-striped ok">
                                </table>
                            </div>
                            <button style="width: 100%" class="btn btn-primary generate">Generate Ticket</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('Tickets.popup.ticket')
    </div>
</div>
@push('datatables')

    <style>
        .ticket-counter {
            padding: 3px 20px;
        }

        .tickets {
            display: inline-block;
        }

        option{
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

    </style>
    <script>
        $(document).ready(function() {
            $('#addNewCustomer').on('click', () => {
                if ($('#customer_name').val() == '' || $('#age').val() == '' || $('#contact_no').val() ==
                    '' || $('#cnic').val() == '') {
                    $(".customer-error").show();
                    $("#exists").hide();
                    return;
                } else {
                    $(".customer-error").hide();
                    $.ajax({
                        url: "{{ route('customer.add.new') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        data: {
                            name:       $('#customer_name').val(),
                            cnic:       $('#cnic').val(),
                            contact_no: $('#contact_no').val(),
                            age:        $('#age').val(),
                            email:      $('#email').val(),
                            gender:     $('#gender').val(),
                            date:       moment().format("YYYY-MM-DD")
                        },
                        success: function(response) {
                            if (response.success === true) {
                                $(".customer-success").show();
                                $("#exists").hide();
                                $(".customer-error").hide();
                                $('#customer_name').val('');
                                $('#cnic').val('');
                                $('#contact_no').val('');
                                $('#age').val('');
                                $('#email').val('');
                                $('#gender').val('');
                            } else if (response.success === false) {
                                $(".customer-success").hide();
                                $("#exists").show();
                                $('#customer_name').val('');
                                $('#cnic').val('');
                                $('#contact_no').val('');
                                $('#age').val('');
                                $('#email').val('');
                                $('#gender').val('');
                                return
                            }
                        }
                    });
                }
            });
            //Enter Key Event to find Customer
            $('#find').keypress(function(e) {
                e.preventDefault();
                var key = e.which;
                if (key == 13) { // the enter key code
                    if ($('#find').val() == '') {
                        $(".cnic-error").show();
                        $(".notfound").hide();
                        return false;
                    }
                    $.ajax({
                        url: "{{ route('customer.find') }}",
                        type: "get",
                        data: {
                            queryData: $('#find').val()
                        },
                        success: function(response) {
                            if (response.failed === true && response.customer ===
                                'not existed') {
                                $(".notfound").show();
                                $(".cnic-error").hide();
                            } else {
                                $(".notfound").hide();
                                $(".cnic-error").hide();
                                const customer = response.customer;
                                $('#ticket_name').val(customer.name);
                                $('#customer_id').val(customer.id);
                                $('#customer_age').val(customer.age);
                                $('#customer_contact_number').val(customer.contact_no);
                                $('#customer_cnic').val(customer.cnic);
                                $('#customer_email').val(customer.email);
                            }
                        }
                    });
                }
            });
            //Fetch remaining tickets
            $('#session').on('change', () => {
                let session_id = $('#session option:selected').val();
                var date = moment().format("YYYY-MM-DD"); //Get the current date
                $.ajax({
                    url: "{{ route('session.tickets') }}",
                    type: "get",
                    data: {
                        date : date,
                        queryData: session_id
                    },
                    success: function(response) {
                        if (response.success === true) {
                            let remaining = 200 - parseFloat(response.sessionTickets)
                            if(remaining < 50){
                                $(".ticket-counter").css('background-color', 'red');
                            }else if(remaining > 50 && remaining < 100){
                                $(".ticket-counter").css('background-color', 'yellow');
                            }else{
                                $(".ticket-counter").css('background-color', 'green');
                            }
                            $('#remaining_tickets').html(remaining);
                        }
                    }
                });
            })
            //Check if QR code is already allotted or not
            $('#qrCode').keypress(function(e) {
                var key = e.which;
                if (key == 13) { // the enter key code
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('qr.find.allotted') }}",
                        type: "get",
                        data: {
                            queryData: $('#qrCode').val()
                        },
                        success: function(response) {
                            if (response.success === false) {
                                $('#qrAllottedDiv').show(300);
                                $('#qrAllotted').html(response.message);
                                $('#qrCode').val('');
                            }
                        }
                    });
                }
            });

            $("#buttonforpopup").on("click", () => {
                $('#ticketModal').appendTo("body");
            })
                    //FOR MULTIPLE INPUTS
            $(".check").click(function() {
                var x = $(this).is(':checked');
                if (x == true) {
                    $(".ticket_form").show();
                    $("#no_of_tickets").show();
                    $(".label_tickets").show();
                } else {
                    $(".ticket_form").hide();
                    $("#no_of_tickets").hide();
                    $("#label_tickets").hide();
                }
            });

            $(".ticket_form").click(function() {
            $(".ok").html('');
                var numbers = $("#no_of_tickets").val();
                console.log(numbers);
                for (i = 0; i < numbers; i++) {
                    $(".ok").append("<tr><td>" + (i + 1) +
                        "</td><td><input class='form-control' type='password' name='multiple_qr[]'></td></tr>"
                    );
                }
            });
        });
    </script>
@endpush
@endsection
