
<?php
if(isset($_GET['delete_Booking']))
{
    $delete_id=$_GET['delete_Booking'];
    //delete query

    $delete_booking="Delete from `user_orders` where order_id=$delete_id";
    $result_booking=mysqli_query($con,$delete_booking);
    if($result_booking)
    {
        echo "<script>alert('Booking Delete Successfully!')</script>";
        echo "<script>window.open('index.php?list_bookings','_self')</script>";
    }
    else
    {
        echo "<script>alert('Failed to Delete Booking!')</script>";
    }
}
?>