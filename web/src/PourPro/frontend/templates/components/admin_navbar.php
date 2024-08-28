<!-- Use Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg" style="border-bottom: 2px solid #673ab7;">
  <div class="container">
    <a class="navbar-brand" href="#">
      <i class="fas fa-cocktail" style="font-size: 1.5rem;"></i>
      PourPro
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarContent"
      aria-controls="navbarContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <!-- Left-aligned navigation links -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="?command=inventory">
            <i class="fas fa-box"></i> 
            Inventory
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?command=pastOrders">
            <i class="fas fa-history"></i>
            Past Orders
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?command=sales">
            <i class="fas fa-chart-line"></i> 
            Sales
          </a>
        </li>
      </ul>

      <!-- Right-aligned navigation links -->
      <ul class="navbar-nav ms-auto">
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
