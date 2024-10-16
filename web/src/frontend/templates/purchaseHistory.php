<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <div class="wrapper">
        <?php include __DIR__ . '/components/customer_navbar.php'; ?>
        <div class="container content">
            <div class="header-row d-flex justify-content-between align-items-center">
                <!-- Title -->
                <div class="title">
                    <h1><b>Purchase History</b></h1>
                </div>
            </div>

        <?php $purchases=$_SESSION["purchases"];?>
        <?php if (isset($_SESSION["purchases"]) && !empty($_SESSION["purchases"])) { ?>
            <div class="orders-list">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Purchase Date</th>
                                <th>Product Name</th>
                                <th>Quantity Ordered</th>
                                <th>Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($purchases as $purchase) { ?>
                                <tr>
                                    <td>
                                        <?php echo $purchase["sales_date"] ?>
                                    </td>
                                    <td>
                                        <?php echo $purchase["product_name"] ?>
                                    </td>
                                    <td>
                                        <?php echo $purchase["quantity_sold"] ?>
                                    </td>
                                    <td>
                                        <?php echo $purchase["total_price"] ?>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            <?php }; ?>
            <br>
            <br>
            <br>
            <br>
            </div>
        </div>
        <?php include __DIR__ . '/components/customer_footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>