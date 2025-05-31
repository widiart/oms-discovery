<div id="customer-create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="customer-createTitle" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customer-createTitle">Add New Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="customer-create-form">
          <div class="form-group">
              <label class="form-label" for="name">Customer Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="John Doe">
          </div>
          <div class="form-group">
              <label class="form-label" for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com">
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <label class="form-label" for="phone">Phone Number</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="08123456789">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="formSubmit()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div id="customer-update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="customer-createTitle" aria-hidden="true" data-bs-backdrop="static">
  <div id="customer-update-loading" class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white bg-opacity-75" style="z-index:1051; display:none;">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customer-createTitle">Update Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="customer-update-form">
          <div class="form-group">
              <label class="form-label" for="name">Customer Name</label>
              <input type="hidden" id="update-id" name="id">
              <input type="text" class="form-control" id="update-name" name="name" placeholder="John Doe">
          </div>
          <div class="form-group">
              <label class="form-label" for="email">Email</label>
              <input type="email" class="form-control" id="update-email" name="email" placeholder="john@example.com">
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <label class="form-label" for="phone">Phone Number</label>
              <input type="text" class="form-control" id="update-phone" name="phone" placeholder="08123456789">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="formUpdateSubmit()">Save changes</button>
      </div>
    </div>
  </div>
</div>