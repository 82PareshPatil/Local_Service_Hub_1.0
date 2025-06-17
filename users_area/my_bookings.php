<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panding_Bookings</title>
</head>
<body>
    <?php
      $username=$_SESSION['username'];
      $get_user="Select * from `user_table` where user_name='$username'";
      $result=mysqli_query($con,$get_user);
      $row_fetch=mysqli_fetch_assoc($result);
      $user_id=$row_fetch['user_id'];
    ?>
    <h3 class="lsh-bk-tbl-title">All Bookings</h3>

<div class="lsh-bk-tbl-wrapper">
  <table class="lsh-bk-tbl">
    <thead>
      <tr>
        <th>Sr No</th>
        <th>Amount Due</th>
        <th>Total Service</th>
        <th>Invoice #</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $get_order_details="SELECT * FROM `user_orders` WHERE user_id=$user_id";
      $result_order=mysqli_query($con,$get_order_details);
      $number=1;
      while($row_orders=mysqli_fetch_assoc($result_order)){
        $order_id      = $row_orders['order_id'];
        $amount_due    = $row_orders['ammount_due'];
        $total_service = $row_orders['total_service'];
        $invoice_number= $row_orders['invoice_number'];
        $order_status  = $row_orders['order_status']=='pending' ? 'Incomplete' : 'Complete';
        $order_date    = $row_orders['order_date'];
        echo \"<tr>
          <td>$number</td>
          <td>₹ $amount_due</td>
          <td>$total_service</td>
          <td>$invoice_number</td>
          <td>$order_date</td>
          <td>$order_status</td>\";
        if($order_status=='Complete'){
          echo \"<td class='paid'>Paid</td>\";
        }else{
          echo \"<td><a href='confirm_payment.php?order_id=$order_id' class='confirm-link'>Confirm</a></td>\";
        }
        echo \"</tr>\";
        $number++;
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>