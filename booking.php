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
    <title>Local Service Hub:-Booking Section</title>
    <!--css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--css file-->
  <link rel="stylesheet" href="style.css">
  <style>
    body{
    background: #ddd;
    min-height: 100vh;
    vertical-align: middle;
    display: flex;
    font-family: sans-serif;
    font-size: 0.8rem;
    font-weight: bold;
}
.title{
    margin-bottom: 5vh;
}
.card{
    margin: auto;
    margin-bottom: 15px;
    max-width: 950px;
    width: 90%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent;
}
@media(max-width:767px){
    .card{
        margin: 3vh auto;
    }
}
.cart{
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem;
}
@media(max-width:767px){
    .cart{
        padding: 4vh;
        border-bottom-left-radius: unset;
        border-top-right-radius: 1rem;
    }
}
.summary{
    background-color: #ddd;
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color: rgb(65, 65, 65);
}
@media(max-width:767px){
    .summary{
    border-top-right-radius: unset;
    border-bottom-left-radius: 1rem;
    }
}
.summary .col-2{
    padding: 0;
}
.summary .col-10
{
    padding: 0;
}.row{
    margin: 0;
}
.title b{
    font-size: 1.5rem;
}
.main{
    margin: 0;
    padding: 2vh 0;
    width: 100%;
}
.col-2, .col{
    padding: 0 1vh;
}

a{
    padding: 0 1vh;
}
.close{
    margin-left: auto;
    font-size: 0.7rem;
}
img{
    width: 3.5rem;
}
.img-fluid{
    width: 100px;
    height: 100px;
    
}
.back-to-shop{
    margin-top: 4.5rem;
}
h5{
    margin-top: 4vh;
}
hr{
    margin-top: 1.25rem;
}
form{
    padding: 2vh 0;
}
select{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input:focus::-webkit-input-placeholder
{
      color:transparent;
}
.btn{
    background-color: echo;
    border-color: #000;
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 0;
    color:light; 
    text-decoration:none;
}
.btn:focus{
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
   
    transition: none; 
}
.btn:hover{
    color: white;
}
a{
    color: black; 
}
a:hover{
    color: black;
    text-decoration: none;
}
 #code{
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center;
}
  </style>
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

       
       
      </ul>
    </div>
  </div>
</nav>

<!--calling cart function-->
<?php
cart();
?>
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

<!--third child-->

<div class="bg-light">
    <h3 class="text-center">Service</h3>
    <p class="text-center">"Connecting Communities, One Service at a Time."</p>
</div>

<!--fourth child-->

<div class="card mb-5 my-5">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <form action="" method="post">
                    <div class="col"><h4><b>Booking</b></h4></div>
                </div>
            </div>
            <div class="row border-top border-bottom">
                <?php
                global $con;
                $get_ip_add = getIPAddress();
                $total = 0;
                $booking_query = "SELECT * FROM `card_details` WHERE ip_address='$get_ip_add'";
                $result = mysqli_query($con, $booking_query);
                $number_of_services = mysqli_num_rows($result);
                 if($number_of_services>0)
                 {

                 
                while($row = mysqli_fetch_array($result)) {
                    $service_id = $row['service_id'];
                    $select_service = "SELECT * FROM `service` WHERE service_id='$service_id'";
                    $result_service = mysqli_query($con, $select_service);
                    $number_of_services = mysqli_num_rows($result);

                    while($row_service_cost = mysqli_fetch_array($result_service)) {
                        $service_cost = $row_service_cost['service_cost'];
                        $cost_table = $row_service_cost['service_cost'];
                        $service_title = $row_service_cost['service_title'];
                        $service_image1 = $row_service_cost['service_image1'];
                        $total += $service_cost;
                        ?>
                        <div class="row main align-items-center">
                            <div class="col-2"><img class="img-fluid" src="../LocalServiceHub/admin_area/service_images/<?php echo $service_image1; ?>"></div>
                            <div class="col">
                                <div class="row"><?php echo $service_title; ?></div>
                            </div>
                            
    <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
    <div class="col">

        <input type="text" name="quantity" class="form-control w-50" placeholder="Quantity">
    </div>
    
    <div class="row main align-items-center">
        <!-- your existing code -->
    </div>
    <?php
if(isset($_POST['update_quantity']))
{
    $quantity = intval($_POST['quantity']); // Cast to integer
    $update_cart = "UPDATE `card_details` SET quantity = $quantity WHERE ip_address = '$get_ip_add'";
    $result_service1 = mysqli_query($con, $update_cart);
    $total = $total * $quantity;
}

}

?>

    <input type="submit" value="Update" class="px-3 py-2 border-0 mx-3" name="update_quantity">
    <input type="checkbox" name="removeitem[]" value="<?php echo $service_id ?>">
<input type="submit" value="&#10005;" class="px-3 py-2 border-0 mx-3 bg-info" name="remove_cart">
    





    <?php 
                    } // end while
                }
                // end while 
                else{
                    echo "<h2 class='text-center text-danger'>Not Booking Available Yet!</h2>";
                }?>
            </div>
            <div class="back-to-shop"><a href="index.php">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
        </div>
        <div class="col-md-4 summary">
            <div><h5><b>Summary</b></h5></div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0; font-size:20px;"><?php echo $number_of_services; ?> Services</div>
            </div>
            <form>
                <p>SHIPPING</p>
                <select><option class="text-muted">Charges- ₹. 00.00</option></select>
                <p>GIVE CODE</p>
                <input id="code" placeholder="Enter your code">
            </form>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col" style="padding-left:0; font-size:20px;">TOTAL PRICE:</div>
                <div class="col text-right" style="padding-left:0; font-size:20px;">₹. <?php echo $total; ?>/-</div>
            </div>
            <?php
                global $con;
                $get_ip_add = getIPAddress();
                $total = 0;
                $booking_query = "SELECT * FROM `card_details` WHERE ip_address='$get_ip_add'";
                $result = mysqli_query($con, $booking_query);
                $number_of_services = mysqli_num_rows($result);
                if($number_of_services>0)
                {
                    echo "<button class='btn bg-secondary'><a href='./users_area/checkout.php'>CHECKOUT</a></button>";
                }
                else{
                  echo  "<button class='btn'><a href='index.php'>&leftarrow;</a><span>Go to Service Section</span>";
                }
                ?>
            
        </div>
    </div>
</div>
</form>
 <!-- function to remove data -->    
 <?php   
 function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart']))
    {
        echo "Remove cart button clicked"; // Debugging statement
        foreach($_POST['removeitem'] as $remove_id){
            echo "Removing item with ID: $remove_id"; // Debugging statement
            $delete_query="DELETE FROM `card_details` WHERE service_id=$remove_id";
            $run_delete=mysqli_query($con,$delete_query);
            if($run_delete)
            {
                echo "Item deleted successfully"; // Debugging statement
                echo "<script>window.open('booking.php','_self')</script>";
            } else {
                echo "Error deleting item: " . mysqli_error($con); // Debugging statement
            }
        }
    }
}
remove_cart_item();
?>
<!-- <div class="container">
    <div class="row">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Service Title</th>
                    <th>Service Image</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
                    <th>Remove</th>
                    <th colspan="2">Operations</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Doctor</td>

                    <td><img src="../LocalServiceHub/admin_area/service_images/A doctor talks with a patient in his consultation  (1).jpg" alt="" height="100px" width="100px"></td>
                    <td><input type="text"></td>
                    <td>250/-</td>
                    <td><input type="text" name="" id=""></td>
                    <td>
                        <button bg-info px-3 py-2 border-0 mx-3>Update</button>
                        <button bg-info px-3 py-2 border-0 mx-3>Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>
        Subtotal
        <div class="d-flex mb-5">
            <h4 class="px-3">Total:<strong class="text-info">250/-</strong></h4>
            <a href="index.php"><button class="bg-info px-3 py-2 border-0 mx-3">Cheak Another Service</button></a>
            <a href="#"><button class="bg-secondary px-3 py-2 border-0 text-light">Chekout</button></a>

        </div>
    </div>
</div> -->
<!--last child-->

<!--include footer-->
<?php
include("./includes/footer.php")
?>
 
</div>
</div>


    <!--javascript-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>