@extends('Layouts.app')
@section('content')
@section('title', 'Sessions - Selfie Art')
<div class="container">
    <div class="row">
        <div class=" col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 s-t">
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
                            <h4 class="card-title mt-2">Exit Records</h4>
                        </div>
                        <div class="col-md-8 d-flex justify-content-end">
                            <a href="{{ route('exit_record.report') }}" class="btn btn-primary d-flex align-items-center text-center">Generate Report</a>
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
                    <table class="table display responsive s-s" id="exit_records">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">QR</th>
                                <th scope="col">Session</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody id="exit-body">
                            @foreach ($exit as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->customer['name'] ? $item->customer['name'] : 'Not Added' }}</td>
                                    <td>{{ $item->qr->id }}</td>
                                    <td>{{ $item->session['name']  ?  $item->session['name'] : 'Not Added' }}</td>
                                    <td>{{ $item->date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('entry_records.popup.delete_popup')
                </div>
            </div>
        </div>
    </div>
</div>
@push('datatables')
    <script>
        $(document).ready(function() {
            $('#exit_records').DataTable();
            $('#EntryModal').appendTo("body");

            //FILTERS BY DATE
            $('#filterBtn').on('click', () => {
                $("#exit-body").html('');
                const date = $('#filterDate').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('exit_records.orderby.date') }}",
                    data: {
                        date: date
                    },
                    type: 'get',
                    success: function(response) {
                        console.log(response);
                        for ($i = 0; $i < response.length; $i++) {
                            $("#exit-body").append("<tr><td>" + (response.length) + "</td><td>" +
                                response[$i].customer.name + "</td><td>" + response[$i].qr.code +
                                "</td><td>" + response[$i].session.name + "</td><td>" + response[
                                    $i].date + "</td></tr>")
                        }
                    }
                });
            })
            //FILTERS BY SESSION
            $('#filterBtn').on('click', () => {
                const date = $('#filterDate').val();
                const session = $("#filterSession option:selected").val();
                $('#exit-body').html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('exit_records.orderby.session') }}",
                    data: {
                        session: session,
                        date : date
                    },
                    type: 'get',
                    success: function(response) {
                        // console.log(response);
                        for ($i = 0; $i < response.length; $i++) {
                            $("#exit-body").append("<tr><td>" + (response.length) + "</td><td>" +
                                response[$i].customer.name + "</td><td>" + response[$i].qr.code +
                                "</td><td>" + response[$i].session.name + "</td><td>" + response[
                                    $i].date + "</td></tr>")
                        }
                    }
                });
            })
        });
    </script>
@endpush
@endsection
