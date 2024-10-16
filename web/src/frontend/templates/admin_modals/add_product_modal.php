<!--Example Modal Taken From Bootstrap5.3 Documentation @https://getbootstrap.com/docs/5.3/components/modal/-->
<!-- Add Product to Inventory Modal -->
<div class="modal fade add-product-modal" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addProductModalLabel">Add Product to Inventory</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="?command=addProduct" class="add-product-form">
          <div class="card-body">
            <!--Product Name -->
            <div class="form-group mb-4">
              <label class="form-label" for="id_product_name">Product Name</label>
              <input type="text" id="id_product_name" class="form-control modal-input" name="product_name">
                <span class="text-danger product_name_error"></span>
            </div>

            <!--Category-->
            <div class="row">
              <div class="col-md-8">
                <div class="form-group mb-4">
                  <label class="form-label" for="id_brand">Brand</label>
                  <input type="text" id="id_brand" class="form-control modal-input" name="brand">
                </div>
                  <span class="text-danger brand_error"></span>
              </div>

              <!--Quantity Field-->
              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label class="form-label" for="id_volume">Volume (mL)</label>
                  <input type="number" id="id_volume" class="form-control modal-input" name="volume">
                    <span class="text-danger volume_error"></span>
                </div>
              </div>
            </div>

            <!--Category-->
            <div class="row">
              <div class="col-md-8">
                <div class="form-group mb-4">
                  <label class="form-label" for="id_category">Category</label>
                  <select id="id_category" class="form-control modal_input" name="category"> 
                      <option value="" selected="selected">Select a category</option>
                      <option value="Beer">Beer</option>
                      <option value="Whiskey">Whiskey</option>
                      <option value="Vodka">Vodka</option>
                  </select>
                    <span class="text-danger category_error"></span>
                </div>
              </div>

              <!--Quantity Field-->
              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label class="form-label" for="id_quantity">Quantity</label>
                  <input type="number" id="id_quantity" class="form-control modal-input" name="quantity_available">
                    <span class="text-danger quantity_available_error"></span>
                </div>
              </div>
            </div>

            <div class="form-group mb-4">
              <label class="form-label" for="id_unit_price">Unit Price</label>
              <input type="text" id="id_unit_price" class="form-control modal-input" name="unit_price">
                  <span class="text-danger unit_price_error"></span>
            </div>

            <!-- Field-->
            <div class="form-group mb-4">
              <label class="form-label" for="id_supply_price">Supply Price</label>
              <input type="text" id="id_supply_price" class="form-control modal-input" name="supply_price">
                <span class="text-danger supply_price_error"></span>
            </div>
            <div class="form-group mb-4">
              <label class="form-label" for="id_image_link">Image Link</label>
              <input type="text" id="id_image_link" class="form-control modal-input" name="image_link">
                <span class="text-danger image_link_error"></span>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Complete</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>