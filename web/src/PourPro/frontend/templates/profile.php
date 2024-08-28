<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Daniel Biondolillo and Param Patel">
    <meta name="description" content="This software allows you to manage your liquor business better">
    <meta name="keywords" content="Liquor Store management software">

    <title>Profile</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/common.css">
</head>
<body>
  <div class="wrapper">
    <!-- Navbar -->
    <?php if ($_SESSION["type"] === "admin") {
      include __DIR__ . '/components/admin_navbar.php';
    } else {
      include __DIR__ . '/components/customer_navbar.php';
    }?>

    <!-- Content Area -->
    <div class="container content">
      <div class="header-row">
        <div class="title">
          <b>Profile</b>
          <p><?php echo "Name: "; echo $_SESSION["name"]; ?></p>
          <p><?php echo "Email: "; echo $_SESSION["email"]; ?></p>
          <p><?php echo "Type: "; echo $_SESSION["type"]; ?></p>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php if ($_SESSION["type"] === "admin") {
      include __DIR__ . '/components/admin_footer.php';
    } else {
      include __DIR__ . '/components/customer_footer.php';
    }?>
  </div>
</body>
</html>
