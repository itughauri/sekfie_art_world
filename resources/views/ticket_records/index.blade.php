@extends('Layouts.app')
@section('content')
@section('title', 'Sessions - Selfie Art')
<div class="container">
    <div class="row">
        <div class=" col-md-12 s-t">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('update'))
                        <div class="alert alert-success">
                            {{ session()->get('update') }}
                        </div>
                    @endif
                    @if (session()->has('delete'))
                        <div class="alert alert-danger">
                            {{ session()->get('delete') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title mt-2">Tickets Record</h4>
                        </div>
                        <div class="col-md-8 d-flex justify-content-end">
                            <a href="{{ route('ticket_record.report') }}"
                                class="btn btn-primary d-flex align-items-center text-center">Generate Report</a>
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
                            <button type="button" class="btn btn-primary" id="filterBtn">Filter</button>
                            <button type="button" class="btn btn-danger" id="resetBtn"
                                onclick="window.location.reload()">Reset</button>
                        </div>
                    </div>
                    <table class="table display responsive s-s" id="ticket_records">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ticket No.</th>
                                <th scope="col">Session</th>
                                <th scope="col">QR</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            @foreach ($tickets as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ isset($item->session['name']) ? $item->session['name'] : 'Not Added' }}
                                    </td>
                                    <td>{{ isset($item->qr->id) ? $item->qr->id : 'Not Added' }}</td>
                                    <td>{{ isset($item->customer->name) ? $item->customer->name : 'Not Added' }}</td>
                                    <td>{{ isset($item->status) ? $item->status : 'Not Added' }}</td>
                                    <td>{{ isset($item->date) ? $item->date : 'Not Added' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('datatables')
    <script>
        $(document).ready(function() {
            $('#ticket_records').DataTable();
                    //FILTERS BY DATE
            $('#filterBtn').on('click', () => {
                const date = $('#filterDate').val();
                $('#data').html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('ticket_records.orderby.date') }}",
                    data: {
                        date: date
                    },
                    type: 'get',
                    success: function(response) {
                        for ($i = 0; $i < response.length; $i++) {
                            $("#data").append("<tr><td>" + ($i + 1) + "</td><td>" +
                                response[$i].id + "</td><td>" + response[$i].session.name +
                                "</td><td>" + response[$i].qr_id + "</td><td>" + response[
                                    $i].customer.name + "</td><td>" + response[$i].status +
                                "</td><td>" + response[$i].date + "</td></tr>")
                        }
                    }
                });
            })
                        //FILTERS BY SESSION
            $('#filterBtn').on('click', () => {
                const date = $('#filterDate').val();
                const session = $("#filterSession option:selected").val();
                $('#data').html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('ticket_records.orderby.session') }}",
                    data: {
                        session: session
                    },
                    type: 'get',
                    success: function(response) {
                        for ($i = 0; $i < response.length; $i++) {
                            $("#data").append("<tr><td>" + ($i + 1) + "</td><td>" +
                                response[$i].id + "</td><td>" + response[$i].session.name +
                                "</td><td>" + response[$i].qr_id + "</td><td>" + response[
                                    $i].customer.name + "</td><td>" + response[$i].status +
                                "</td><td>" + response[$i].date + "</td></tr>")
                        }
                    }
                });
            })
        });
    </script>
@endpush
@endsection
