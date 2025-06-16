<?php
if(isset($_GET['delete_category']))
{
    $delete_id=$_GET['delete_category'];
    //delete query
    $delete_category="Delete from `categories` where category_id=$delete_id";
    $result_service=mysqli_query($con,$delete_category);
    if($result_service)
    {
        echo "<script>alert('Category Delete Successfully!')</script>";
        echo "<script>window.open('index.php?view_categories','_self')</script>";
    }
    else
    {
        echo "<script>alert('Failed to Delete Category!')</script>";
    }
}
?>
