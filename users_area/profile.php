<!-- PHP Connection and Session -->
<?php
include('../includes/connect.php');
include('../function/comman_function.php');
session_start();
cart();
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Service Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root[data-theme="dark"] {
            --bg-color: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            --text-color: #ffffff;
            --card-bg: #1e1e2f;
            --link-color: #8a2be2;
        }
        :root[data-theme="light"] {
            --bg-color: #ffffff;
            --text-color: #000000;
            --card-bg: #f8f9fa;
            --link-color: #5b2eff;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            overflow-x: hidden;
            transition: background 0.3s, color 0.3s;
        }
        .navbar {
            background: rgba(12, 10, 50, 0.95);
        }
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            background: radial-gradient(circle at top left, #5b2eff, #8a2be2);
            color: #fff;
        }
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
        }
        .hero p {
            font-size: 1.2rem;
        }
        .hero .btn {
            margin-top: 20px;
            background-color: #8a2be2;
            border: none;
            color: #fff;
        }
        .section {
            padding: 60px 20px;
        }
        .card {
            background: var(--card-bg);
            border: none;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card i {
            font-size: 2rem;
            color: var(--link-color);
        }
        .footer {
            background: #0f0c29;
            padding: 30px;
            text-align: center;
        }
        a {
            color: var(--link-color);
            text-decoration: none;
        }
        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--link-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 30px;
            cursor: pointer;
            z-index: 1000;
        }
        /* Fix text color in all modes */
       
     
        .card h5,
        p.card-text,
        .theme-toggle {
            color: var(--text-color) !important;
        }
        .search-bar {
            margin-left: 20px;
        }
       
/* --- Card Container --- */
.card1 {
  display: flex;
  flex-direction: row;
  background-color: #212529;
  color: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
  margin: 20px auto;
  max-width: 900px;
}

/* --- Mobile Stacking --- */
@media (max-width: 768px) {
  .card1 {
    flex-direction: column;
  }
}

/* --- Slider Section --- */
.slider {
  flex: 1;
  position: relative;
  max-width: 100%;
  overflow: hidden;
}
.slides {
  display: flex;
  width: 300%;
  transition: transform 1s ease;
}
.slide {
  width: 100%;
  flex-shrink: 0;
  height: 100%;
}
.slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-right: 2px solid #111;
}

/* --- Navigation --- */
.navigation-manual, .navigation-auto {
  position: absolute;
  width: 100%;
  bottom: 15px;
  display: flex;
  justify-content: center;
  gap: 10px;
  z-index: 10;
}
.manual-btn, .auto-btn1, .auto-btn2, .auto-btn3 {
  border: 2px solid white;
  padding: 5px;
  border-radius: 50%;
  cursor: pointer;
  background-color: #6f42c1;
}

input[type="radio"] {
  display: none;
}

/* --- Card Body --- */
.card-body {
  flex: 1;
  padding: 20px;
}
.card-title {
  font-size: 24px;
  color: #fff;
  font-weight: bold;
}
.card-text {
  margin: 8px 0;
  color: #ccc;
}
.badge {
  background-color: #6f42c1;
  color: white;
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 12px;
  margin-right: 6px;
}
.rating {
  color: gold;
  font-size: 16px;
  margin-right: 10px;
}
.heart {
  color: #6f42c1;
  font-size: 16px;
}
.book-btn {
  background-color: #6f42c1;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 10px;
  margin-top: 15px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.book-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 0 10px #6f42c1;
}

/* ====================  SERVICE‑CARD  ==================== */
.lsh-sc-card{
    position:relative;
    height:400px;
    width:100%;
    margin:10px 0;
    perspective:1200px;
    transition:ease all 2.3s;
    overflow:hidden;
    box-shadow:20px 20px 60px #00000041, inset -20px -20px 60px #ffffff40;
}

.lsh-sc-inner{
    position:relative;
    height:100%;
    width:100%;
    transition:transform 1.2s ease;
    transform-style:preserve-3d;
    box-shadow:inherit;
}

/* flip on hover */
.lsh-sc-card:hover .lsh-sc-inner{ transform:rotateY(180deg); }

/* -------- Front -------- */
.lsh-sc-front{
    position:absolute;
    inset:0;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    backface-visibility:hidden;
    background:#000;
    box-shadow:inherit;
}

.lsh-sc-img{
    height:100%;
    width:100%;
    object-fit:cover;
}

.lsh-sc-title{
    position:absolute;
    bottom:10px;
    left:10px;
    width:calc(100% - 20px);
    margin:0;
    padding:5px 10px;
    font-size:1.8em;
    font-weight:600;
    text-align:center;
    color:rgba(0,0,0,0.8);
    background:#fff;
}

.lsh-sc-card:hover .lsh-sc-title{ visibility:hidden; }

/* -------- Back -------- */
.lsh-sc-back{
    position:absolute;
    inset:0;
    padding:20px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    background:#232323;
    color:#fff;
    transform:rotateY(180deg);
    backface-visibility:visible;
    opacity:0;
    transition:opacity .5s ease;
    box-shadow:inherit;
}

.lsh-sc-card:hover .lsh-sc-back{ opacity:1; }

.lsh-sc-text{
    margin:10px 0;
    font-size:1.1em;
    font-weight:200;
}

/* optional – unify btn look inside card */
.lsh-sc-back a.btn{
    background:transparent;
    border:1px solid #fff;
    font-weight:200;
    font-size:1.1em;
    color:#fff;
    padding:10px 20px;
    margin-top:10px;
    transition:background .5s ease,color .5s ease;
}

.lsh-sc-back a.btn:hover{
    background:#fff;
    color:#000;
}
/* ==========  PROFILE WRAPPER  ========== */
.lsh-pr-wrapper{
  min-height:100vh;
  background:radial-gradient(at top left,#202245,#15162e);
  color:#f5f5f7;
  overflow:hidden;
}

/* ==========  SIDEBAR  ========== */
.lsh-pr-sidebar{
  width:260px;
  background:rgba(255,255,255,0.04);
  backdrop-filter:blur(14px);
  box-shadow:0 8px 32px rgba(0,0,0,.4);
  padding:2rem 1.5rem;
  display:flex;
  flex-direction:column;
  position:relative;
  transition:transform .4s ease;
}

.lsh-pr-brand{
  font-size:1.6rem;
  font-weight:600;
  margin-bottom:1.5rem;
  color:#00e6ff;
}

.lsh-pr-avatar{
  width:150px;height:150px;
  border-radius:50%;
  overflow:hidden;
  align-self:center;
  box-shadow:0 0 15px rgba(0,0,0,.35);
}
.lsh-pr-avatar img{width:100%;height:100%;object-fit:cover;}

.lsh-pr-nav{margin-top:2rem;display:flex;flex-direction:column;gap:1rem;}
.lsh-pr-link{
  color:#e0e0f0;
  text-decoration:none;
  font-weight:500;
  padding:.6rem 1rem;
  border-radius:10px;
  transition:background .25s;
}
.lsh-pr-link:hover{
  background:rgba(124,77,255,.15);
}

/* =========  TOGGLE (hamburger)  ========= */
.lsh-pr-toggle{
  position:absolute;
  top:1rem; right:1rem;
  background:transparent;
  border:none;
  color:#fff;
  font-size:1.6rem;
  display:none;
  cursor:pointer;
}

/* ==========  CONTENT  ========== */
.lsh-pr-content{
  padding:2rem 2.5rem;
  width:100%;
}

/* ==========  RESPONSIVE  ========== */
@media(max-width:767.98px){
  .lsh-pr-sidebar{
    position:fixed;
    top:0;left:0;height:100vh;
    transform:translateX(-100%);
    z-index:1045;
  }
  body.pr-open .lsh-pr-sidebar{transform:translateX(0);}
  .lsh-pr-toggle{display:block;}
  .lsh-pr-content{padding:1.5rem;}
}
.lsh-pr-username {
  text-align: center;
  font-size: 1.1rem;
  font-weight: 500;
  color: #e0e0f0;
  margin-top: 0.5rem;
  margin-bottom: 1.5rem;
  word-break: break-word;
}
/* =====  MOBILE HAMBURGER  ===== */
.lsh-pr-hamburger{
  position:fixed;
  top:90px;       
  left:15px;
  background:#6f42c1;
  color:#fff;
  border:none;
  font-size:1.6rem;
  line-height:1;
  padding:6px 12px;
  border-radius:8px;
  z-index:1050;
  box-shadow:0 4px 10px rgba(0,0,0,.3);
  transition:left .4s ease;
}
body.pr-open .lsh-pr-hamburger{ left:275px; } 

@media(min-width:768px){
  .lsh-pr-hamburger{display:none;} 
}

/* =====  SIDEBAR (unchanged except toggle button काढलं)  ===== */
.lsh-pr-toggle{ display:none !important; }    
/* ===== Booking Table ===== */
.lsh-bk-tbl-title{
  font-size:1.8rem;
  font-weight:600;
  color:#00e676;
  margin:2rem 0 1.5rem;
  text-align:center;
}

/* wrapper → horizontal scroll on very small screens */
.lsh-bk-tbl-wrapper{
  width:100%;
  overflow-x:auto;
  border-radius:12px;
  box-shadow:0 4px 20px rgba(0,0,0,.35);
}

/* table base */
.lsh-bk-tbl{
  width:100%;
  border-collapse:collapse;
  min-width:700px; /* keeps columns readable; wrapper scrolls if <700 */
  background:rgba(255,255,255,0.04);
  backdrop-filter:blur(12px);
}

.lsh-bk-tbl th,
.lsh-bk-tbl td{
  padding:.9rem 1rem;
  text-align:center;
  color:#f5f5f7;
}

.lsh-bk-tbl thead{
  background:rgba(124,77,255,.25);
}

.lsh-bk-tbl tbody tr:nth-of-type(even){
  background:rgba(255,255,255,0.03);
}

.lsh-bk-tbl tbody tr:hover{
  background:rgba(124,77,255,.12);
}

/* status badge */
.lsh-bk-tbl td.paid{
  color:#00e676;
  font-weight:600;
}

/* confirm link */
.confirm-link{
  color:#ffb74d;
  font-weight:600;
  text-decoration:none;
  transition:color .2s;
}
.confirm-link:hover{ color:#ffd08b; }

/* ---------- Responsive tweaks ---------- */
@media (max-width:575.98px){
  .lsh-bk-tbl-title{font-size:1.4rem;}
  .lsh-bk-tbl th,.lsh-bk-tbl td{padding:.65rem .6rem;font-size:.85rem;}
}

    </style>
</head>
<body>
  <button class="lsh-pr-hamburger d-md-none" onclick="document.body.classList.toggle('pr-open')">
  😊
</button>

    <button class="theme-toggle" onclick="toggleTheme()">Switch Theme</button>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../image/logo.png" alt="Local Service Hub Logo" style="height: 70px;">
            </a>
        <form class="d-flex"  action="../search.php" method="get">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
    <!--    <button class="btn btn-outline-light" type="submit">Search</button>  -->
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_service">
      </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../display.php">Services</a></li>
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='profile.php'>My Account</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='user_registration.php'>Register</a></li>";
                    }
                    ?>
      <li class="nav-item">
          <a class="nav-link" href="../booking.php">Booking <i class="fa-solid fa-person"></i><sup><?php cart_item(); ?></sup></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php total_booking_price(); ?>/-</a>
        </li>
                    <li class="nav-item">
                        <?php
                        if (!isset($_SESSION['username'])) {
                            echo "<a class='nav-link' href='user_login.php'>Login</a>";
                        } else {
                            echo "<a class='nav-link' href='user_logout.php'>Logout</a>";
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->

<div class="lsh-pr-wrapper d-flex">

  <!-- =========  SIDEBAR  ========= -->
  <aside class="lsh-pr-sidebar">

    <div class="lsh-pr-brand"></div>

    <?php
      $username = $_SESSION['username'];
      $user_res = mysqli_query($con,"SELECT user_image FROM `user_table` WHERE user_name='$username'");
      $user_image = mysqli_fetch_assoc($user_res)['user_image'];
        
       echo "
    <div class='lsh-pr-avatar mb-3'>
      <img src='./user_images/$user_image' alt='profile image'>
    </div>
    <div class='lsh-pr-username'>$username</div>
  ";
?>

    <nav class="lsh-pr-nav">
      <a href="profile.php"                class="lsh-pr-link">Pending Bookings</a>
      <a href="profile.php?edit_account"  class="lsh-pr-link">Edit Account</a>
      <a href="profile.php?my_bookings"   class="lsh-pr-link">My Bookings</a>
      <a href="profile.php?delete_account" class="lsh-pr-link">Delete Account</a>
      <a href="user_logout.php"           class="lsh-pr-link">Logout</a>
    </nav>

    <!-- Hamburger (mobile) -->
    <button class="lsh-pr-toggle d-md-none" onclick="document.body.classList.toggle('pr-open')">
      ☰
    </button>
    
  </aside>

  <!-- =========  MAIN CONTENT  ========= -->
  <main class="lsh-pr-content flex-grow-1">
    <?php
      get_user_order_details();
      if(isset($_GET['edit_account']))   include('edit_account.php');
      if(isset($_GET['my_bookings']))    include('my_bookings.php');
      if(isset($_GET['delete_account'])) include('delete_account.php');
    ?>
  </main>

</div>

<!--last child-->
<!--include footer-->
  <footer class="footer">
        <p>&copy; 2025 Local Service Hub | <a href="./users_area/user_registration.php">Register</a> | <a href="./users_area/user_login.php">Login</a></p>
        <div>
            <a href="#"><i class="fab fa-facebook mx-2"></i></a>
            <a href="#"><i class="fab fa-instagram mx-2"></i></a>
            <a href="#"><i class="fab fa-twitter mx-2"></i></a>
        </div>
    </footer>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const current = html.getAttribute('data-theme');
            html.setAttribute('data-theme', current === 'dark' ? 'light' : 'dark');
        }
    </script>
    <script>
let counter = 0;
let slideInterval = setInterval(() => {
  const slides = document.querySelector('.slides');
  counter = (counter + 1) % 3;
  slides.style.transform = `translateX(-${counter * 100}%)`;
}, 5000);
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
