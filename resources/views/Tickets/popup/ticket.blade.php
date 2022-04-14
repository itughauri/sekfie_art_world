<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog"
aria-labelledby="ticketModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ticketModalLabel">Add Customer Information</h5>
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div style="display: none;" class="customer-error alert alert-danger">
                Please fill all the required fields first
            </div>
            <div style="display: none;" class="customer-success alert alert-success">
                Customer Added successfully
            </div>
            <div style="display: none;" id="exists" class="alert alert-danger">
                Customer Already Exists
            </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name *</label>
                      <input type="text" class="form-control" id="customer_name" name="name" aria-describedby="emailHelp" placeholder="Enter Name" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Age</label>
                      <input type="number" class="form-control" id="age" name="age" placeholder="Age">
                    </div>
                  </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Contact Number *</label>
                    <input type="number" class="form-control" id="contact_no" name="contact_no" placeholder="Contact Number" required>
                    <span class="contact_error" style="color: red; display: none;">This field is required</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>CNIC</label>
                    <input type="number" class="form-control" id="cnic" name="cnic" placeholder="CNIC">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                  </div>
                </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="gender">Gender</label>
                <div class="input-group">
                    <select class="custom-select" id="gender" name="gender">
                        <option selected name="" disabled>Choose...</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                  </div>
              </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="addNewCustomer">Add New Customer</button>
            <button type="button" class="btn btn-secondary ok"
                data-dismiss="modal">Close</button>

        </div>
    </div>
</div>
</div>

@push('datatables')

@endpush
