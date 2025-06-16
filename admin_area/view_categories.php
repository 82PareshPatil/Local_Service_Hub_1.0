<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-center">
            <th>SR.NO.</th>
            <th>Category Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-seondary text-light">
        <?php
            $select_cat="Select * from `categories`";
            $result=mysqli_query($con,$select_cat);
            $number=0;
            while($row=mysqli_fetch_assoc($result))
            {
                $category_id=$row['category_id'];
                $category_title=$row['category_title'];
                $number++;

            
        ?>
        <tr class="text-center">
            <td><?php echo $number;?></td>
            <td><?php echo $category_title;?></td>
            <td><a href='index.php?edit_category=<?php echo $category_id;?>' class='text-light'><i class='fa-regular fa-pen-to-square' style='color: #B197FC;'></i></a></td> <!-- Changed class for Font Awesome icon -->
           <td><a href='index.php?delete_category=<?php echo $category_id;?>' type="button" class="text-light" data-toggle="modal" data-target="#exampleModalCenter"><i class='fa-regular fa-trash-can' style='color: #B197FC;'></i></a></td>
        
        </tr>
        <?php

            }?>
            
    </tbody>
</table>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
     <h4>Are You Sure , You Want To Delete this Category?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="index.php?view_category" class="text-light text-decoration-none">NO</a></button>
        <button type="button" class="btn btn-primary"><a href='index.php?delete_category=<?php echo $category_id;?>' class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div>