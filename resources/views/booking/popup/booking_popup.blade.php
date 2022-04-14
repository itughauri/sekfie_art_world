<div class="modal fade" id="BookModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketModalLabel">QR Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="display: none" id="success" class="alert alert-success">
                    Ticket Generated Successfully
                </div>
                <div style="display: none; color: white;" id="error" class="alert alert-danger">
                    QR is not assigned to any session yet
                </div>

                <div style="display: none; color: white;" class="exists alert alert-danger">
                    QR already allotted
                </div>
                <form action="{{ route('booking.multiple_assign') }}" method="post">
                    @csrf
                <input type="hidden" id="customers_id" name="customer_id">
                <div class="form-group assign-box">
                    <label>QR Code</label>
                    <input type="email" class="form-control" id="qr_code" name="qr_code[]" placeholder="QR Code"
                        required>
                    <div style="display: none" class="error-1 alert alert-danger mt-1">
                        QR is required
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="assign">Assign</button>
                <button type="button" class="btn btn-secondary ok" data-dismiss="modal">Close</button>

            </div>
        </form>
        </div>
    </div>
</div>

@push('datatables')

@endpush
