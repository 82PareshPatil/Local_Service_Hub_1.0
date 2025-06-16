<?php
if(isset($_GET['delete_shop']))
{
    $delete_id=$_GET['delete_shop'];
    //delete query
    $delete_shop="Delete from `shopname` where shop_id=$delete_id";
    $result_service=mysqli_query($con,$delete_shop);
    if($result_service)
    {
        echo "<script>alert('Shop Delete Successfully!')</script>";
        echo "<script>window.open('index.php?view_shop','_self')</script>";
    }
    else
    {
        echo "<script>alert('Failed to Delete shop!')</script>";
    }
}
?>