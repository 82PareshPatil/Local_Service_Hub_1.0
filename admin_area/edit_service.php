<?php
include('../includes/connect.php');

// Get service data
if (isset($_GET['edit_service'])) {
    $edit_id = mysqli_real_escape_string($con, $_GET['edit_service']);
    $get_data = "SELECT * FROM `service` WHERE service_id = $edit_id";
    $result = mysqli_query($con, $get_data);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $service_title = $row['service_title'];
        $service_desc = $row['description'];
        $service_keywords = $row['service_keywords'];
        $service_image1 = $row['service_image1'];
        $service_image2 = $row['service_image2'];
        $service_image3 = $row['service_image3'];
        $service_cost = $row['service_cost'];
        $category_id = $row['category_id'];
        $shop_id = $row['shop_id'];

        // Get category name
        $category_title = '';
        $get_cat = mysqli_query($con, "SELECT category_title FROM `categories` WHERE category_id = $category_id");
        if ($cat = mysqli_fetch_assoc($get_cat)) {
            $category_title = $cat['category_title'];
        }

        // Get shop name
        $shop_title = '';
        $get_shop = mysqli_query($con, "SELECT shop_title FROM `shopname` WHERE shop_id = $shop_id");
        if ($shop = mysqli_fetch_assoc($get_shop)) {
            $shop_title = $shop['shop_title'];
        }
    } else {
        echo "<script>alert('Service not found!'); window.location.href = 'error_page.php';</script>";
        exit;
    }
} else {
    echo "<script>window.location.href = 'error_page.php';</script>";
    exit;
}
?>

<style>
    .service_img1 {
        width: 200px;
        object-fit: contain;
    }
</style>

<div class="box">
    <div class="container mt-5">
        <h1 class="text-center">Edit Service</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="form-outline w-50 m-auto mb-4">
                <label class="form-label">Service Title</label>
                <input type="text" name="service_title" class="form-control" required value="<?= $service_title ?>">
            </div>

            <!-- Description -->
            <div class="form-outline w-50 m-auto mb-4">
                <label class="form-label">Service Description</label>
                <input type="text" name="service_desc" class="form-control" required value="<?= $service_desc ?>">
            </div>

            <!-- Keywords -->
            <div class="form-outline w-50 m-auto mb-4">
                <label class="form-label">Service Keywords</label>
                <input type="text" name="service_keywords" class="form-control" required value="<?= $service_keywords ?>">
            </div>

            <!-- Category Dropdown -->
            <div class="form-outline w-50 m-auto mb-4">
                <label class="form-label">Categories</label>
                <select name="service_category" class="form-select">
                    <option value="<?= $category_id ?>"><?= $category_title ?></option>
                    <?php
                    $categories = mysqli_query($con, "SELECT * FROM `categories`");
                    while ($cat = mysqli_fetch_assoc($categories)) {
                        echo "<option value='{$cat['category_id']}'>{$cat['category_title']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Shop Dropdown -->
            <div class="form-outline w-50 m-auto mb-4">
                <label class="form-label">Shop Name</label>
                <select name="shop_id" class="form-select">
                    <option value="<?= $shop_id ?>"><?= $shop_title ?></option>
                    <?php
                    $shops = mysqli_query($con, "SELECT * FROM `shopname`");
                    while ($shop = mysqli_fetch_assoc($shops)) {
                        echo "<option value='{$shop['shop_id']}'>{$shop['shop_title']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Image 1 -->
            <div class="form-outline w-50 m-auto mb-4">
                <label class="form-label">Service Image 1</label>
                <div class="d-flex">
                    <input type="file" name="service_image1" class="form-control w-90 m-auto">
                    <img src="./service_images/<?= $service_image1 ?>" class="service_img1" alt="Current Image 1">
                </div>
            </div>

            <!-- Image 2 -->
            <div class="form-outline w-50 m-auto mb-4">
                <label class="form-label">Service Image 2</label>
                <div class="d-flex">
                    <input type="file" name="service_image2" class="form-control w-90 m-auto">
                    <img src="./service_images/<?= $service_image2 ?>" class="service_img1" alt="Current Image 2">
                </div>
            </div>

            <!-- Image 3 -->
            <div class="form-outline w-50 m-auto mb-4">
                <label class="form-label">Service Image 3</label>
                <div class="d-flex">
                    <input type="file" name="service_image3" class="form-control w-90 m-auto">
                    <img src="./service_images/<?= $service_image3 ?>" class="service_img1" alt="Current Image 3">
                </div>
            </div>

            <!-- Cost -->
            <div class="form-outline w-50 m-auto mb-4">
                <label class="form-label">Service Cost</label>
                <input type="text" name="service_cost" class="form-control" required value="<?= $service_cost ?>">
            </div>

            <!-- Submit -->
            <div class="text-center m-auto">
                <input type="submit" name="edit_service" value="Update Service" class="btn btn-info px-3 mb-3">
            </div>
        </form>
    </div>
</div>

<?php
// Update service logic
if (isset($_POST['edit_service'])) {
    $title = mysqli_real_escape_string($con, $_POST['service_title']);
    $desc = mysqli_real_escape_string($con, $_POST['service_desc']);
    $keywords = mysqli_real_escape_string($con, $_POST['service_keywords']);
    $category = mysqli_real_escape_string($con, $_POST['service_category']);
    $shop = mysqli_real_escape_string($con, $_POST['shop_id']);
    $cost = mysqli_real_escape_string($con, $_POST['service_cost']);

    // Handle images
    $image1 = $_FILES['service_image1']['name'] ?: $service_image1;
    $image2 = $_FILES['service_image2']['name'] ?: $service_image2;
    $image3 = $_FILES['service_image3']['name'] ?: $service_image3;

    $tmp1 = $_FILES['service_image1']['tmp_name'];
    $tmp2 = $_FILES['service_image2']['tmp_name'];
    $tmp3 = $_FILES['service_image3']['tmp_name'];

    if ($tmp1) move_uploaded_file($tmp1, "./service_images/$image1");
    if ($tmp2) move_uploaded_file($tmp2, "./service_images/$image2");
    if ($tmp3) move_uploaded_file($tmp3, "./service_images/$image3");

    // Update query
    $update = "UPDATE `service` SET 
        category_id='$category',
        shop_id='$shop',
        service_title='$title',
        description='$desc',
        service_keywords='$keywords',
        service_image1='$image1',
        service_image2='$image2',
        service_image3='$image3',
        service_cost='$cost',
        date=NOW() 
        WHERE service_id = $edit_id";

    $run = mysqli_query($con, $update);

    if ($run) {
        echo "<script>alert('Service Updated Successfully!'); window.open('index.php?view_service','_self');</script>";
    } else {
        echo "<script>alert('Service update failed!');</script>";
    }
}
?>
