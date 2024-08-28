<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1" >

    <meta name="author" content="Param Patel and Daniel Biondolillo" >
    <meta
      name="description"
      content="This software allows you to manage your liquor business better"
    >
    <meta name="keywords" content="Liquor Store management software" >

    <title>Login</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/common.css" >
    <link rel="stylesheet" href="css/authentication.css" >
  </head>
  <body>
  
  <div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark shadow-lg" style="border-bottom: 2px solid #673ab7;">
    <div class="container">
      <a class="navbar-brand" href="#">
        <i class="fas fa-cocktail" style="font-size: 1.5rem;"></i>
        PourPro
      </a>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="?command=signup">Sign Up</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="login-container">
    <div class="login-form">
      <div class="login-title">
        <h1>Login</h1>
      </div>

      <form method="post" action="?command=logindb">
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
        </div>

        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Enter your password" name="passwd" required>
        </div>

        <div class="form-group text-end">
          <button type="submit" class="btn btn-primary" style="background-color: #00848a;">
            Sign In
          </button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
