<div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this Booking</h5>
            </div>
            <div class="modal-footer">
                <form action="{{ route('booking.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="customer_id" id="customer_id">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </form>
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
