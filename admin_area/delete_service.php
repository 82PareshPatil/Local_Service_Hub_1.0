<?php
if(isset($_GET['delete_service']))
{
    $delete_id=$_GET['delete_service'];
    //delete query
    $delete_service="Delete from `service` where service_id=$delete_id";
    $result_service=mysqli_query($con,$delete_service);
    if($result_service)
    {
        echo "<script>alert('Service Delete Successfully!')</script>";
        echo "<script>window.open('index.php?view_service','_self')</script>";
    }
    else
    {
        echo "<script>alert('Failed to Delete service!')</script>";
    }
}
?>