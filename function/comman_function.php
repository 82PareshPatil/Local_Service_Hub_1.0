<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper@10/swiper-bundle.min.css"/>

  <style>
      /* Custom Wrapper */
      .custom-card-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
           margin: 10px;
            
        }

        /* Card Styling */
        .custom-card {
            position: relative;
            width: 100%;
            max-width: 700px;
            padding: 20px;
            border-radius: 20px;
            background: linear-gradient(135deg,rgb(110, 61, 148)  , #6a5acd);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(10px);
            /* -webkit-backdrop-filter: blur(10px); */
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #fff;
            /* text-align: center; */
            overflow: hidden; /* Hide images that go outside the card */
        }
.swiper-pagination {
            margin-top: 25px;
            position: relative;
        }
        /* Image Slider inside Card */
        .custom-card-swiper-container {
            width: 100%;
            padding: 10px 0;
        }

        .custom-card-swiper-slide {
            display: flex;
            justify-content: center;
            transition: opacity 0.5s ease; /* Smooth fade effect */
        }

        /* Image Styling */
        .custom-card img {
            width: 90%;
            height: auto;
            object-fit: cover;
            border: 2px solid #fff;
            border-radius: 15px;
        }

        /* Card Content */
        .custom-card h5 {
            font-size: 1.5rem;
            margin: 15px 0;
            font-weight: bold;
            color: yellowantiquewhite; /* Golden color */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
            text-align: center;
        }

        .custom-card p {
            padding: inherit;
            border-radius: 15px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            background: rgba(255, 255, 255, 0.25);
             margin-top: 40px;
            font-size: 1rem;
            margin-bottom: 10px;
            color: #f3f4f6;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
            line-height: 1.4;
        }

        .custom-card .custom-card-btn,
        .custom-card .custom-card-view-more {
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .custom-card .custom-card-btn:hover,
        .custom-card .custom-card-view-more:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .custom-card-swiper-container {
                overflow: hidden; /* Ensure overflow is hidden on small screens */
            }

            /* On smaller screens, show only one image at a time */
            .custom-card-swiper-container .custom-card-swiper-slide {
                opacity: 1; /* Ensure full opacity on mobile view */
            }
        }
  </style>
</head>
<body>

<?php
// including connect file
//include('./includes/connect.php');

// getting productes

function getservice()
{
    global $con;

    //condition to cheak isset or note

    if(!isset($_GET['category']))
    {
         if(!isset($_GET['shopname']))
         {
    
    $select_query="SELECT * FROM `service` order by rand() limit 0,12";
      $result_query=mysqli_query($con,$select_query);
     // $row=mysqli_fetch_assoc($result_query);
      //echo $row['service_title'];
      while($row=mysqli_fetch_assoc($result_query))
      {
        $service_id=$row['service_id'];
        $service_title=$row['service_title'];
        $description=$row['description'];
        $address=$row['address'];
        $category_id=$row['category_id'];
        $shop_id=$row['shop_id'];
        $service_image1=$row['service_image1'];
       $service_image2=$row['service_image2'];
       $service_image3=$row['service_image3'];
        $service_cost=$row['service_cost'];
        

      echo "
<div class='col-md-3 mb-3'>
  <div class='lsh-sc-card'>

    <div class='lsh-sc-inner'>
      <!-- Front -->
      <div class='lsh-sc-front'>
        <img src='./admin_area/service_images/$service_image1'
             class='lsh-sc-img' alt='$service_title'>
        <h5 class='lsh-sc-title'>$service_title</h5>
      </div>

      <!-- Back -->
      <div class='lsh-sc-back'>
        <p class='lsh-sc-text'>$description</p>
        <p class='lsh-sc-text'>Cost: $service_cost Rs/-</p>
        <a href='index.php?add_to_booking=$service_id' class='btn btn-info'>Booking</a>
        <a href='service_detail.php?service_id=$service_id' class='btn btn-secondary'>View More</a>
      </div>
    </div>

  </div>
</div>
";

         
        
      }
}
    }
}

// getting all service

function get_all_sevice()
{
    global $con;

    //condition to cheak isset or note

    if(!isset($_GET['category']))
    {
         if(!isset($_GET['shopname']))
         {
    
    $select_query="SELECT * FROM `service` order by rand()";
      $result_query=mysqli_query($con,$select_query);
     // $row=mysqli_fetch_assoc($result_query);
      //echo $row['service_title'];
      while($row=mysqli_fetch_assoc($result_query))
      {
        $service_id=$row['service_id'];
        $service_title=$row['service_title'];
        $description=$row['description'];
        $address=$row['address'];
        $category_id=$row['category_id'];
        $shop_id=$row['shop_id'];
        $service_image1=$row['service_image1'];
       $service_image2=$row['service_image2'];
       $service_image3=$row['service_image3'];
        $service_cost=$row['service_cost'];
        

        echo "
<div class='col-md-4 mb-2'>
  <div class='lsh-sc-card'>

    <div class='lsh-sc-inner'>
      <!-- Front -->
      <div class='lsh-sc-front'>
        <img src='./admin_area/service_images/$service_image1'
             class='lsh-sc-img' alt='$service_title'>
        <h5 class='lsh-sc-title'>$service_title</h5>
      </div>

      <!-- Back -->
      <div class='lsh-sc-back'>
        <p class='lsh-sc-text'>$description</p>
        <p class='lsh-sc-text'>Cost: $service_cost Rs/-</p>
        <a href='index.php?add_to_booking=$service_id'
           class='btn btn-info'>Booking</a>
        <a href='service_detail.php?service_id=$service_id'
           class='btn btn-secondary'>View More</a>
      </div>
    </div>

  </div>
</div>
";

        
      }
}
    }
}
// getting uniqe categories

function get_uniqe_categorires()
{
    global $con;

    //condition to cheak isset or note

    if(isset($_GET['category']))
    {
        $category_id=$_GET['category'];
    
    $select_query="SELECT * FROM `service` where category_id=$category_id";
      $result_query=mysqli_query($con,$select_query);
       $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0)
        {
            echo "<h2 class='text-center text-danger'>Service is not Available for Now!</h2>";
        }
     // $row=mysqli_fetch_assoc($result_query);
      //echo $row['service_title'];
    //  echo "<h2 class='text-center '>$num_of_rows Service Availbale.</h2>";
      while($row=mysqli_fetch_assoc($result_query))
      {
        
        $service_id=$row['service_id'];
        $service_title=$row['service_title'];
        $description=$row['description'];
        $address=$row['address'];
        $category_id=$row['category_id'];
        $shop_id=$row['shop_id'];
        $service_image1=$row['service_image1'];
       $service_image2=$row['service_image2'];
       $service_image3=$row['service_image3'];
        $service_cost=$row['service_cost'];
        
        echo "
        
         <div class='col-md-4 mb-2'>
  <div class='card'>
    
    <div class='card-inner'>
      <!-- Front of the card (Image and Title) -->
      <div class='card-front'>
      <img src='./admin_area/service_images/$service_image1' class='card-img-top' alt='$service_title'>
     
      <h5>$service_title</h5>
      </div>

      <!-- Back of the card (Details) -->
      <div class='card-back'>
        <p class='card-text'>$description</p>
        <p class='card-text'>Cost: $service_cost Rs/-</p>
        <a href='index.php?add_to_booking=$service_id' class='btn btn-info'>Booking</a>
        <a href='service_detail.php?service_id=$service_id' class='btn btn-secondary'>View More</a>
      </div>
    </div>

  </div>
</div>
";
      }
}
    }



    // getting uniqe shopname

function get_uniqe_shopname()
{
    global $con;

    //condition to cheak isset or note

    if(isset($_GET['shopname']))
    {
        $shopname_id=$_GET['shopname'];
    
    $select_query="SELECT * FROM `service` where shop_id=$shopname_id";
      $result_query=mysqli_query($con,$select_query);
       $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0)
        {
            echo "<h2 class='text-center text-danger'>This Shop Is Not Available For Service!</h2>";
        }
     // $row=mysqli_fetch_assoc($result_query);
      //echo $row['service_title'];
    //  echo "<h2 class='text-center '>$num_of_rows Service Availbale.</h2>";
      while($row=mysqli_fetch_assoc($result_query))
      {
        
        $service_id=$row['service_id'];
        $service_title=$row['service_title'];
        $description=$row['description'];
        $address=$row['address'];
        $category_id=$row['category_id'];
        $shop_id=$row['shop_id'];
        $service_image1=$row['service_image1'];
       $service_image2=$row['service_image2'];
       $service_image3=$row['service_image3'];
        $service_cost=$row['service_cost'];
        

        echo "
        
        <div class='col-md-4 mb-2'>
 <div class='card'>
   
   <div class='card-inner'>
     <!-- Front of the card (Image and Title) -->
     <div class='card-front'>
     <img src='./admin_area/service_images/$service_image1' class='card-img-top' alt='$service_title'>
    
     <h5>$service_title</h5>
     </div>

     <!-- Back of the card (Details) -->
     <div class='card-back'>
       <p class='card-text'>$description</p>
       <p class='card-text'>Cost: $service_cost Rs/-</p>
       <a href='index.php?add_to_booking=$service_id' class='btn btn-info'>Booking</a>
       <a href='service_detail.php?service_id=$service_id' class='btn btn-secondary'>View More</a>
     </div>
   </div>

 </div>
</div>
";
        
      }
}
    }
// display shop name

function getshopname()
{
    global $con;
    $select_shop = "SELECT * FROM shopname";
    $result_shop = mysqli_query($con, $select_shop);

    if ($result_shop) {
        while ($row_data = mysqli_fetch_assoc($result_shop)) {
            $shop_title = $row_data['shop_title'];
            $shop_id = $row_data['shop_id'];

            echo "
            <li style='margin:8px 0; list-style:none;'>
                <a href='index.php?shopname=$shop_id'
                   style='
                        display:block;
                        padding:10px 16px;
                        background-color:#212529;
                        color:#f8f9fa;
                        border-radius:8px;
                        font-weight:500;
                        text-decoration:none;
                        border-left:4px solid transparent;
                        transition:all 0.3s ease;
                   '
                   onmouseover=\"this.style.backgroundColor='#3f3f64'; this.style.borderLeft='4px solid #8a2be2'; this.style.transform='scale(1.02)';\"
                   onmouseout=\"this.style.backgroundColor='#212529'; this.style.borderLeft='4px solid transparent'; this.style.transform='scale(1)';\"
                >
                    $shop_title
                </a>
            </li>";
        }
    } else {
        echo "Error executing query: " . mysqli_error($con);
    }
}


function getcategory()
{
    global $con;
    $select_categories = "SELECT * FROM categories";
    $result_categories = mysqli_query($con, $select_categories);

    if ($result_categories) {
        while ($row_data = mysqli_fetch_assoc($result_categories)) {
            $category_title = $row_data['category_title'];
            $category_id = $row_data['category_id'];

            echo "
            <li style='margin:8px 0; list-style:none;'>
                <a href='index.php?category=$category_id'
                   style='
                        display:block;
                        padding:10px 16px;
                        background-color:#212529;
                        color:#f8f9fa;
                        border-radius:8px;
                        font-weight:500;
                        text-decoration:none;
                        border-left:4px solid transparent;
                        transition:all 0.3s ease;
                   '
                   onmouseover=\"this.style.backgroundColor='#3f3f64'; this.style.borderLeft='4px solid #8a2be2'; this.style.transform='scale(1.02)';\"
                   onmouseout=\"this.style.backgroundColor='#212529'; this.style.borderLeft='4px solid transparent'; this.style.transform='scale(1)';\"
                >
                    $category_title
                </a>
            </li>";
        }
    } else {
        echo "Error executing query: " . mysqli_error($con);
    }
}


//serching service

function search_service()
{
    global $con;
    if(isset($_GET['search_data_service']))
    {
        $user_search=$_GET['search_data'];
        $search_query = "SELECT * FROM `service` WHERE service_keywords LIKE '%$user_search%'";
        $result_data_query=mysqli_query($con,$search_query);
      $result_query = mysqli_query($con, $search_query);
if (!$result_query) {
    die('Error executing query: ' . mysqli_error($con));
}
// if no service availble
$num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0)
        {
            echo "<h2 class='text-center text-danger'>No results match. No service found on this category!</h2>";
        }

     // $row=mysqli_fetch_assoc($result_query);
      //echo $row['service_title'];
      while($row=mysqli_fetch_assoc($result_data_query))
      {
        $service_id=$row['service_id'];
        $service_title=$row['service_title'];
        $description=$row['description'];
        $address=$row['address'];
        $category_id=$row['category_id'];
        $shop_id=$row['shop_id'];
        $service_image1=$row['service_image1'];
       $service_image2=$row['service_image2'];
       $service_image3=$row['service_image3'];
        $service_cost=$row['service_cost'];
        

        echo "
        
        <div class='col-md-4 mb-2'>
 <div class='card'>
   
   <div class='card-inner'>
     <!-- Front of the card (Image and Title) -->
     <div class='card-front'>
     <img src='./admin_area/service_images/$service_image1' class='card-img-top' alt='$service_title'>
    
     <h5>$service_title</h5>
     </div>

     <!-- Back of the card (Details) -->
     <div class='card-back'>
       <p class='card-text'>$description</p>
       <p class='card-text'>Cost: $service_cost Rs/-</p>
       <a href='index.php?add_to_booking=$service_id' class='btn btn-info'>Booking</a>
       <a href='service_detail.php?service_id=$service_id' class='btn btn-secondary'>View More</a>
     </div>
   </div>

 </div>
</div>
";
      }
}
} 

// view more function


function veiw_more()
{
  global $con;

    //condition to cheak isset or note
    if(isset($_GET['service_id']))
    {
    if(!isset($_GET['category']))
    {
         if(!isset($_GET['shopname']))
         {
    $service_id=$_GET['service_id'];
    $select_query="SELECT * FROM service where service_id=$service_id";
      $result_query=mysqli_query($con,$select_query);
     // $row=mysqli_fetch_assoc($result_query);
      //echo $row['service_title'];
      while($row=mysqli_fetch_assoc($result_query))
      {
        $service_id=$row['service_id'];
        $service_title=$row['service_title'];
        $description=$row['description'];
        $address=$row['address'];
        $category_id=$row['category_id'];
        $shop_id=$row['shop_id'];
        $contact=$row['contect'];
        $service_image1=$row['service_image1'];
       $service_image2=$row['service_image2'];
       $service_image3=$row['service_image3'];
        $service_cost=$row['service_cost'];
        

        echo " 
        
   <div class='custom-card-wrapper'>
    <div class='custom-card'>

        <!-- Image Slider -->
        <div class='custom-card-swiper-container swiper-container'>
            <div class='swiper-wrapper'>
                <div class='custom-card-swiper-slide swiper-slide'>
                    <img src='./admin_area/service_images/$service_image1' alt='Image 1'>
                </div>
                <div class='custom-card-swiper-slide swiper-slide'>
                    <img src='./admin_area/service_images/$service_image2' alt='Image 2'>
                </div>
                <div class='custom-card-swiper-slide swiper-slide'>
                    <img src='./admin_area/service_images/$service_image3' alt='Image 3'>
                </div>
            </div>

            <!-- Add Pagination for Images -->
            <div class='swiper-pagination'></div>
        </div>

        <!-- Card Content -->
        <h5 class='custom-card-title'>$service_title</h5>
        <p class='custom-card-text'>$description</p>
        <p class='custom-card-text'>Address: $address</p>
        <p class='custom-card-text'>Contact: $contact</p>
        <p class='custom-card-text' style='margin-bottom: 25px; color: papayawhip;'>Cost: $service_cost Rs./-</p>
        <a href='index.php?add_to_booking=$service_id' class='custom-card-btn'>Booking</a>
        <a href='./index.php' class='custom-card-view-more'>View More</a>
    </div>
</div>
<script src='https://unpkg.com/swiper@10/swiper-bundle.min.js'></script>
     <script>
      document.querySelectorAll('*').forEach(el => {
    el.style.overflowX = 'visible';
});
        const swiper = new Swiper('.custom-card-swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            spaceBetween: 20,
            slidesPerView: 1, /* Ensures only one image is visible at a time */
        });
    </script>    ";
      }
      }
}
    }
}




//get ip address function

function getIPAddress() {  
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    } else {  
        $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip;

// cart function
function cart()
{
    global $con;
    
    $get_ip_add = getIPAddress();  
    
    if(isset($_GET['add_to_booking']))
    {
        $get_service_id = mysqli_real_escape_string($con, $_GET['add_to_booking']);
        $select_query = "SELECT * FROM `card_details` WHERE ip_address='$get_ip_add' AND service_id='$get_service_id'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        $quantity = (int)$_POST['quantity'];
         // Get quantity from form submission
        if($num_of_rows == 0)
        {
            // Insert the service into booking
            

                $insert_query = "INSERT INTO `card_details` (service_id, ip_address, quantity) VALUES ('$get_service_id', '$get_ip_add', '$quantity')";

            $result_insert = mysqli_query($con, $insert_query);
            if($result_insert)
            {
                echo "<script>alert('This Service is Added into Booking Section')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
            else
            {
                echo "<script>alert('Error: Failed to add service to booking section')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
        else
        {
            echo "<script>alert('This Service is already Present inside Booking Section')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}

// function to get cart iteam number
function cart_item()
{
    global $con;
    
    $get_ip_add = getIPAddress();  
    
    $select_query = "SELECT * FROM `card_details` WHERE ip_address='$get_ip_add'";
    $result_query = mysqli_query($con, $select_query);
    $count_booking_items = mysqli_num_rows($result_query);
    
    echo $count_booking_items;
}
// total price function
function total_booking_price()
{
    global $con;
    
    $get_ip_add = getIPAddress();  
    $total = 0;
    $booking_query = "SELECT * FROM `card_details` WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $booking_query);
    
    while($row = mysqli_fetch_array($result))
    {
        $service_id = $row['service_id'];
        $select_service = "SELECT * FROM `service` WHERE service_id='$service_id'";
        $result_service = mysqli_query($con, $select_service);
        
        while($row_service_cost = mysqli_fetch_array($result_service))
        {
            $service_cost = $row_service_cost['service_cost'];
            $total += $service_cost;
        }
    }
    
    echo $total;
}

//get user order details
function get_user_order_details()
{
    global $con;
    $username=$_SESSION['username'];
    $get_details="Select * from `user_table` where user_name='$username'";
    $result_query=mysqli_query($con,$get_details);
    while($row_query=mysqli_fetch_array($result_query))
    {
$user_id=$row_query['user_id'];
if(!isset($_GET['edit_account']))
{
    if(!isset($_GET['my_bookings']))
    {
        if(!isset($_GET['delete_account']))
        {
              $get_bookings="Select * from `user_orders` where user_id=$user_id and order_status='pending'";
              $result_booking_query=mysqli_query($con,$get_bookings);
              $row_count=mysqli_num_rows($result_booking_query);
              if($row_count>0)
              {
                echo "<h3 class='text-center text-success mt-5 mb-2'>You Have <span class='text-danger'>$row_count</span> Pending Bookings!</h3>
                <p class='text-center'><a href='profile.php?my_bookings' class='text-dark'>Booking Details</a></p>";
              }
              else{
                echo "<h3 class='text-center text-success mt-5 mb-2'>You Have 0 Pending Bookings!</h3>
                <p class='text-center'><a href='../index.php' class='text-dark'>View More</a></p>";
              }
        }
    }
}
    }
}
?>



    
  
</body>
</html>