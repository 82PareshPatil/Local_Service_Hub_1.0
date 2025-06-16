
<?php
if(isset($_GET['delete_payment']))
{
    $delete_id=$_GET['delete_payment'];
    //delete query

    $delete_payment="Delete from `user_payments` where payment_id=$delete_id";
    $result_payment=mysqli_query($con,$delete_payment);
    if($result_payment)
    {
        echo "<script>alert('Payment Delete Successfully!')</script>";
        echo "<script>window.open('index.php?list_payment','_self')</script>";
    }
    else
    {
        echo "<script>alert('Failed to Delete Payment!')</script>";
    }
}
?>