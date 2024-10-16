<!-- Edit/Update Modal -->
<div class="modal fade update-modal" id="updateProductModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="updateProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateProductModalLabel">Update Existing Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="?command=updateProduct" class="update-form">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <!-- Product Name -->
                <div class="form-group mb-4">
                  <label class="form-label" for="id_product_name">Product Name</label>
                  <input type="text" id="id_product_name" class="form-control modal-input" name="product_name" data-default-value="">
                  <span class="text-danger product_name_error"></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <!-- Brand -->
                <div class="form-group mb-4">
                  <label class="form-label" for="id_brand">Brand</label>
                  <input type="text" id="id_brand" class="form-control modal-input" name="brand" data-default-value="">
                  <span class="text-danger brand_error"></span>
                </div>
              </div>
              <div class="col-md-4">
                <!-- Volume -->
                <div class="form-group mb-4">
                  <label class="form-label" for="id_volume">Volume (mL)</label>
                  <input type="number" id="id_volume" class="form-control modal-input" name="volume" data-default-value="">
                  <span class="text-danger volume_error"></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <!-- Category -->
                <div class="form-group mb-4">
                  <label class="form-label" for="id_category">Category</label>
                  <select id="id_category" class="form-control modal-input" name="category">
                    <option value="">Select a category</option>
                    <option value="Beer">Beer</option>
                    <option value="Whiskey">Whiskey</option>
                    <option value="Vodka">Vodka</option>
                  </select>
                  <span class="text-danger category_error"></span>
                </div>
              </div>
              <div class="col-md-4">
                <!-- Quantity -->
                <div class="form-group mb-4">
                  <label class="form-label" for="id_quantity">Quantity</label>
                  <input type="number" id="id_quantity" class="form-control modal-input" name="quantity_available" data-default-value="">
                  <span class="text-danger quantity_available_error"></span>
                </div>
              </div>
            </div>

            <!-- Unit Price -->
            <div class="form-group mb-4">
              <label class="form-label" for="id_unit_price">Unit Price</label>
              <input type="text" id="id_unit_price" class="form-control modal-input" name="unit_price" data-default-value="">
              <span class="text-danger unit_price_error"></span>
            </div>

            <!-- Supply Price -->
            <div class="form-group mb-4">
              <label class="form-label" for="id_supply_price">Supply Price</label>
              <input type="text" id="id_supply_price" class="form-control modal-input" name="supply_price" data-default-value="">
              <span class="text-danger supply_price_error"></span>
            </div>
            <!--Image Link-->
            <div class="form-group mb-4">
              <label class="form-label" for="id_image_link">Image link</label>
              <input type="text" id="id_image_link" class="form-control modal-input" name="image_link" data-default-value="">
              <span class="text-danger image_link_error"></span>
            </div>
            <!-- Hidden Product Id -->
            <input type="hidden" class="form-control" id="product_id" name="product_id" value="">

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Complete</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
