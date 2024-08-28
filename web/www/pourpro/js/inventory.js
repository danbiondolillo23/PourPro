
// Display notification indicating success or failure of operation
function showNotification(message, isSuccess) {
  const $notification = $('#notification');
  
  $notification.text(message);
  $notification.removeClass('alert-success alert-danger');

  if (isSuccess) {
    $notification.addClass('alert-success');
  } else {
    $notification.addClass('alert-danger');
  }

  // Display success/failure notification
  $notification.fadeIn();

  const timeout = setTimeout(() => {
    $notification.fadeOut();
  }, 2000);

  // Allow the notification to be dismissed when clicked
  $notification.off('click').on('click', function() {
    clearTimeout(timeout); 
    $notification.fadeOut(); 
  });
}


$(document).ready(function() {

  // Populate Order Modal with previous read only details
  $('.order-modal').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let product = button.data('product');
    let modal = $(this);
    modal.find('.modal-body input[name="product_name"]').val(product.product_name);
    modal.find('.modal-body input[name="category"]').val(product.category);
    modal.find('.modal-body input[name="brand"]').val(product.brand);
    modal.find('.modal-body input[name="quantity_available"]').val(product.quantity_available);
    modal.find('.modal-body input[name="product_id"]').val(product.product_id);
    modal.find('.modal-body input[name="image_link"]').val(product.image_link);
  });

  // Order Form Error Handling
  $('.order-form').submit(function(event) {
    // Clear previous error messages
    $('.text-danger').text('');

    event.preventDefault();
    let formData = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: '?command=orderProduct',
      data: formData,
      dataType: 'json',
      success: function(response) {
        // Check if the response contains errors
        if (response.errors) {
          // Render validation errors dynamically
          $.each(response.errors, function(key, value) {
            $('.' + key + '_error').text(value);
          });

          showNotification('Failed to order product. Check errors.', false);
        } else {
          // Hide modal and reload page
          $('.order-modal').modal('hide');
          showNotification('Product ordered successfully!', true);
          setTimeout(() => {
              location.reload();
          }, 2000);
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  });

  // Populate Update Modal with previous data
  $('.update-modal').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let product = button.data('product');
    let modal = $(this);
    modal.find('.modal-body input[name="product_name"]').val(product.product_name);
    modal.find('.modal-body input[name="brand"]').val(product.brand);
    modal.find('.modal-body input[name="volume"]').val(product.volume);
    modal.find('.modal-body select[name="category"]').val(product.category);
    modal.find('.modal-body input[name="quantity_available"]').val(product.quantity_available);
    modal.find('.modal-body input[name="unit_price"]').val(product.unit_price);
    modal.find('.modal-body input[name="supply_price"]').val(product.supply_price);
    modal.find('.modal-body input[name="product_id"]').val(product.product_id);
    modal.find('.modal-body input[name="barcode"]').val(product.barcode);
    modal.find('.modal-body input[name="image_link"]').val(product.image_link);

  });

  // Update Form Error Handling
  $('.update-form').submit(function(event) {
    // Clear previous error messages
    $('.text-danger').text('');

    event.preventDefault();
    let formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      url: '?command=updateProduct',
      data: formData,
      dataType: 'json',
      success: function(response) {
        // Check if the response contains errors
        if (response.errors) {
          // Render validation errors dynamically
          $.each(response.errors, function(key, value) {
            $('.' + key + '_error').text(value);
          });

          showNotification('Failed to update product. Check errors.', false);
        } else {
          // Hide modal and reload page
          $('.update-modal').modal('hide');
          showNotification('Product updated successfully!', true);
          setTimeout(() => {
              location.reload();
          }, 2000);
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
        showNotification('An error occurred while updating the product.', false);
      }
    });
  });

  // Populate Delete Confirmation Modal with product details
  $('.delete-confirmation-modal').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let product = button.data('product');
    let modal = $(this);
    modal.find('.modal-body #deleteProductName').text(product.product_name);
    modal.find('.modal-footer #deleteProductId').val(product.product_id);
  });

  // Add Product Error Handling
  $('.add-product-form').submit(function(event) {
    // Clear previous error messages
    $('.text-danger').text('');

    event.preventDefault();
    let formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      url: '?command=addProduct',
      data: formData,
      dataType: 'json',
      success: function(response) {
        // Check if the response contains errors
        if (response.errors) {
          // Render validation errors dynamically
          $.each(response.errors, function(key, value) {
            $('.' + key + '_error').text(value);
          });
          showNotification('Failed to add product. Check errors.', false);
        } else {
          $('.add-product-modal').modal('hide');
          // Reload page
          showNotification('Product added successfully!', true);
          setTimeout(() => {
              location.reload();
          }, 2000);
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  });

  // Add Product Error Handling
  $('#deleteForm').submit(function(event) {
    // Clear previous error messages
    $('.text-danger').text('');

    event.preventDefault();
    let formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      url: '?command=deleteProduct',
      data: formData,
      dataType: 'json',
      success: function(response) {
        // Check if the response contains errors
        if (response.errors) {
          // Render validation errors dynamically
          $.each(response.errors, function(key, value) {
            $('.' + key + '_error').text(value);
          });
          showNotification('Failed to delete product. Check errors.', false);
        } else {
          $('#deleteConfirmationModal').modal('hide');
          // Reload page
          showNotification('Product deleted.', true);
          setTimeout(() => {
              location.reload();
          }, 2000);
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  });

  // Event listener for any modal hidden event
  $('.modal').on('hidden.bs.modal', function (e) {

    // Reset inputs to their default values
    $('.modal-input').each(function() {
        let defaultValue = $(this).data('default-value');
        $(this).val(defaultValue);
    });

    // Clear dropdowns back to default on close
    $('select').each(function() {
      let defaultValue = $(this).find('option[selected]').val();
      $(this).val(defaultValue);
    });

    // Clear error messages
    $('.text-danger').text('');
  });


});