<h3 class="text-center text-success my-4">All Users</h3>

<?php 
$get_users = "SELECT * FROM `user_table`";
$result = mysqli_query($con, $get_users);
$row_count = mysqli_num_rows($result);

if ($row_count == 0) {
    echo "<h4 class='text-danger text-center mt-5'>No Users Found!</h4>";
} else {
    echo '
    <div class="table-responsive">
    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="bg-info text-white">
            <tr>
                <th>SR. NO</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Image</th>
                <th>User Address</th>
                <th>User Mobile</th>
            </tr>
        </thead>
        <tbody class="bg-light">';
        
    $number = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $number++;
        $user_name = $row_data['user_name'];
        $user_email = $row_data['user_email'];
        $user_image = $row_data['user_image'];
        $user_address = $row_data['user_address'];
        $user_mobile = $row_data['user_mobile'];

        echo "
        <tr>
            <td>$number</td>
            <td>$user_name</td>
            <td>$user_email</td>
            <td>
                <img src='../users_area/user_images/$user_image' alt='$user_name' class='rounded-circle user-img'>
            </td>
            <td>$user_address</td>
            <td>$user_mobile</td>
        </tr>";
    }

    echo '
        </tbody>
    </table>
    </div>';
}
?>

<!-- Optional CSS for Styling -->
<style>
    .user-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 0 8px rgba(0,0,0,0.15);
    }

    .table th,
    .table td {
        vertical-align: middle;
    }
</style>
