<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Your Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/common.css">
  <style>

  .cart-container {
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    background-color: #222831;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    max-height: 90vh;
    overflow: hidden;
    position: relative;
  }

  .cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 10px;
    border-bottom: solid white 2px;
    padding: 15px;
    color: white;
  }

  .cart-items {
    overflow-y: auto;
    max-height: 60vh;
    padding: 10px;
    border-radius: 10px;
  }

  .cart-row {
    background-color: #f1f1f1;
    display: flex;
    align-items: center;
    padding: 15px 0;
    border: 1px solid #ddd;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s;
    margin: 5px;
  }

  .cart-image {
    max-width: 50px;
    height: auto;
    object-fit: contain;
    border-radius: 5px;
    margin-right: 15px;
  }

  .cart-info {
    flex-grow: 1;
    color: #222831;
  }

  .cart-quantity {
    width: 50px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fff;
  }

  .remove-from-cart {
    color: #dc3545;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .remove-from-cart:hover {
    color: #a71d2a;
    text-decoration: underline;
  }

  .cart-footer {
    position: sticky;
    bottom: 0;
    border-radius: 10px;
    border-top: solid white 2px;
    padding: 20px;
    text-align: right;
    color: white;
    background-color: #222831;;
  }

  .cart-total {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .checkout-button {
    margin-top: 10px;
  }

  .checkout-button .btn {
    color: white;
    background-color: #00848a;
  }

  .btn {
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .btn:hover {
    background-color: #00c4cc; /* Light blue for hover */
    color: #222831; /* Dark gray for hover text */
    text-decoration: underline;
  }

  </style>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<div class="wrapper">
  <?php include __DIR__ . '/components/customer_navbar.php'; ?>

  <div class="container content">

    <div id="notification" class="alert" style="display: none;"></div>

    <div class="cart-container">
      <div class="cart-header row mb-2">
        <h2><b>Your Cart</b></h2>
      </div>

      <div class="row my-2">
        <p id="empty-cart-message" class="empty-cart-message mt-2 p-4" style="display: none; color:white">Your cart is empty.</p>

        <div id="cart-items" class="cart-items">
        </div>
      </div>

      <div class="cart-footer row my-2">
        <span>
        <p class="cart-total">Total: $<span id="cart-total">0.00</span></p>
        <div class="checkout-button">
          <button class="btn checkout">Checkout</button>
        </div>
      </div>
    </div>
  </div>

  <?php include __DIR__ . '/components/customer_footer.php'; ?>
</div>

<script>
function loadCartFromLocalStorage() {
  return JSON.parse(localStorage.getItem("cart")) || [];
}

function updateCartUI() {
  // Get cart from local storage
  const cart = loadCartFromLocalStorage();
  const $cartItems = $("#cart-items");
  $cartItems.empty();
  let cartTotal = 0;

  // Show empty cart message if length of cart list is 0
  if (cart.length === 0) {
    $("#empty-cart-message").show();
  } else {
    $("#empty-cart-message").hide();
  }

  // Construct html row for each cart and add to container
  cart.forEach((product) => {
    // Sum unit prices of each item in the cart
    cartTotal += product.quantity * product.price;

    const cartRowHtml = `
      <div class="cart-row row" data-product-id="${product.product_id}">
        <div class="col-auto">
          <img src="${product.image_link}" class="cart-image" alt="${product.product_name}">
        </div>
        <div class="col cart-info">
          <strong>${product.product_name}</strong>
          <p>
            <strong>Category:</strong> ${product.category} |
            <strong>Brand:</strong> ${product.brand} |
            <strong>Price:</strong> $${product.price}
          </p>
        </div>
        <div class="col-auto p-4">
          <a href="#" class="remove-from-cart mx-2">
            <i class="fas fa-trash"></i> Remove
          </a>
          <button class="btn btn-sm btn-outline-secondary btn-icon decrease-quantity">
            <i class="fas fa-minus"></i>
          </button>
          <input type="text" value="${product.quantity}" class="cart-quantity" readonly>
          <button class="btn btn-sm btn-outline-secondary btn-icon increase-quantity">
            <i class="fas fa-plus"></i>
          </button>

        </div>
      </div>
    `;

    $cartItems.append(cartRowHtml);
  });

  // Set cart total value
  $("#cart-total").text(cartTotal.toFixed(2));
}

// Increment/decrement product quantity in cart
function updateProductQuantity(productId, increment) {
  const cart = loadCartFromLocalStorage();
  const product = cart.find((item) => item.product_id === productId);

  if (product) {
    product.quantity = Math.max(1, product.quantity + increment);
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartUI();
  }
}

// Remove item from cart
function removeProductFromCart(productId) {
  let cart = loadCartFromLocalStorage();
  cart = cart.filter((item) => item.product_id !== productId);
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartUI();
}

// Remove cart from local storage
function emptyCart() {
  localStorage.removeItem("cart");
  updateCartUI();
}

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
  }, 3000);

  // Allow the notification to be dismissed when clicked
  $notification.off('click').on('click', function() {
    clearTimeout(timeout); 
    $notification.fadeOut(); 
  });
}

$(document).ready(() => {
  // Get cart from local storage and construct html rows
  updateCartUI();

  // Event listener for increment button
  $("#cart-items").on("click", ".decrease-quantity", function () {
    const productId = $(this).closest(".cart-row").data("product-id");
    updateProductQuantity(productId, -1);
  });

  // Event listener for decrement button
  $("#cart-items").on("click", ".increase-quantity", function () {
    const productId = $(this).closest(".cart-row").data("product-id");
    updateProductQuantity(productId, 1);
  });

  // Event listener for remove from cart button
  $("#cart-items").on("click", ".remove-from-cart", function (e) {
    e.preventDefault();
    removeProductFromCart($(this).closest(".cart-row").data("product-id"));
  });

  // Event listener fro checkout button
  $('.checkout').on('click', function (event) {
    event.preventDefault();

    let cartDataStr = localStorage.getItem("cart"); 

    // AJAX request to checkout items/update their quantities in database and 
    if (cartDataStr) {
      $.ajax({
        url: "?command=performCheckout",
        type: "POST",
        dataType: 'json',
        data: cartDataStr,
        contentType: "application/json; charset=utf-8",
        success: function (response) {
          console.log("Checkout successful:", response);
          emptyCart();
          showNotification('Checkout successful. Thank you for your purchase!', true);
        },
        error: function (xhr, status, error) {
          console.error("Checkout failed:", xhr.responseText);
          showNotification('Checkout failed', false);
          let errorData;
          try {
            errorData = JSON.parse(xhr.responseText);
          } catch (e) {
            errorData = { error: "Unknown error occurred." };
            showNotification('An error occurred during checkout', false);
          }
        }
      });
    } else {
      console.error("No cart data found in local storage");
      showNotification('You do not have any items in your cart', false);
    }
  });
});
</script>

</body>
</html>
