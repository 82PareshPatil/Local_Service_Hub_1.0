<h3 class="text-center text-success">All Bookings</h3>

<?php 
$get_orders = "SELECT * FROM `user_orders`";
$result = mysqli_query($con, $get_orders);
$row_count = mysqli_num_rows($result);

if ($row_count == 0) {
    echo "<h4 class='text-danger text-center mt-5'>No Bookings Yet!</h4>";
} else {
?>

<!-- Table Starts -->
<table class="table table-bordered table-hover mt-4 shadow text-center">
    <thead class="bg-info text-white">
        <tr>
            <th>SR.NO</th>
            <th>Cost</th>
            <th>Invoice Number</th>
            <th>Total Services</th>
            <th>Booking Date</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $user_id = $row_data['user_id'];
                $amount_due = $row_data['ammount_due'];
                $invoice_number = $row_data['invoice_number'];
                $total_service = $row_data['total_service'];
                $order_date = $row_data['order_date'];
                $order_status = $row_data['order_status'];
                $number++;

                echo "
<tr>
    <td class='px-4 py-2'>$number</td>
    <td class='px-4 py-2'>₹$amount_due</td>
    <td class='px-4 py-2 text-primary fw-bold'>$invoice_number</td>
    <td class='px-4 py-2'>$total_service</td>
    <td class='px-4 py-2'>$order_date</td>
    <td class='px-4 py-2'><span class='badge badge-success'>$order_status</span></td>
    <td class='px-4 py-2'>
        <a href='index.php?delete_Booking=$order_id' onclick=\"return confirm('Are you sure to delete this booking?')\">
            <i class='fa-regular fa-trash-can' style='color: #B197FC;'></i>
        </a>
    </td>
</tr>
";

            }
        ?>
    </tbody>
</table>

<?php } ?>
