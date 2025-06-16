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
        
         <div class='col-md-4 mb-2'>
         <div class='card'>
                 <img src='./admin_area/service_images/$service_image1' class='card-img-top' alt='$service_title'>
                   <div class='card-body'>
                     <h5 class='card-title'>$service_title</h5>
                     <p class='card-text'>$description</p>
                     <p class='card-text'>Cost: $service_cost/-</p>
                     <a href='index.php?add_to_booking=$service_id' class='btn btn-info'>Booking</a>
                     <a href='service_detail.php?service_id=$service_id' class='btn btn-secondary'>View More</a>
                    </div>
           </div>
         </div>";
        
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
        

        echo " <div class='col-md-4 mb-2'>
        <div class='card'>
                 <img src='./admin_area/service_images/$service_image1' class='card-img-top' alt='$service_title'>
                   <div class='card-body'>
                     <h5 class='card-title'>$service_title</h5>
                     <p class='card-text'>$description</p>
                     <p class='card-text'>Cost: $service_cost/-</p>
                     <a href='index.php?add_to_booking=$service_id' class='btn btn-info'>Booking</a>
                     <a href='service_detail.php?service_id=$service_id' class='btn btn-secondary'>View More</a>
                     
                    </div>
          </div>
         </div>";
        
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
        

        echo " <div class='col-md-4 mb-2'>
        <div class='card'>
                 <img src='./admin_area/service_images/$service_image1' class='card-img-top' alt='$service_title'>
                   <div class='card-body'>
                     <h5 class='card-title'>$service_title</h5>
                     <p class='card-text'>$description</p>
                     <p class='card-text'>Cost: $service_cost/-</p>
                     <a href='index.php?add_to_booking=$service_id' class='btn btn-info'>Booking</a>
                     <a href='service_detail.php?service_id=$service_id' class='btn btn-secondary'>View More</a>
                    </div>
          </div>
         </div>";
        
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
        

        echo " <div class='col-md-4 mb-2'>
        <div class='card'>
                 <img src='./admin_area/service_images/$service_image1' class='card-img-top' alt='$service_title'>
                   <div class='card-body'>
                     <h5 class='card-title'>$service_title</h5>
                     <p class='card-text'>$description</p>
                     <p class='card-text'>Cost: $service_cost/-</p>
                     <a href='index.php?add_to_booking=$service_id' class='btn btn-info'>Booking</a>
                     <a href='service_detail.php?service_id=$service_id' class='btn btn-secondary'>View More</a>
                    </div>
          </div>
         </div>";
        
      }
}
    }
// display shop name

function getshopname()
{
    global $con;
    $select_shop = "SELECT * FROM shopname"; // Removed single quotes around table name
    $result_shop = mysqli_query($con, $select_shop);
    
    if($result_shop) { // Check if the query was successful
        
        while($row_data = mysqli_fetch_assoc($result_shop)) {
            $shop_title = $row_data['shop_title'];
            $shop_id = $row_data['shop_id'];
            
            echo "<li class='nav-item'>"; // Corrected opening <li> tag
            echo "<a href='index.php?shopname=$shop_id' class='nav-link text-light'>$shop_title</a>"; // Output shop title
            echo "</li>"; // Corrected closing </li> tag and added <br> for line break
        }
    } else {
        echo "Error executing query: " . mysqli_error($con);
    }
}

// display categories
function getcategory()
{
    global $con;
$select_categories = "SELECT * FROM categories"; // Removed single quotes around table name
    $result_categories = mysqli_query($con, $select_categories);
    
    if($result_categories) { // Corrected variable name in the if condition
        
        while($row_data = mysqli_fetch_assoc($result_categories)) {
            $category_title = $row_data['category_title'];
            $category_id = $row_data['category_id'];
            
            echo "<li class='nav-item'>"; // Corrected opening <li> tag
            echo "<a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>"; // Output shop title
            echo "</li>"; // Corrected closing </li> tag
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
        

        echo " <div class='col-md-4 mb-2'>
        <div class='card'>
                 <img src='./admin_area/service_images/$service_image1' class='card-img-top' alt='$service_title'>
                   <div class='card-body'>
                     <h5 class='card-title'>$service_title</h5>
                     <p class='card-text'>$description</p>
                     <p class='card-text'>Cost: $service_cost/-</p>
                     <a href='index.php?add_to_booking=$service_id' class='btn btn-info'>Booking</a>
                     <a href='service_detail.php?service_id=$service_id' class='btn btn-secondary'>View More</a>
                    </div>
          </div>
         </div>";
        
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
    $select_query="SELECT * FROM `service` where service_id=$service_id";
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
        

        echo " <div class='col-md-8 mb-2'>
                 <div class='card1'>
        <!--image slider start-->
                     <div class='slider'>
                          <div class='slides'>
                <!--radio buttons start-->
                <input type='radio' name='radio-btn' id='radio1'>
                <input type='radio' name='radio-btn' id='radio2'>
                <input type='radio' name='radio-btn' id='radio3'>
                <!--radio buttons end-->
                <!--slide images start-->
                <div class='slide first'>
                    <img src='./admin_area/service_images/$service_image1' alt='' class='card-img-top' alt='$service_title'>
                </div>
                <div class='slide'>
                    <img src='./admin_area/service_images/$service_image2' alt='' class='card-img-top' alt='$service_title'>
                </div>
                <div class='slide'>
                    <img src='./admin_area/service_images/$service_image3' alt='' class='card-img-top' alt='$service_title'>
                </div>
                <!--slide images end-->
                <!--automatic navigation start-->
                <div class='navigation-auto'>
                    <div class='auto-btn1'></div>
                    <div class='auto-btn2'></div>
                    <div class='auto-btn3'></div>
                </div>
                <!--automatic navigation end-->
            </div>
            <!--manual navigation start-->
            <div class='navigation-manual'>
                <label for='radio1' class='manual-btn'></label>
                <label for='radio2' class='manual-btn'></label>
                <label for='radio3' class='manual-btn'></label>
            </div>
            <!--manual navigation end-->
        </div>
        <!--image slider end-->
    </div>
                   <div class='card-body'>
                     <h5 class='card-title'>$service_title</h5>
                     <p class='card-text'>$description</p>
                    <p class='card-text'>Address: $address</p>
                    <p class='card-text'>Contact: $contact</p>
                    <p class='card-text'>cost: $service_cost/-</p>
                    <a href='index.php?add_to_booking=$service_id' class='btn btn-info'>Booking</a>

                    </div>
          </div>
         </div>
         ";
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