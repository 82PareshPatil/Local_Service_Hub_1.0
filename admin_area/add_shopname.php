<?php
include('../includes/connect.php');

if (isset($_POST['insert_Shop'])) {
    $shop_title = trim($_POST['shop_title']);

    if (empty($shop_title)) {
        echo "<script>alert('Shop name cannot be empty.')</script>";
    } else {
        // Check if shop already exists
        $stmt = $con->prepare("SELECT * FROM shopname WHERE shop_title = ?");
        $stmt->bind_param("s", $shop_title);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('This Shop Name already exists in the database')</script>";
        } else {
            // Insert new shop
            $insert_stmt = $con->prepare("INSERT INTO shopname (shop_title) VALUES (?)");
            $insert_stmt->bind_param("s", $shop_title);
            if ($insert_stmt->execute()) {
                echo "<script>alert('Shop has been added successfully')</script>";
            } else {
                echo "<script>alert('Error adding shop: " . $con->error . "')</script>";
            }
        }
    }
}
?>
<h2 class="text-center text-2xl font-semibold mb-6 text-gray-900 dark:text-white transition">➕ Add Shop Name</h2>

<form action="" method="post" class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition">
  <div class="mb-4">
    <label for="shop_title" class="block text-gray-700 dark:text-gray-300 mb-2">Shop Name</label>
    <div class="flex items-center rounded-md shadow-sm">
      <span class="inline-flex items-center px-3 bg-blue-600 text-white rounded-l-md">
        <i class="fa-solid fa-store"></i>
      </span>
      <input
        type="text"
        id="shop_title"
        name="shop_title"
        placeholder="Enter shop name"
        required
        class="w-full rounded-r-md p-2 text-gray-900 dark:text-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 transition">
    </div>
  </div>

  <div class="text-center">
    <input
      type="submit"
      name="insert_Shop"
      value="Add Shop Name"
      class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition" />
  </div>
</form>
