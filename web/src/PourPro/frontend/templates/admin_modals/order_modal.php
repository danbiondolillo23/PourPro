<!-- Order Modal -->
<div class="modal fade order-modal" id="orderModal" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Order Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="?command=orderProduct" class="order-form">
        <div class="modal-body">
          <!-- Read Only Product Information -->
          <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" readonly name="product_name">
          </div>
          <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" class="form-control" readonly name="category">
          </div>
          <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" class="form-control" readonly name="brand">
          </div>
          <div class="mb-3">
            <label class="form-label">Inventory Quantity</label>
            <input type="text" class="form-control" readonly name="quantity_available">
          </div>
          <!-- Quantity Input -->
          <div class="mb-3">
            <label class="form-label" for="quantityInput">Quantity to Order</label>
            <input type="number" class="modal-input form-control" id="quantityInput" name="quantity_ordered" placeholder="Enter quantity" data-default-value="">
            <span class="text-danger quantity_ordered_error">
              <!--Populated by JS/jQuery-->
            </span>
          </div>
          <!--Hidden Product Id-->
          <input type="hidden" class="form-control" id="quantityInput" name="product_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Order</button>
        </div>
      </form>
    </div>
  </div>
</div>
