<div id="order-create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="order-createTitle" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="order-createTitle">Add New Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="order-create-form">
          <div class="form-group mb-2">
            <label class="form-label" for="order-product">Product</label>
            <select class="form-select" id="order-product" name="product_id" onchange="updateOrderTotal()">
              <option value="" data-price="0">Select Product</option>
            </select>
          </div>
          <div class="form-group mb-2">
            <label class="form-label" for="order-customer">Customer</label>
            <select class="form-select" id="order-customer" name="customer_id">
              <option value="">Select Customer</option>
            </select>
          </div>
          <div class="row mb-2">
            <div class="form-group col-md-6">
              <label class="form-label" for="order-quantity">Quantity</label>
              <input type="number" min="1" class="form-control" id="order-quantity" name="quantity" value="1" onchange="updateOrderTotal()" oninput="updateOrderTotal()">
            </div>
            <div class="form-group col-md-6">
              <label class="form-label" for="order-total">Total</label>
              <input type="text" class="form-control" id="order-total" name="total" readonly>
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