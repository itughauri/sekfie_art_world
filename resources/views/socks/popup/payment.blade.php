<div class="modal fade" id="SockModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketModalLabel">Lockers are already alloted. If you want to buy again you
                    have to pay.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="display: none;" class="customer-error alert alert-danger">
                    Please fill all the required fields first
                </div>
                <div style="display: none;" class="customer-success alert alert-success">
                    Amount Added successfully
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form method="POST" action="{{ route('sock.cash') }}">
                                @csrf
                                <label for="qrID">Amount *</label>
                                <input type="hidden" id="qrValue" name="qrID" />
                                <input type="hidden" id="qty" name="qty" value="1"/>
                                <input type="text"  class="form-control" id="amount" name="amount"
                                    aria-describedby="emailHelp" placeholder="****" required>
                                <span class="customer-error" style="color: red; display: none;">This field is
                                    required</span>
                                <button type="submit" class="btn btn-primary mt-2">Accept Payment</button>
                        </div>
                    </div>
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
            $("#addNewCustomer").click(function() {
                if ($("#customer_name").val() == '') {
                    $(".customer-error").show();
                }
                if ($("#contact_no").val() == '') {
                    $(".contact_error").show();
                }
            });
        });
    </script>
@endpush
