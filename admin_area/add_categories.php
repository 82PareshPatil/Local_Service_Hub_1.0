
<?php
include('../includes/connect.php');
if(isset($_POST['insert_cat']))
{
    $category_title = $_POST['cat_title'];

    // Select data from database
    $select_query = "SELECT * FROM categories WHERE category_title = '$category_title'";
    $result_select = mysqli_query($con, $select_query);
    if (!$result_select) {
        die('Error: ' . mysqli_error($con)); // Add error handling
    }
    
    $number = mysqli_num_rows($result_select);
    if($number > 0)
    {
        echo "<script>alert('This category already exists in the database')</script>";
    }
    else {
        // Insert data into database
        $insert_query = "INSERT INTO categories (category_title) VALUES ('$category_title')";
        $result = mysqli_query($con, $insert_query);
        if (!$result) {
            die('Error: ' . mysqli_error($con)); // Add error handling
        }
        else {
            echo "<script>alert('Category has been Added Successfully')</script>";
        }
    }
}
?>
<h2 class="text-center text-2xl font-semibold mb-6 text-gray-900 dark:text-white transition-colors">
  ➕  Add Category
</h2>

<form action="" method="post" class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-colors">
  <div class="mb-4">
    <label for="cat_title" class="block text-gray-700 dark:text-gray-300 mb-2 transition-colors">
      Category Title
    </label>
    <div class="flex items-center rounded-md shadow-sm">
      <span class="inline-flex items-center px-3 bg-blue-600 text-white rounded-l-md">
        <i class="fa-solid fa-receipt"></i>
      </span>
      <input
        type="text"
        id="cat_title"
        name="cat_title"
        class="w-full rounded-r-md p-2 text-gray-900 dark:text-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 transition-colors"
        placeholder="Enter category name"
        required>
    </div>
  </div>

  <div class="text-center">
    <input
      type="submit"
      name="insert_cat"
      value="Add Category"
      class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition" />
  </div>
</form>
