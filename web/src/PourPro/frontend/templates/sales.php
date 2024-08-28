<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <div class="wrapper">

        <?php include __DIR__ . '/components/admin_navbar.php'; ?>

        <div class="container content">
            <div class="header-row d-flex justify-content-between align-items-center">
                <!-- Title -->
                <div class="title">
                    <h1><b>Sales History</b></h1>
                </div>
            </div>

            <?php $sales=$_SESSION["sales"];?>
            <?php if (isset($_SESSION["sales"]) && !empty($_SESSION["sales"])) { ?>
                <div class="orders-list">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total Quantity Sold</th>
                                <th>Total Sale amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sales as $sale) { ?>
                                <tr>
                                    <td>
                                        <?php echo $sale["sales_date"] ?>
                                    </td>
                                    <td>
                                        <?php echo $sale["total_quantity_sold"] ?>
                                    </td>
                                    <td>
                                        <?php echo $sale["total_sales"] ?>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                <?php }; ?>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>

        <?php include __DIR__ . '/components/admin_footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>