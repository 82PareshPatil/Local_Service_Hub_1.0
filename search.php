<!--connect php-->

<?php
include('includes/connect.php');
include('./function/comman_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Service Hub</title>
    <!--css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--css file-->
  <link rel="stylesheet" href="style.css">
</head>
<body>
<!--navbar-->
<div class="container-fluid p-0">
    
    <!--first child-->
<nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid">
    <img src="./image/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display.php">Service</a>
        </li>
        <?php
         if(isset($_SESSION['username']))
         {
          echo  " <li class='nav-item'>
          <a class='nav-link' href='./users_area/profile.php'>My Account</a>
        </li>";
         }
         else
         {
         echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
        </li>";
         }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="booking.php">Booking <i class="fa-solid fa-person"></i><sup><?php cart_item(); ?></sup></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php total_booking_price(); ?>/-</a>
        </li>
       
      </ul>

      <form class="d-flex"  action="" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
    <!--    <button class="btn btn-outline-light" type="submit">Search</button>  -->
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_service">
      </form>
    </div>
  </div>
</nav>
<!--second child-->
<nav class="navbar navbar-expand-lg navbar-bright bg-secondary">
    <ul class="navbar-nav me-auto">
    
        <?php
        // welcome guest
        if(!isset($_SESSION['username']))
        {
           echo "<li class='nav-item'>
           <a class='nav-link' href='#'>Welcome Guest</a>
         </li>  ";
        }
        else{
         echo "<li class='nav-item'>
           <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
         </li> "; 
        }
             if(!isset($_SESSION['username']))
             {
                echo "<li class='nav-item'>
                <a class='nav-link' href='./users_area/user_login.php'>Login</a>
              </li> "; 
             }
             else{
              echo "<li class='nav-item'>
                <a class='nav-link' href='./users_area/user_logout.php'>Logout</a>
              </li> "; 
             }
       ?>
    </ul>
</nav>
<!--card details-->
<?php
 cart();
?>
<!--third child-->

<div class="bg-light">
    <h3 class="text-center">Service</h3>
    <p class="text-center">"Connecting Communities, One Service at a Time."</p>
</div>

<!--fourth child-->

<div class="row px-3">
    <div class="col-md-10">
     <!--service-->
    <div class="row">
      
<!--fetching service-->
    <?php
    // calling function
    search_service();
     get_uniqe_categorires();
     get_uniqe_shopname();
    ?>

        

<!--row end-->
</div>
<!--col end-->
         <!--sidenav-->

    </div>

    <div class="col-md-2 bg-secondary p-0">
        <!--shop name-->

       <ul class="navbar-nav me-auto text-center">
        <li class="nav-iteam bg-info">
            <a href="#" class="nav-link text-light"><h4>Shop Name</h4></a>
        </li>

        <?php
    getshopname();
?>   
       </ul>
       <!--category-->


       <ul class="navbar-nav me-auto text-center">
        <li class="nav-iteam bg-info">
            <a href="#" class="nav-link text-light"><h4>categories</h4></a>
        </li>
        <?php
    getcategory();
?>

       </ul>
        </div>
</div>
<!--last child-->
<!--include footer-->
<?php
include("./includes/footer.php")
?>
</div>

    <!--javascript-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>