<?php
include('../includes/connect.php');
include('../function/comman_function.php');
session_start();

if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM user_orders WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['ammount_due'];
}

if(isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount_due = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode) VALUES ('$order_id', '$invoice_number', '$amount_due', '$payment_mode')";
    $result = mysqli_query($con, $insert_query);
    if($result) {
        echo "<script>alert('Payment Successfully Completed!')</script>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
    $result_orders = mysqli_query($con, $update_orders);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
    <!--bootstrap css link-->
    <!--css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--css file-->
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-secondary">
    <div class="container my-5">
      <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method="post">
            <div class="from-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>">
            </div>
            <div class="from-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?> Rs.">
            </div>
            <div class="from-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" id="" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <option value="">UPI</option>
                    <option>Netbanking</option>
                    <option>Paypal</option>
                    <option>Cash On Booking</option>
                    <option>Card</option>
                    <option>Qr</option>
                    
                </select>
            </div>
            <div class="from-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
</body>
</html>