<?php
// Assuming $con is your database connection

if(isset($_GET['edit_shop'])) {
    $edit_shop = $_GET['edit_shop'];
    $get_shop = "SELECT * FROM `shopname` WHERE shop_id=$edit_shop";
    $result = mysqli_query($con, $get_shop);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $shop_title = $row['shop_title'];

        if(isset($_POST['shop_title'])) {
            $shop_title = $_POST['shop_title']; 
            $update = "UPDATE `shopname` SET shop_title='$shop_title' WHERE shop_id=$edit_shop";
            $result_update = mysqli_query($con, $update);

            if($result_update) {
                echo "<script>alert('Shop Name Updated Successfully!')</script>";
                echo "<script>window.open('index.php?view_shop','_self')</script>";
            } else {
                echo "<script>alert('Failed to update Shop Name!')</script>";
            }
        }
    } else {
        echo "<script>alert('Failed to fetch Shop details!')</script>";
    }
}
?>


<div class="container mt-3">
    <h1 class="text-center">Edit Shop Name</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="shop_title" class="form-label">Shop Title</label>
            <input type="text" name="shop_title" id="shop_title" class="form-control" required="required" value="<?php echo $shop_title;?>">
        </div>
        <input type="submit" value="Update Shopname" name="edit_shop" id="" class="btn btn-info px-3 mb-3">
    </form>
</div>