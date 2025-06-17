<?php
if(isset($_GET['edit_account']))
{
    $user_session_name=$_SESSION['username'];
    $select_query="Select * from `user_table` where user_name='$user_session_name'";
    $result_query=mysqli_query($con,$select_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $user_id=$row_fetch['user_id'];
    $user_name=$row_fetch['user_name'];
    $user_email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_mobile'];
    
    if(isset($_POST['user_update']))
    {
        $update_id=$user_id;
        $user_name=$_POST['user_name'];
        $user_email=$_POST['user_email'];
        $user_address=$_POST['user_address'];
        $user_mobile=$_POST['user_mobile'];
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");

        //update query
        $update_data="update `user_table` set user_name='$user_name',user_email='$user_email',user_image='$user_image',user_address='$user_address',user_mobile='$user_mobile' where user_id=$update_id";
        $result_query_update=mysqli_query($con,$update_data);
        if($result_query_update)
        {
            echo "<script>alert('Data Updated Successfuly')</script>";
            echo "<script>window.open('user_logout.php','_self')</script>";
        }
    }
   
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
 
        <style>
            <style>
/*────────  EDIT‑ACCOUNT  ────────*/
.lsh-ea-wrapper{
  max-width:900px;
  margin:0 auto;
  padding:2rem 1rem;
  background:rgba(255,255,255,0.04);
  backdrop-filter:blur(14px);
  border-radius:20px;
  box-shadow:0 8px 32px rgba(0,0,0,.45);
}
.lsh-ea-title{
  font-size:2rem;
  font-weight:600;
  color:#00e676;
  margin-bottom:2rem;
  text-align:center;
}
.lsh-ea-form{display:flex;flex-direction:column;gap:1.4rem;}
.lsh-ea-input{
  background:rgba(255,255,255,0.1);
  border:none;
  border-radius:10px;
  padding:.75rem 1rem;
  font-size:0.95rem;
  color:#fff;
  width:100%;
}
.lsh-ea-input::placeholder{color:#bbb;}
.lsh-ea-input:focus{box-shadow:0 0 0 3px rgba(124,77,255,.35);outline:none;}

.lsh-ea-file{
  display:flex;align-items:center;gap:1rem;flex-wrap:wrap;
}
.lsh-ea-file input[type=file]{flex:1;}
.lsh-ea-avatar{
  width:180px;height:180px;
  border-radius:12px;
  object-fit:cover;
  box-shadow:0 0 15px rgba(0,0,0,.4);
}

/* submit btn */
.lsh-ea-btn{
  background:linear-gradient(135deg,#5b5be3,#b84de4);
  border:none;border-radius:30px;
  color:#fff;font-weight:600;
  padding:.8rem 1rem;max-width:220px;
  align-self:center;
  box-shadow:0 5px 15px rgba(91,91,227,.45);
  transition:transform .3s ease,box-shadow .3s ease;
}
.lsh-ea-btn:hover{transform:translateY(-3px);box-shadow:0 8px 20px rgba(91,91,227,.6);}

/* mobile tweaks */
@media(max-width:576px){
  .lsh-ea-avatar{width:130px;height:130px;}
  .lsh-ea-title{font-size:1.6rem;}
}
</style>

        </style>
  
</head>
<body>
<h3 class="lsh-ea-title">Edit Account</h3>

<form action="" method="post" enctype="multipart/form-data" class="lsh-ea-wrapper lsh-ea-form">

  <input type="text"     name="user_name"  class="lsh-ea-input" value="<?php echo $user_name; ?>"  placeholder="Username">
  <input type="email"    name="user_email" class="lsh-ea-input" value="<?php echo $user_email; ?>" placeholder="Email">

  <div class="lsh-ea-file">
    <input type="file" name="user_image" class="lsh-ea-input">
    <img src="./user_images/<?php echo $user_image; ?>" class="lsh-ea-avatar">
  </div>

  <input type="text"  name="user_address" class="lsh-ea-input" value="<?php echo $user_address; ?>" placeholder="Address">
  <input type="text"  name="user_mobile"  class="lsh-ea-input" value="<?php echo $user_mobile; ?>"  placeholder="Mobile">

  <button type="submit" name="user_update" class="lsh-ea-btn">Update</button>

</form>

</body>
</html>