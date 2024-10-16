<!-- Delete Confirmation Modal -->
<div class="modal fade delete-confirmation-modal" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="deleteForm" method="post" action="?command=deleteProduct">
  `      <div class="modal-body">
          Are you sure you want to delete this item from inventory?
          <span id="deleteProductName"></span>
        </div>
        <div class="modal-footer">
          <input type="hidden" id="deleteProductId" name="product_id" value="">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>`
      </form>
    </div>
  </div>
</div>
