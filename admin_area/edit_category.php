<?php
// Assuming $con is your database connection

if(isset($_GET['edit_category'])) {
    $edit_cat = $_GET['edit_category'];
    $get_cat = "SELECT * FROM `categories` WHERE category_id=$edit_cat";
    $result = mysqli_query($con, $get_cat);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $category_title = $row['category_title'];

        if(isset($_POST['category_title'])) {
            $cat_title = $_POST['category_title']; 
            $update = "UPDATE `categories` SET category_title='$cat_title' WHERE category_id=$edit_cat";
            $result_update = mysqli_query($con, $update);

            if($result_update) {
                echo "<script>alert('Category Updated Successfully!')</script>";
                echo "<script>window.open('index.php?view_categories','_self')</script>";
            } else {
                echo "<script>alert('Failed to update Category!')</script>";
            }
        }
    } else {
        echo "<script>alert('Failed to fetch category details!')</script>";
    }
}
?>


<div class="container mt-3">
    <h1 class="text-center">Edit Category</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Category Title</label>
            <input type="text" name="category_title" id="category_title" class="form-control" required="required" value="<?php echo $cetegory_title;?>">
        </div>
        <input type="submit" value="Update Category" name="edit_cat" id="" class="btn btn-info px-3 mb-3">
    </form>
</div>