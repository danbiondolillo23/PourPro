<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shop Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="css/common.css">
  <style>
  .product-container {
    padding: 20px;
    border: 2px solid #00848a;
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .card {
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s;
    padding: 4px;
  }

  .card:hover {
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.5);
  }

  .card-img-top {
    height: 200px;
    object-fit: contain;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }

  .card-body {
    color: #333333;
    border-radius: 10px;
    background-color: #f5f5f5; 
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .card-title {
    color: #222831;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: bold;
    padding: 4px;
  }

  .cart-buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
  }

  .cart-buttons button {
    width: 100%;
    margin-top: 8px;
    color: white;
    border: none;
    transition: opacity 0.3s;
  }

  .cart-buttons button:hover {
    text-decoration: underline;
  }

  .cart-info {
    display: none;
    align-items: center;
    justify-content: center;
  }

  .add-to-cart {
    background-color: #00848a; 
  }

  .add-to-cart:hover{
    background-color: #00c4cc; /* Light blue for hover */
    color: #222831; /* Dark gray for hover text */
  }

  .remove-from-cart {
    background-color: red;
    color: #e57373; 
    text-decoration: none;
  }

  .row {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: space-around;
  }

  .col-md-3 {
    flex: 1 0 22%;
    min-width: 250px;
    max-width: 22%;
  }

  .pagination-controls {
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px; 
  }

  .pagination-controls button {
    padding: 8px 16px;
  }

  @media (max-width: 576px) { 
    .pagination-controls {
      flex-direction: column; 
    }

  }

  @media (max-width: 767px) {
    .row {
      justify-content: center;
    }
  }

  .pagination-controls span {
    color: #222831
  }

  .pagination-controls button {
    background-color: #00848a;;
  }

  .pagination-controls button:hover {
    background-color: #00c4cc;
  }
</style>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

  <div class="wrapper">
    <?php include __DIR__ . '/components/customer_navbar.php'; ?>

    <div class="container content">
      <div class="header-row d-flex justify-content-between align-items-center">
        <!-- Title -->
        <div class="title">
          <h1><b>Shop Products</b></h1>
        </div>

        <div class="pagination-controls text-center">
          <button class="btn btn-secondary" id="prev-page" disabled aria-label="Previous Page">
            <i class="fas fa-arrow-left"></i>
          </button>
          <span>Page <span id="current-page">1</span></span>
          <button class="btn btn-secondary" id="next-page" aria-label="Next Page">
            <i class="fas fa-arrow-right"></i>
          </button>
        </div>
      </div>

      <div class="product-container">
        <div class="row">
          <!--Product Cards get dynamically rendered here after page product JSON is fetched asynchronously-->
        </div>
      </div>
    </div>

    <?php include __DIR__ . '/components/customer_footer.php'; ?>
  </div>

</body>
<script>

let currentPage = 1;
const itemsPerPage = 8;
let totalProducts = 0;
let totalPages = 0;


// Manage cart in local storage
function loadCartFromLocalStorage() {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  return cart;
}

function saveCartToLocalStorage(cart) {
  localStorage.setItem('cart', JSON.stringify(cart));
}

function findProductInCart(cart, productId) {
  return cart.find(item => item.product_id === productId);
}

function addItemToCart(product) {
  let cart = loadCartFromLocalStorage();
  let existingItem = findProductInCart(cart, product.product_id);

  if (existingItem) {

    existingItem.quantity += 1;
  } else {
    // Set item quantity property
    product.quantity = 1;
    cart.push(product);
  }

  saveCartToLocalStorage(cart);
  updateCartUI();
}

function removeItemFromCart(productId) {
  let cart = loadCartFromLocalStorage();
  cart = cart.filter(item => item.product_id !== productId);
  saveCartToLocalStorage(cart);
}

function updateCartUI() {
  let cart = loadCartFromLocalStorage();
  $(".card").each(function() {
    let productId = $(this).data("product-id");
    let productInCart = findProductInCart(cart, productId);

    if (productInCart) {
      $(this).find(".add-to-cart").hide();
      $(this).find(".cart-info").show();
    } else {
      $(this).find(".add-to-cart").show();
      $(this).find(".cart-info").hide();
    }
  });
}



  // Load products by consuming JSON
  function loadProducts(page, perPage) {
    $.ajax({
      url: '?command=getProductsJSON',
      type: 'GET',
      data: { page: page, perPage: perPage },
      dataType: 'json',
      success: function(products) {
        console.log('Products:', products);
        renderProducts(products);
      },
      error: function(error) {
        console.error('Error loading products:', error);
      }
    });
  }

  function renderProductCard(product) {
    let card = `
      <div class="col-md-3 mb-4">
        <div class="card" data-product-id="${product.product_id}">
          <img src="${product.image_link}" class="card-img-top" alt="${product.product_name}">
          <div class="card-body">
            <h5 class="card-title">${product.product_name}</h5>
            <p class="card-text">
              <strong>Category:</strong> ${product.category}<br>
              <strong>Brand:</strong> ${product.brand}<br>
              <strong>Price:</strong> $${parseFloat(product.unit_price).toFixed(2)}
            </p>
            <input type="hidden" class="product-category" value="${product.category}" />
            <input type="hidden" class="product-brand" value="${product.brand}" />
            <input type="hidden" class="product-price" value="${parseFloat(product.unit_price).toFixed(2)}" />
            <input type="hidden" class="product-image" value="${product.image_link}" />
            <input type="hidden" class="product-quantity-available" value="${product.quantity_available}" />
            <div class="cart-buttons">
            <button class="btn btn-block add-to-cart" style="width: 100%; background-color: #00848a;">Add to Cart</button>
            <div class="cart-info" style="display: none; text-align: center; width: 100%;">
              <span class="cart-quantity">Item in Cart</span>
              <button class="btn btn-outline-danger btn-sm remove-from-cart">Remove</button>
            </div>
          </div>
          </div>
          </div>
        </div>
      </div>`;
    
    return card;
  }

function renderProducts(products) {
  let row = $(".product-container .row");
  row.empty();
  products.forEach(product => {
    row.append(renderProductCard(product));
  });
  updateCartUI();
}



function loadTotalProductCount() {
    $.ajax({
        url: '?command=getTotalProductCount',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            totalProducts = data.totalProducts[0].total;
            totalPages = Math.ceil(totalProducts / itemsPerPage);
            updatePaginationControls();
            console.log(totalProducts);
        },
        error: function(error) {
            console.error('Error loading total product count:', error);
        }
    });
}

function updatePaginationControls() {
    // Update the displayed current page
    $("#current-page").text(currentPage);

    // Disable "Previous" button on the first page
    if (currentPage <= 1) {
        $("#prev-page").attr("disabled", true);
    } else {
        $("#prev-page").attr("disabled", false);
    }

    // Disable "Next" button on the last page
    if (currentPage >= totalPages) {
        $("#next-page").attr("disabled", true);
    } else {
        $("#next-page").attr("disabled", false);
    }
}




$(document).ready(function() {
  loadProducts(currentPage, itemsPerPage);
  updateCartUI();
  loadTotalProductCount();
  updatePaginationControls();

  $(document).on("click", "#prev-page", function() {
    console.log("Previous");
      if (currentPage > 1) {
          currentPage--;
          loadProducts(currentPage, itemsPerPage);
          updatePaginationControls();
          console.log("Called load products on click");
      }
  });

  $(document).on("click", "#next-page", function() {
    console.log("Current: " + currentPage);
    console.log("Total: " + totalPages);

    console.log("Next");
      if (currentPage < totalPages) {
          currentPage++;
          loadProducts(currentPage, itemsPerPage);
          updatePaginationControls();
          console.log("Called load products on click");
      }
  });


  // Attach event listener for add to cart button
  $(document).on("click", ".add-to-cart", function() {
    let card = $(this).closest(".card");
    let productId = card.data("product-id");

    let product = {
      product_id: productId,
      product_name: card.find(".card-title").text(),
      category: card.find(".product-category").val(),
      brand: card.find(".product-brand").val(),
      price: parseFloat(card.find(".product-price").val()),
      image_link: card.find(".product-image").val(),
      quantity_available: card.find(".product-quantity-available").val()
    };

    addItemToCart(product);
    updateCartUI();
  });

  // Attach event listener for remove from cart button
  $(document).on("click", ".remove-from-cart", function() {
    let productId = $(this).closest(".card").data("product-id");
    removeItemFromCart(productId);
    updateCartUI();
  });
});

</script>

</body>
</html>
