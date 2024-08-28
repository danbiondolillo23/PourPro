<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="author" content="Daniel Biondolillo and Param Patel">
  <meta name="description" content="This software allows you to manage your liquor business better">
  <meta name="keywords" content="Liquor Store management software">

  <title>Inventory</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/table.css">
  <link rel="stylesheet" href="css/light.css">
</head>
<style>
  .inventory-controls .btn {
    background-color: #00848a;
    color: white;
  }

  .inventory-controls .btn:hover {
    background-color: #00c4cc; 
    color: #222831;
  }

  .dropdown-menu .dropdown-item:hover {
    background-color: #00c4cc;
  }


</style>
<body>
  <div class="wrapper">
    <?php include __DIR__ . '/components/admin_navbar.php'; ?>

    <!--Main Container-->
    <div class="container content">

      <!-- Notification Element -->
      <div id="notification" class="alert" style="display: none;"></div>

      <!-- Title Container with Buttons-->
      <div class="header-row">
        <div class="row">
          <!-- Title -->
          <div class="col-md-6 title">
            <h1><b>Inventory</b></h1>
          </div>

          <!-- Buttons -->
          <div class="col-md-6 d-flex justify-content-end inventory-controls">
            <button id="theme-toggle" class="btn m-2">Switch Theme</button>
            <button type="button" class="btn m-2" data-bs-toggle="modal" data-bs-target="#addProductModal">
              Add Product to Inventory
            </button>
            <a href="?command=productListToJson" class="btn m-2" role="button">
              Export Product List
            </a>
          </div>
        </div>
      </div>

        <div class="orders-list">
          <!--Product Inventory Table-->
          <div class="table-responsive">
            <table class="table-striped table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Brand</th>
                  <th>Category</th>
                  <th>Supply Price</th>
                  <th>Unit Price</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $noOfProducts = count($_SESSION['products']);
                // Used to sort products by id before rendering https://stackoverflow.com/questions/28721433/php-how-to-use-usort-with-anonymous-function
                $products = $_SESSION['products'];
                usort($products, function($a, $b) {
                    return $a['product_id'] <=> $b['product_id'];
                });
                $_SESSION['products'] = $products;
                for ($i = 0; $i < $noOfProducts; $i++) : ?>
                  <tr>
                    <td><?php echo $_SESSION["products"][$i]["product_id"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["product_name"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["quantity_available"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["brand"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["category"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["supply_price"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["unit_price"]?></td>
                    <td>
                      <!--Dropend from https://getbootstrap.com/docs/5.3/components/dropdowns/-->
                      <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        </button>
                        <ul class="dropdown-menu">
                          <li>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#orderModal" data-product='<?php echo json_encode($_SESSION["products"][$i]); ?>'>Order</a>
                          </li>
                          <li>
                            <a href="?command=detail&product_id=<?php echo $_SESSION["products"][$i]["product_id"]; ?>" class="dropdown-item">View</a>
                          </li>
                          <li>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateProductModal" data-product='<?php echo json_encode($_SESSION["products"][$i]); ?>'>Edit</a>
                          </li>
                          <li>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" data-product='<?php echo json_encode($_SESSION["products"][$i]); ?>'>Delete</a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endfor; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    </div>
    <?php include __DIR__ . '/components/admin_footer.php'; ?>

    <!-- Modals -->
    <?php include __DIR__ . '/admin_modals/add_product_modal.php'; ?>
    <?php include __DIR__ . '/admin_modals/order_modal.php'; ?>
    <?php include __DIR__ . '/admin_modals/update_product_modal.php'; ?>
    <?php include __DIR__ . '/admin_modals/delete_modal.php'; ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="js/inventory.js"></script>
  <script src="js/theme.js"></script>

</body>
</html>