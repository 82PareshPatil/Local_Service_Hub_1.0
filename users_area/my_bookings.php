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
    <h3 class="text-success">All Bookings</h3>
    <table class="table-bordered mt-5 col-md-10">
        <thead class="bg-info">
        <tr>
            <th>Sr.No</th>
            <th>Ammount Due</th>
            <th>Total Service</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/Incomplete</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_order_details="Select * from `user_orders` where user_id=$user_id";
            $result_order=mysqli_query($con,$get_order_details);
            $number=1;
            while($row_orders=mysqli_fetch_assoc($result_order))
            {
                $order_id=$row_orders['order_id'];
                $ammount_due=$row_orders['ammount_due'];
                $total_service=$row_orders['total_service'];
                $invoice_number=$row_orders['invoice_number'];
                $order_status=$row_orders['order_status'];
                if($order_status=='pending')
                {
                    $order_status='Incomplete';
                }
                else
                {
                    $order_status='Complete';
                }
                $order_date=$row_orders['order_date'];
                
                ?>
                <tr>
                <td><?php echo $number;?></td>               
                <td><?php echo $ammount_due;?></td>
                <td><?php echo $total_service;?></td>
                <td><?php echo $invoice_number;?></td>
                <td><?php echo $order_date;?></td>
                <td><?php echo$order_status;?></td>
                
                <?php
                if($order_status=='Complete')
                {
                    echo "<td>Paid</td>";
                }
                else
                {
               echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td></tr>";
                }
             
                $number++;
            
        }
            ?>
                </tr>  
        </tbody>
    </table>
</body>
</html>