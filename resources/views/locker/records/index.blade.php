@extends('Layouts.app')
@section('content')
@section('title', 'Sessions - Selfie Art')
<div class="container">
    <div class="row">
        <div class=" col-md-12 s-t">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title mt-2">Lockers Record</h4>
                        </div>
                        <div class="col-md-8 d-flex justify-content-end">
                            <a href="{{ route('locker_record.report') }}" class="btn btn-primary d-flex align-items-center text-center">Generate Report</a>
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
                            <button type="button" class="btn btn-danger" id="resetBtn" onclick="window.location.reload()">Reset</button>
                        </div>
                    </div>
                    <table class="table display responsive s-s" id="locker_records">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Locker Name</th>
                                <th scope="col">Session Name</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Qr</th>
                                <th scope="col">Date</th>

                            </tr>
                        </thead>
                        <tbody id="locker-body">
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->locker->name }}</td>
                                    <td>{{ $item->session['name'] ?  $item->session['name'] : 'Not Added' }}
                                    <td>{{ $item->customer->name }}</td>
                                    <td>{{ $item->qr_id }}</td>
                                    <td>{{ $item->date }}</td>
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
            $('#locker_records').DataTable();
            $('#filterBtn').on('click', () => {
                const date = $('#filterDate').val();
                $('#locker-body').html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('locker_records.orderby.date') }}",
                    data: {
                        date: date
                    },
                    type: 'get',
                    success: function(response) {
                        for ($i = 0; $i < response.length; $i++) {
                            $("#locker-body").append("<tr><td>" + (response.length) + "</td><td>" +
                                response[$i].locker.name + "</td><td>" + response[$i].session_id +"</td><td>" + response[$i].customer.name + "</td><td>" + response[
                                    $i].qr_id + "</td><td>" + response[$i].date + "</td></tr>")
                        }
                    }
                });
            })
                        //FILTERS BY SESSION
            $('#filterBtn').on('click', () => {
                const date = $('#filterDate').val();
                const session = $("#filterSession option:selected").val();
                $('#locker-body').html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('locker_records.orderby.session') }}",
                    data: {
                        session: session
                    },
                    type: 'get',
                    success: function(response) {
                        console.log(response);
                        for ($i = 0; $i < response.length; $i++) {
                            $("#locker-body").append("<tr><td>" + (response.length) + "</td><td>" +
                                response[$i].id + "</td><td>" + response[$i].session.name +
                                "</td><td>" + response[$i].qr_id + "</td><td>" + response[
                                    $i].customer.name + "</td></tr>")
                        }
                    }
                });
            })
        });
    </script>
@endpush
@endsection
