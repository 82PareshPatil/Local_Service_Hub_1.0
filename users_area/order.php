<?php 
// Include database connection and common functions
include('../includes/connect.php');
include('../function/comman_function.php');

// Check if user_id is set in the URL parameters
if(isset($_GET['user_id'])) {
    // Sanitize user input to prevent SQL injection
    $user_id = mysqli_real_escape_string($con, $_GET['user_id']);
} else {
    // Handle the case where user_id is not provided
    // You might want to redirect or show an error message
    exit("User ID is not provided.");
}

// Get the IP address of the user
$get_ip_address = getIPAddress();

// Initialize variables
$total = 0;
$subtotal = 0;
$status = 'pending';
$invoice_number = mt_rand();

// Query to select items from the cart for the given IP address
$cart_query_price = "SELECT * FROM `card_details` WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con, $cart_query_price);

// Count the number of services in the cart
$count_service = mysqli_num_rows($result_cart_price);

// Loop through cart items to calculate total price
while($row_price = mysqli_fetch_array($result_cart_price)) {
    $service_id = $row_price['service_id'];
    // Query to get service details based on service_id
    $select_service = "SELECT * FROM `service` WHERE service_id=$service_id";
    $run_price = mysqli_query($con, $select_service);
    // Fetch service price and calculate total
    while($row_service_price = mysqli_fetch_array($run_price)) {
        $service_cost = $row_service_price['service_cost'];
        $total += $service_cost;
    }
}

// Get the quantity from the first row of the cart
$get_cart = "SELECT * FROM `card_details` LIMIT 1";
$run_cart = mysqli_query($con, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'];

// Calculate subtotal based on total and quantity
if($quantity == 0) {
    $quantity = 1; // Set default quantity to 1 if not provided
}
$subtotal = $total * $quantity;

// Insert order details into the database
$insert_orders = "INSERT INTO `user_orders` (user_id, ammount_due, invoice_number, total_service, order_date, order_status) VALUES ('$user_id', '$subtotal', '$invoice_number', '$count_service', NOW(), '$status')";
$result_query = mysqli_query($con, $insert_orders);

// Check if the insertion was successful
if($result_query) {
    echo "<script>alert('Orders are Booking Successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
} else {
    // Handle the case where insertion failed
    echo "Error: " . mysqli_error($con);
}
//orders pending
$insert_pending_orders = "INSERT INTO `orders_pending` (user_id, invoice_number, service_id, quantity, order_status) VALUES ('$user_id', '$invoice_number', '$service_id', '$quantity', '$status')";

$result_pending_orders = mysqli_query($con, $insert_pending_orders);

//delete items from cart
$empty_booking="Delete from `card_details` where ip_address='$get_ip_address'";
$result_delete = mysqli_query($con, $empty_booking);
// Close database connection
mysqli_close($con);
?>
