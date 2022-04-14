@extends('Layouts.app')
@section('content')
@section('title', 'Sessions - Selfie Art')
<div class="container">
    <div class="row">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 s-t">
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
                            <h4 class="card-title mt-2">Customer Records</h4>
                        </div>
                    </div>
                    <table class="table display responsive s-s" id="customer_records">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">CNIC</th>
                                <th scope="col">No. Of Total Tickets</th>
                                <th scope="col">Total No. Of Visits</th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->contact_no }}</td>
                                    <td>{{ $item->cnic }}</td>
                                    <td>{{ $item->qr_code }}</td>
                                    <td>{{ $item->Date }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info view" data-toggle="modal"
                                            data-id="{{ $item->id }}" data-target="#ViewModal"><i
                                                class="far fa-eye"></i></button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('customer_records.popup.view_popup')
                    @include('customer_records.popup.delete_popup')
                </div>
            </div>
        </div>
    </div>
</div>
@push('datatables')
    <script>

        $(document).ready(function() {
            $('#customer_records').DataTable();
            $('#ViewModal').appendTo("body");
            $('#DeleteModal').appendTo("body");

            $(".delete").click(function() {
                $("#record_id").val($(this).data("id"));
            });

            $(document).on('click', '.view', function() {
                $(".view-table").html('');
                $(".cnic").html('');
                $(".contact_no").html('');
                $(".modal-title").html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('record.view') }}",
                    type: 'post',
                    data : {
                        id : $(this).data('id'),
                    },
                    success : function(response){
                        for($i=0; $i<response.length; $i++){
                            $(".view-table").append("<tr><td>"+ response[$i].date  +"</td><td>"+ response[$i].qr_id  + "</td><td>"+ response[$i].socks  + "</td><td>"+ response[$i].name  + "</td><td>"+ response[$i].status  + "</td></tr>");
                        }
                        $(".modal-title").append(response[0].customer);
                        $(".cnic").append(response[0].cnic);
                        $(".contact_no").append(response[0].contact_no);
                    }
                });
            });
        });
    </script>
@endpush
@endsection
