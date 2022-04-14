@extends('Layouts.app')
@section('content')

    <div class="container">
        <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">New Booking</h5>
                                        <h2 class="mb-3 font-18">{{ $booking }}</h2>
                                        {{-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Tickets Sold Today</h5>
                                        <h2 class="mb-3 font-18">{{ $customers }}</h2>
                                        {{-- <p class="mb-0"><span class="col-orange">09%</span> Decrease</p> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">New Entries</h5>
                                        <h2 class="mb-3 font-18">{{ $entry }}</h2>
                                        {{-- <p class="mb-0"><span class="col-green">18%</span> Increase
                                    </p> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Exits</h5>
                                        <h2 class="mb-3 font-18">{{ $exit }}</h2>
                                        {{-- <p class="mb-0"><span class="col-green">42%</span> Increase</p> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/4.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Entries Today</h4>
                        <table class="table display responsive s-s" id="entry_records">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope="col">QR</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Session</th>
                                    {{-- <th scope="col">Date</th> --}}
                                </tr>
                            </thead>
                            <tbody id="entry-body">
                                @foreach ($entry_records as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->qr_id }}</td>
                                        <td>{{ $item->customer->name ? $item->customer->name : 'Not Added' }}</td>
                                        <td>{{ $item->session->name ? $item->session->name : 'Not Added' }}</td>
                                        {{-- <td>{{ $item->date }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Exits Today</h4>
                        <table class="table display responsive s-s" id="exit_records">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope="col">QR</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Session</th>
                                    {{-- <th scope="col">Date</th> --}}
                                </tr>
                            </thead>
                            <tbody id="exit-body">
                                @foreach ($exit_records as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->qr->code }}</td>
                                        <td>{{ $item->customer['name'] ? $item->customer['name'] : 'Not Added' }}</td>
                                        <td>{{ $item->session['name']  ?  $item->session['name'] : 'Not Added' }}</td>
                                        {{-- <td>{{ $item->date }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Tickets Sold Today</h4>
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
                                        <td>{{ isset($item->session['name']) ? $item->session['name'] : 'Not Added' }}</td>
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lockers Assign Today</h4>
                        <table class="table display responsive s-s" id="locker_records">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Locker Name</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Session Name</th>
                                    <th scope="col">Qr</th>
                                    {{-- <th scope="col">Date</th> --}}
                                </tr>
                            </thead>
                            <tbody id="locker-body">
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->locker->name }}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td>{{ $item->session['name'] ?  $item->session['name'] : 'Not Added' }}
                                        <td>{{ $item->qr_id }}</td>
                                        {{-- <td>{{ $item->date }}</td> --}}
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
        $(document).ready(function(){
            $('#entry_records').DataTable();
            $('#exit_records').DataTable();
            $('#ticket_records').DataTable();
            $('#locker_records').DataTable();
        });
    </script>
@endpush
@endsection
