<?php
include('../includes/connect.php');
?>

<body>
  <h3 class="text-success text-center my-4">All Services</h3>
  <div class="container">
    <table class="table table-bordered text-center table-striped table-hover">

      <thead class="bg-info text-white">
        <tr>
          <th>#</th>
          <th>Service Title</th>
          <th>Service Image</th>
          <th>Cost</th>
          <th>Total Bookings</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody class="bg-secondary text-light">

        <?php
        $get_service = "SELECT * FROM service";
        $result = mysqli_query($con, $get_service);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $service_id = $row['service_id'];
          $service_title = $row['service_title'];
          $service_image1 = $row['service_image1'];
          $service_cost = $row['service_cost'];
          $status = $row['Status'];
          $number++;

          // Count total bookings
          $get_count = "SELECT * FROM orders_pending WHERE service_id=$service_id";
          $result_count = mysqli_query($con, $get_count);
          $rows_count = mysqli_num_rows($result_count);
        ?>

          <tr>
          <td class="px-3 py-2"><?= $number ?></td>
<td class="px-3 py-2"><?= $service_title ?></td>
<td class="px-3 py-2">
  <img src="./service_images/<?= htmlspecialchars($service_image1) ?>" alt="Service Image" width="60" height="60" style="object-fit:cover;">
</td>
<td class="px-3 py-2">₹<?= $service_cost ?></td>
<td class="px-3 py-2"><?= $rows_count ?></td>
<td class="px-3 py-2"><?= htmlspecialchars($status) ?></td>
<td class="px-3 py-2">
  <a href="index.php?edit_service=<?= $service_id ?>" class="text-light">
    <i class="fa-solid fa-pen-to-square" style="color: #FFD43B;"></i>
  </a>
</td>
<td class="px-3 py-2">
  <a href="#" class="text-light" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $service_id ?>">
    <i class="fa-solid fa-trash" style="color: #FF6B6B;"></i>
  </a>

              <!-- Modal for Delete -->
              <div class="modal fade" id="deleteModal<?= $service_id ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $service_id ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteModalLabel<?= $service_id ?>">Confirm Deletion</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete the service "<strong><?= $service_title ?></strong>"?
                    </div>
                    <div class="modal-footer">
                      <a href="index.php?view_service" class="btn btn-secondary">No</a>
                      <a href="index.php?delete_service=<?= $service_id ?>" class="btn btn-danger">Yes, Delete</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal -->
            </td>
          </tr>

        <?php } ?>

      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
