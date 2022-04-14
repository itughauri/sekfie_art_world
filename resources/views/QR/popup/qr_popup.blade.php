<div class="modal fade" id="QrModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this QR</h5>
            </div>
            <div class="modal-footer">
                <form action="{{ route('qr.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="qr_id" id="qr_id">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
