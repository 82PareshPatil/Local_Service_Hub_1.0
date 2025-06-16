<h3 class="text-center text-success my-4">All Payments</h3>

<?php 
$get_payments = "SELECT * FROM `user_payments`";
$result = mysqli_query($con, $get_payments);
$row_count = mysqli_num_rows($result);

if ($row_count == 0) {
    echo "<h4 class='text-danger text-center mt-5'>No Payment Received Yet!</h4>";
} else {
    echo '
    <div class="table-responsive">
    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="bg-info text-white">
            <tr>
                <th>SR. NO</th>
                <th>Cost</th>
                <th>Invoice Number</th>
                <th>Payment Mode</th>
                <th>Booking Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-light">';
        
    $number = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $number++;
        $payment_id = $row_data['payment_id'];
        $amount = $row_data['amount'];
        $invoice_number = $row_data['invoice_number'];
        $payment_mode = $row_data['payment_mode'];
        $date = $row_data['date'];

        echo "
        <tr>
            <td>$number</td>
            <td>&#8377; $amount</td>
            <td>$invoice_number</td>
            <td>$payment_mode</td>
            <td>$date</td>
            <td>
                <a href='index.php?delete_payment=$payment_id' onclick='return confirm(\"Are you sure you want to delete this payment?\")' class='text-danger fs-5'>
                    <i class='fa-solid fa-trash'></i>
                </a>
            </td>
        </tr>";
    }

    echo '
        </tbody>
    </table>
    </div>';
}
?>
