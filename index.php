<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Service Hub</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #f8fafc;
            overflow-x: hidden;
        }
        .navbar {
            background-color: transparent;
        }
        .nav-link, .navbar-brand, .nav-item a {
            color: #e0e7ff !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #8b5cf6 !important;
        }
        .logo {
            height: 45px;
        }
        .btn-outline-light, .btn-primary {
            background: linear-gradient(to right, #6366f1, #8b5cf6);
            border: none;
            color: white;
            transition: 0.3s;
        }
        .btn-outline-light:hover {
            background: linear-gradient(to left, #6366f1, #8b5cf6);
        }
        h3, h4, p {
            color: #cbd5e1;
        }
        .bg-light, .bg-info, .bg-secondary {
            background-color: #1e293b !important;
        }
        .card {
            background-color: #334155;
            color: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.2);
        }
        .card:hover {
            transform: scale(1.02);
            transition: 0.3s ease;
        }
        .text-center {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        .form-control {
            background-color: #1e293b;
            color: white;
            border: 1px solid #475569;
        }
        .form-control::placeholder {
            color: #94a3b8;
        }
        footer {
            background-color: #0f172a;
            color: #cbd5e1;
            padding: 1rem 0;
            text-align: center;
        }
        @media (max-width: 768px) {
            .logo {
                height: 35px;
            }
            .form-control {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="./image/logo.png" alt="logo" class="logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="display.php">Service</a></li>
          <?php if(isset($_SESSION['username'])) {
            echo "<li class='nav-item'><a class='nav-link' href='./users_area/profile.php'>My Account</a></li>";
          } else {
            echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_registration.php'>Register</a></li>";
          } ?>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="booking.php">Booking <i class="fa-solid fa-person"></i><sup><?php cart_item(); ?></sup></a></li>
          <li class="nav-item"><a class="nav-link" href="#">Total Price: <?php total_booking_price(); ?>/-</a></li>
        </ul>
        <form class="d-flex" action="search.php" method="get">
          <input class="form-control me-2" type="search" placeholder="Search" name="search_data">
          <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_service">
        </form>
      </div>
    </div>
  </nav>

  <!-- Welcome + Login/Logout -->
  <nav class="navbar navbar-expand-lg">
    <ul class="navbar-nav me-auto">
      <?php if(!isset($_SESSION['username'])) {
        echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome Guest</a></li>";
      } else {
        echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a></li>";
      }
      if(!isset($_SESSION['username'])) {
        echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_login.php'>Login</a></li>";
      } else {
        echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_logout.php'>Logout</a></li>";
      } ?>
    </ul>
  </nav>

  <!-- Hero Section -->
  <div class="text-center">
    <h3>Service</h3>
    <p>"Connecting Communities, One Service at a Time."</p>
  </div>

  <!-- Main Content -->
  <div class="row px-3">
    <div class="col-md-10">
      <div class="row">
        <?php
          getservice();
          get_uniqe_categorires();
          get_uniqe_shopname();
        ?>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-2">
      <ul class="navbar-nav text-center">
        <li class="nav-item"><h4 class="nav-link">Shop Name</h4></li>
        <?php getshopname(); ?>
        <li class="nav-item"><h4 class="nav-link">Categories</h4></li>
        <?php getcategory(); ?>
      </ul>
    </div>
  </div>

  <!-- Footer -->
  <?php include("./includes/footer.php"); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>