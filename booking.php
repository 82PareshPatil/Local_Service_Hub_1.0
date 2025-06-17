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
     <link rel="icon" href="logo1.png">
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
.col-2 {
    margin-bottom:15px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
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
    width: 300px;
    height: 300px;
    
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
/* ---------- SUMMARY WRAPPER ---------- */
.lsh-bk-summary{
  background: var(--theme-input-bg);
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 8px 20px rgba(0,0,0,.12);
  transition: background .3s,color .3s;
}

.lsh-bk-summary-title{font-size:1.4rem;margin-bottom:.5rem;}

.lsh-bk-hr{
  border:0;
  height:2px;
  background: linear-gradient(90deg,var(--theme-accent),transparent);
  opacity:.6;
  margin:1rem 0 1.5rem;
  animation: slideBar 3s linear infinite;
}

@keyframes slideBar{
  0%{background-position-x:0;}
  100%{background-position-x:200%;}
}

/* ---------- FORM CONTROLS ---------- */
.lsh-bk-select,
.lsh-bk-input{
  width:100%;
  padding:.6rem .8rem;
  margin-bottom:1rem;
  border:1px solid #ccc;
  background: var(--theme-bg);
  border-radius:.4rem;
  transition:background .3s,border .3s;
}
.lsh-bk-input:focus,
.lsh-bk-select:focus{
  outline:none;
  border-color: var(--theme-accent);
}

/* ---------- TOTAL ROW ---------- */
.lsh-bk-total{
  font-size:1.15rem;
  font-weight:700;
  display:flex;
  justify-content:space-between;
  border-top:1px solid #bbb;
  padding-top:1rem;
  margin-top:.5rem;
}

/* ---------- CTA BUTTONS ---------- */
.lsh-bk-btn,
.lsh-bk-btn-outline{
  display:inline-block;
  text-align:center;
  padding:.8rem 1.2rem;
  font-weight:700;
  border-radius:30px;
  text-decoration:none;
  transition:all .3s ease;
}
/* ==== THEME VARIABLES ==== */
:root{
  --theme-bg:#ffffff;
  --theme-text:#212529;
  --theme-card:#f8f9fa;
  --theme-accent:blueviolet;
  --theme-btn-bg:blueviolet;
  --theme-btn-text:#ffffff;
  --theme-input-bg:#f7f7f7;
}

/* Dark mode overrides */
body.dark-mode{
  --theme-bg:#212529;
  --theme-text:#f1f1f1;
  --theme-card:#2e2e2e;
  --theme-accent:#8a2be2;
  --theme-btn-bg:#8a2be2;
  --theme-btn-text:#ffffff;
  --theme-input-bg:#3a3a3a;
}

/* ==== APPLY VARIABLES TO GLOBAL ELEMENTS ==== */
body{
  background:var(--theme-bg);
  color:var(--theme-text);
  transition:background .3s,color .3s;
}

/* Example of existing containers that need variable colours */
.card, .cart, .summary, .lsh-bk-summary{
  background:var(--theme-card);
  color:var(--theme-text);
}

/* Inputs & selects (already use var in .lsh‑bk‑input/select); add fallback */
input, select{background:var(--theme-input-bg); color:var(--theme-text);}

/* Theme‑toggle button */
#themeToggle{
  position:fixed;
  right:1rem;
  bottom:1rem;
  z-index:999;
  width:48px; height:48px;
  border:none; border-radius:50%;
  background:var(--theme-accent);
  color:#fff;
  font-size:1.2rem;
  display:flex; align-items:center; justify-content:center;
  box-shadow:0 4px 12px rgba(0,0,0,.25);
  cursor:pointer;
  transition:transform .3s ease, background .3s ease;
}
#themeToggle:hover{transform:scale(1.1);}

/* Filled gradient */
.lsh-bk-btn{
  background:linear-gradient(135deg,blueviolet,#212529);
  color:#fff;
  box-shadow:0 6px 15px rgba(0,0,0,.25);
}
.lsh-bk-btn:hover{
  transform:translateY(-3px) scale(1.02);
  box-shadow:0 10px 20px rgba(0,0,0,.3);
}

/* Outline variant */
.lsh-bk-btn-outline{
  background:transparent;
  color:var(--theme-accent);
  border:2px solid var(--theme-accent);
}
.lsh-bk-btn-outline:hover{
  background:var(--theme-accent);
  color:#fff;
}

/* ---------- RESPONSIVE ---------- */
@media(max-width:767px){
  .lsh-bk-summary{border-radius:1rem;margin-top:2rem;}
}
.service-title {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 10px;
  text-transform: capitalize;
}

[data-theme="light"] .service-title {
  color: #212529;
}

[data-theme="dark"] .service-title {
  color: #f1f1f1;
}

.service-title {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 10px;
  text-transform: capitalize;
  color: var(--text-color); /* uses theme variable */
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
    <button id="themeToggle" aria-label="Toggle theme">🌙</button>

    <!--first child-->

<!--fourth child-->

<div class="card mb-5 my-5">
    <div class="row">
        <div class="col-md-12 cart">
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
                            <div class="col-2">
                         <img class="img-fluid" src="admin_area/service_images/<?php echo $service_image1; ?>">  
                     <!--    <img class="img-fluid" src="../LocalServiceHub/admin_area/service_images/<?php echo $service_image1; ?>">
    <!-- Debug output to see the image URL 
    <?php echo "../LocalServiceHub/admin_area/service_images/" . $service_image1; ?>    -->
                            </div>
                            <div class="col">
                                <div class="row service-title">
  <?php echo $service_title; ?>
</div>


                            </div>
                            
    <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
    <div class="col">

       <input type="text" name="quantity" placeholder="Quantity"
    style="width: 50%; padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f8f9fa; color: #212529; font-weight: 500; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1); transition: all 0.3s ease;">

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
<!-- Update Button -->
<input 
    type="submit" 
    value="Update" 
    name="update_quantity"
    style="
        background-color: blueviolet;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 30px;
        font-weight: bold;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin: 5px;
    "
    onmouseover="this.style.backgroundColor='#6a0dad'"
    onmouseout="this.style.backgroundColor='blueviolet'"
>

<!-- Checkbox + Remove Button -->
<input 
    type="checkbox" 
    name="removeitem[]" 
    value="<?php echo $service_id ?>" 
    style="
        transform: scale(1.2); 
        margin-right: 10px; 
        cursor: pointer;
    "
>

<input 
    type="submit" 
    value="&#10005;" 
    name="remove_cart"
    style="
        background-color: crimson;
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 30px;
        font-weight: bold;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin: 5px;
    "
    onmouseover="this.style.backgroundColor='#a80000'"
    onmouseout="this.style.backgroundColor='crimson'"
>





    <?php 
                    } // end while
                }
                // end while 
                else{
                    echo "<h2 class='text-center text-danger'>Not Booking Available Yet!</h2>";
                }?>
    </div>
            <div class="back-to-shop" style="margin-top: 3rem; text-align: center;">
  <a href="index.php" 
     style="
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, blueviolet, #212529);
        color: white;
        text-decoration: none;
        border-radius: 30px;
        font-weight: bold;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      "
     onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 12px 20px rgba(0,0,0,0.3)'"
     onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.2)'"
  >
    &larr; Back to Shop
  </a>
</div>

<div class="lsh-bk-summary">

  <h5 class="lsh-bk-summary-title"><b>Summary</b></h5>
  <hr class="lsh-bk-hr">

  <div class="lsh-bk-count"><?php echo $number_of_services; ?> Services</div>

  <form class="lsh-bk-code-form">
      <p class="mb-1">SHIPPING</p>
      <select class="lsh-bk-select">
          <option>Charges – ₹ 0.00</option>
      </select>

      <p class="mb-1">GIVE CODE</p>
      <input id="code" class="lsh-bk-input" placeholder="Enter your code">
  </form>

  <div class="lsh-bk-total">
      <span>TOTAL PRICE:</span>
      <span>₹ <?php echo $total; ?>/-</span>
  </div>

  <?php
    if($number_of_services>0){
        echo "<a href='./users_area/checkout.php'
                 class='lsh-bk-btn w-100 mt-2'>CHECKOUT</a>";
    }else{
        echo "<a href='index.php'
                 class='lsh-bk-btn-outline w-100 mt-2'>&larr; Go to Service Section</a>";
    }
  ?>
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


<script>
  const btn = document.getElementById('themeToggle');

  // Apply saved preference on load
  (function(){
    if(localStorage.getItem('theme') === 'dark'){
      document.body.classList.add('dark-mode');
      btn.textContent = '☀️';
    }
  })();

  // Toggle on click
  btn.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    btn.textContent = isDark ? '☀️' : '🌙';
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
  });
</script>
