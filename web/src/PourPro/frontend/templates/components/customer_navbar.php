<!-- Import Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Customer Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg" style="border-bottom: 2px solid #673ab7;">
  <div class="container">
    <a class="navbar-brand" href="?command=custViewProducts">
      <i class="fas fa-glass-martini-alt" style="font-size: 1.5rem;"></i> 
      PourPro
    </a>

    <!--Hamburger-->
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Left-aligned navigation links with icons -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="?command=custViewProducts">
            <i class="fas fa-box-open"></i> 
            Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?command=cart">
            <i class="fas fa-shopping-cart"></i> 
            Cart
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?command=purchaseHistory">
            <i class="fas fa-history"></i> 
            Purchases
          </a>
        </li>
      </ul>

      <!-- Right-aligned navigation links with icons -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="?command=profile">
            <i class="fas fa-user"></i> 
            Profile
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?command=logout">
            <i class="fas fa-sign-out-alt"></i> 
            Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
