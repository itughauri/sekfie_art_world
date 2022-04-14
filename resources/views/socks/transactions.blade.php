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
                            <h4 class="card-title mt-2">Lockers Transaction</h4>
                        </div>
                    </div>
                    <table class="table display responsive s-s" id="customer_records">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">QR</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Session</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                @can('isAdmin')
                                <th>
                                    Actions
                                </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->qr_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->session }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    @can('isAdmin')
                                    <td>
                                        <a href="{{ route('sock_transection.edit' , [$item->id]) }}" class="btn btn-primary"><i class="far fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger delete" data-toggle="modal" data-id="{{ $item->id }}" data-target="#RecordModal"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('socks.popup.delete_popup')
                </div>
            </div>
        </div>
    </div>
</div>
@push('datatables')
    <script>

        $(document).ready(function() {
            $('#customer_records').DataTable();
            $('#RecordModal').appendTo("body");

            $(".delete").click(function() {
                $("#record_id").val($(this).data("id"));
            });

            // $(document).on('click', '.view', function() {
            //     $(".view-table").html('');
            //     $(".cnic").html('');
            //     $(".contact_no").html('');
            //     $(".modal-title").html('');
            //     $.ajax({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         url: "{{ route('record.view') }}",
            //         type: 'post',
            //         data : {
            //             id : $(this).data('id'),
            //         },
            //         success : function(response){
            //             console.log(response);
            //             for($i=0; $i<response.length; $i++){
            //                 $(".view-table").append("<tr><td>"+ response[$i].date  +"</td><td>"+ response[$i].qr_id  + "</td><td>"+ response[$i].socks  + "</td><td>"+ response[$i].name  + "</td></tr>");
            //             }
            //             $(".modal-title").append(response[0].customer);
            //             $(".cnic").append(response[0].cnic);
            //             $(".contact_no").append(response[0].contact_no);
            //         }
            //     });
            // });
        });
    </script>
@endpush
@endsection
