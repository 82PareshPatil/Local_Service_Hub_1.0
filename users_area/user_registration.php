<?php 
include('../includes/connect.php');
include('../function/comman_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User -Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--css file-->
</head>
<body>
    <div class="container-fluid my-3">
      <h2 class="text-center">New User Registration</h2>
      <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
             <form action="" method="post" enctype="multipart/form-data">
             <!--Username--> 
             <div class="form-outline mb-4">
                <label for="user_username" class="form-label">Username</label>
                <input type="text" id="user_username" class="form-control" placeholder="Enter Your Username" required="required" name="user_username">
              </div>
              <!--Email Field-->
              <div class="form-outline mb-4">
                <label for="user_email" class="form-label">Email</label>
                <input type="email" id="user_email" class="form-control" placeholder="Enter Your Email-id" required="required" name="user_email">
              </div>
              <!--image Field-->
              <div class="form-outline mb-4">
                <label for="user_image" class="form-label">User Image</label>
                <input type="file" id="user_image" class="form-control"  required="required" name="user_image">
              </div>
              <!--Password-->
              <div class="form-outline mb-4">
                <label for="user_password" class="form-label">Password</label>
                <input type="password" id="user_password" class="form-control" placeholder="Enter Your Password" required="required" name="user_password">
              </div>
              <!--Confirm Password-->
              <div class="form-outline mb-4">
                <label for="confirm_user_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_user_password" class="form-control" placeholder="Confirm Password" required="required" name="confirm_user_password">
              </div>
              <!--Address--> 
             <div class="form-outline mb-4">
                <label for="user_address" class="form-label">Address</label>
                <input type="text" id="user_address" class="form-control" placeholder="Enter Your Address" required="required" name="user_address">
              </div>
              <!--Contact--> 
             <div class="form-outline mb-4">
                <label for="user_contact" class="form-label">Contact</label>
                <input type="text" id="user_contact" class="form-control" placeholder="Enter Your Mobile Number" required="required" name="user_contact">
              </div>
              <div class="mt-4 pt-2">
                <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
              </div>
              <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ? <a href="user_login.php" class="text-danger"> Login</a></p>
             </form>
        </div>
      </div>
    </div>
</body>
</html>

<!--php code-->
<?php
if(isset($_POST['user_register']))
{
  $user_username=$_POST['user_username'];
  $user_email=$_POST['user_email'];
  $user_password=$_POST['user_password'];
  $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
  $confirm_user_password=$_POST['confirm_user_password'];
  $user_address=$_POST['user_address'];
  $user_contact=$_POST['user_contact'];
  $user_image=$_FILES['user_image']['name'];
  $user_image_tmp=$_FILES['user_image']['tmp_name'];
  $user_ip=getIPAddress();
  //select_query username
   $select_query="Select * from `user_table` where user_name='$user_username'";
   $result=mysqli_query($con,$select_query);
   $rows_count=mysqli_num_rows($result);

   //select_query email
   $select_query1="Select * from `user_table` where user_email='$user_email'";
   $result1=mysqli_query($con,$select_query1);
   $rows_count1=mysqli_num_rows($result1);

   //select_query contact
   $select_query2="Select * from `user_table` where user_mobile='$user_contact'";
   $result2=mysqli_query($con,$select_query2);
   $rows_count2=mysqli_num_rows($result2);


   if($rows_count>0)
   {
    echo "<script>alert('Username Already Exist')</script>";
   }
   else if($rows_count1>0)
   {
    echo "<script>alert('Email-id Already Exist')</script>";
   }
   else if($rows_count2>0)
   {
    echo "<script>alert('Mobile Number Already Exist')</script>";
   }
   else if($user_password!=$confirm_user_password)
   {
    echo "<script>alert('Password And Confirm-Password Do Not Match!')</script>";
   }
   //insert_query
  else{
  move_uploaded_file($user_image_tmp,"./user_images/$user_image");
  $insert_query="insert into `user_table` (user_name,user_email,user_password,user_image,user_ip,user_address,user_mobile) values ('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
  $sql_execute=mysqli_query($con,$insert_query);
  if($sql_execute)
  {
    echo "<script>alert('Data inserted Successfully')</script>";
  }
  else{
    die("Connection failed: " . mysqli_connect_error());
  }
}
// selecting cart iteam
$select_cart_iteams="Select * from `card_details` where ip_address='$user_ip'";
$result_cart=mysqli_query($con,$select_cart_iteams);
$rows_count=mysqli_num_rows($result_cart);
if($rows_count>0)
{
  $_SESSION['username']=$user_username;
  echo "<script>alert('The service in your Booking section')</script>";
  echo "<script>window.open('checkout.php','_self')</script>";
}
else{
  echo "<script>window.open('../index.php','_self')</script>";
}
}
?>