<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spend Analysis</title>
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
                    <h1><b>Spending Analysis</b></h1>
                </div>
            </div>
            
            <?php $spend=$_SESSION["spend"];?>
            <?php if (isset($_SESSION["spend"]) && !empty($_SESSION["spend"])) { ?>
            <div class="orders-list">
                <table>
                    <thead>
                        <tr>
                            <th>Purchase Date</th>
                            <th>Total Units ordered</th>
                            <th>Total Money Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($spend as $i) { ?>
                            <tr>
                                <td>
                                    <?php echo $i["sales_date"] ?>
                                </td>
                                <td>
                                    <?php echo $i["quantity_bought"] ?>
                                </td>
                                <td>
                                    <?php echo $i["total_amount"] ?>
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

        <?php include __DIR__ . '/components/customer_footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>