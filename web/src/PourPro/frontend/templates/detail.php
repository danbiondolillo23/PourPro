<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1" >

    <meta name="author" content="Daniel Biondolillo and Param Patel" >
    <meta
      name="description"
      content="This software allows you to manage your liquor business better"
    >
    <meta name="keywords" content="Liquor Store management software" >

    <title>Product Detail</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/table.css">

    <style>
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
            max-height: 35vh;
            width: 100%;
            object-fit: scale-down;
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
    </style>

</head>
<body>
  <div class="wrapper">

    <?php include __DIR__ . '/components/admin_navbar.php'; ?>

    <!--Main Container-->
    <div class="container content">
      <div class="header-row d-flex justify-content-between align-items-center">
          <!-- Title -->
          <div class="title">
              <h1><b><?php echo $_SESSION["product_details"]["product_name"] ?> - Detail</b></h1>
          </div>
      </div>
      <!-- Product Container -->
      <div class="row product-container d-flex">
          <div class="col md-6 my-2">
            <div class="card">
                <canvas id="salesChart" width="100%"></canvas>
              <div class="card-body">
                <h2><b>Sales Analytics</b></h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 my-2">
              <div class="card">
                  <img src="<?php echo $_SESSION["product_details"]["image_link"] ?>" class="card-img-top product-img" alt="Product Image">
                  <div class="card-body">
                      <h2 class="card-title">
                        <?php echo $_SESSION["product_details"]["product_name"]?> - $<?php echo $_SESSION["product_details"]["unit_price"]?></h2>
                  </div>
              </div>
          </div>
      </div>

      <!--Product Table Row Detail-->
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="orders-list">
          <div class="table-responsive">
            <table class="table-striped table-bordered">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Quantity</th>
                      <th>Supply Price</th>
                      <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $_SESSION["product_details"]["product_id"]?></td>
                        <td><?php echo $_SESSION["product_details"]["product_name"] ?></td>
                        <td><?php echo $_SESSION["product_details"]["category"] ?></td>
                        <td><?php echo $_SESSION["product_details"]["brand"] ?></td>
                        <td><?php echo $_SESSION["product_details"]["quantity_available"] ?></td>
                        <td><?php echo $_SESSION["product_details"]["supply_price"] ?></td>
                        <td>
                          <div class="d-flex justify-content-evenly">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orderModal" data-product='<?php echo json_encode($_SESSION["product_details"]); ?>'>Order</button>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateProductModal" data-product='<?php echo json_encode($_SESSION["product_details"]); ?>'>Edit</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" data-product='<?php echo json_encode($_SESSION["product_details"]); ?>'>Delete</button>
                          </div>
                        </td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>

      <!--Product Sales Table-->
      <?php $productSales= $_SESSION["productSales"];?>
      <?php if (isset($_SESSION["productSales"]) && !empty($_SESSION["productSales"])) { ?>
          <div class="orders-list mt-4">
              <table>
                  <thead>
                      <tr>
                          <th>Date</th>
                          <th>Quantity Sold</th>
                          <th>Total Sale Amount</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($productSales as $productSale) { ?>
                          <tr>
                              <td>
                                  <?php echo $productSale["sales_date"] ?>
                              </td>
                              <td>
                                  <?php echo $productSale["date_quantity_sold"] ?>
                              </td>
                              <td>
                                  <?php echo $productSale["total_sales"] ?>
                              </td>
                          </tr>
                      <?php }; ?>
                  </tbody>
              </table>
          <?php }; ?>
          </div>
      </div>
    <?php include __DIR__ . '/components/admin_footer.php'; ?>

    <?php
        // Intialize to empty
        $salesDates = [];
        $salesQuantities = [];

        if (isset($_SESSION["productSales"]) && !empty($_SESSION["productSales"])) { 
            $productSales = $_SESSION["productSales"];        

            // Sort by sales date
            usort($productSales, function($a, $b) {
                $dateA = strtotime($a["sales_date"]);
                $dateB = strtotime($b["sales_date"]);
                return $dateA - $dateB;
            });
            
            // Get sales dates and quantities after sorting
            $salesDates = array_map(function($sale) { return $sale["sales_date"]; }, $productSales);
            $salesQuantities = array_map(function($sale) { return $sale["date_quantity_sold"]; }, $productSales);
        }
    ?>


    <!-- Modals -->
    <?php include __DIR__ . '/admin_modals/add_product_modal.php'; ?>
    <?php include __DIR__ . '/admin_modals/order_modal.php'; ?>
    <?php include __DIR__ . '/admin_modals/update_product_modal.php'; ?>
    <?php include __DIR__ . '/admin_modals/delete_modal.php'; ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="js/inventory.js"></script>


<script>
$(document).ready(function() {
    let ctx = $("#salesChart")[0].getContext('2d');

    // Initialize the chart
    let salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($salesDates); ?>, 
            datasets: [{
                label: 'Quantity Sold', 
                data: <?php echo json_encode($salesQuantities); ?>,
                borderColor: 'rgba(75, 192, 192, 1)', 
                backgroundColor: 'rgba(75, 192, 192, 0.2)', 
                borderWidth: 2 
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'time', 
                    time: {
                        unit: 'day' 
                    },
                    title: {
                        display: true,
                        text: 'Sales Dates'
                    }
                },
                y: {
                    beginAtZero: true, 
                    title: {
                        display: true,
                        text: 'Quantity Sold' 
                    }
                }
            }
        }
    });
});
</script>


</body>
</html>
