<div id="product-create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="product-createTitle" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="product-createTitle">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="product-create-form">
          <div class="form-group">
              <label class="form-label" for="name">Product Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Iphone 14 Pro Max">
          </div>
          <div class="form-group">
              <label class="form-label" for="price">Price</label>
              <input type="text" class="form-control" id="price" name="price" placeholder="Rp. 20.000.000">
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="form-label" for="stock">Initial Stock</label>
              <input type="number" class="form-control" id="stock" name="stock" placeholder="100">
            </div>
            <div class="form-group col-md-6">
              <label class="form-label">Product Status</label>
              <div class="form-check form-switch pt-2">
                <input type="checkbox" class="form-check-input" id="isActive" name="is_active" onchange="document.getElementById('isActiveLabel').innerText = this.checked ? 'Active' : 'Inactive';">
                <label class="form-check-label" for="isActive" id="isActiveLabel">Inactive</label>
              </div>
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

<div id="product-update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="product-createTitle" aria-hidden="true" data-bs-backdrop="static">
  <div id="product-update-loading" class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white bg-opacity-75" style="z-index:1051; display:none;">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="product-createTitle">Update Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="product-update-form">
          <div class="form-group">
              <label class="form-label" for="name">Product Name</label>
              <input type="hidden" id="update-id" name="id">
              <input type="text" class="form-control" id="update-name" name="name" placeholder="Iphone 14 Pro Max">
          </div>
          <div class="form-group">
              <label class="form-label" for="price">Price</label>
              <input type="text" class="form-control" id="update-price" name="price" placeholder="Rp. 20.000.000">
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="form-label" for="stock">Initial Stock</label>
              <input type="number" class="form-control" id="update-stock" name="stock" placeholder="100">
            </div>
            <div class="form-group col-md-6">
              <label class="form-label">Product Status</label>
              <div class="form-check form-switch pt-2">
                <input type="checkbox" class="form-check-input" id="update-isActive" name="is_active" onchange="document.getElementById('update-isActiveLabel').innerText = this.checked ? 'Active' : 'Inactive';">
                <label class="form-check-label" for="update-isActive" id="update-isActiveLabel">Inactive</label>
              </div>
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