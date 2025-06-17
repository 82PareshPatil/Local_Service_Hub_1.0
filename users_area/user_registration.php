<?php 
include('../includes/connect.php');
include('../function/comman_function.php');
@session_start();

/* -----  PHP registration handler (unchanged)  ----- */
if(isset($_POST['user_register'])){
    $user_username          = $_POST['user_username'];
    $user_email             = $_POST['user_email'];
    $user_password          = $_POST['user_password'];
    $hash_password          = password_hash($user_password, PASSWORD_DEFAULT);
    $confirm_user_password  = $_POST['confirm_user_password'];
    $user_address           = $_POST['user_address'];
    $user_contact           = $_POST['user_contact'];
    $user_image             = $_FILES['user_image']['name'];
    $user_image_tmp         = $_FILES['user_image']['tmp_name'];
    $user_ip                = getIPAddress();

    /* duplicates check */
    $d1=mysqli_num_rows(mysqli_query($con,"SELECT 1 FROM user_table WHERE user_name='$user_username'"));
    $d2=mysqli_num_rows(mysqli_query($con,"SELECT 1 FROM user_table WHERE user_email='$user_email'"));
    $d3=mysqli_num_rows(mysqli_query($con,"SELECT 1 FROM user_table WHERE user_mobile='$user_contact'"));

    if($d1){ echo "<script>alert('Username already exists!')</script>"; }
    elseif($d2){ echo "<script>alert('Email‑id already exists!')</script>"; }
    elseif($d3){ echo "<script>alert('Mobile number already exists!')</script>"; }
    elseif($user_password !== $confirm_user_password){
        echo "<script>alert('Password and confirm‑password do not match!')</script>";
    }else{
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");
        $insert="INSERT INTO user_table (user_name,user_email,user_password,
                user_image,user_ip,user_address,user_mobile)
                VALUES ('$user_username','$user_email','$hash_password',
                '$user_image','$user_ip','$user_address','$user_contact')";
        if(mysqli_query($con,$insert)){
            echo "<script>alert('Registration successful!')</script>";
        }else{
            die('MySQL error: '.mysqli_error($con));
        }
    }

    /* cart redirection */
    $cart=mysqli_num_rows(mysqli_query($con,
            "SELECT 1 FROM card_details WHERE ip_address='$user_ip'"));
    if($cart){
        $_SESSION['username']=$user_username;
        echo "<script>alert('Items awaiting in your booking section')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }else{
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- ----------  Custom Theme Style  ---------- -->
    <style>
        :root{
            --bg-dark:#0e1424;
            --card-dark:#141c2e;
            --text-dark:#ffffff;
            --input-dark:#e6edff;

            --bg-light:#f1f5ff;
            --card-light:#ffffff;
            --text-light:#111827;
            --input-light:#f1f5ff;

            --accent-from:#4e5cff;
            --accent-to:#b03af7;
        }
        [data-theme="dark"]{
            --bg:var(--bg-dark);   --card:var(--card-dark);
            --text:var(--text-dark); --input:var(--input-dark);
        }
        [data-theme="light"]{
            --bg:var(--bg-light); --card:var(--card-light);
            --text:var(--text-light); --input:var(--input-light);
        }

        body{
            background:var(--bg); color:var(--text);
            min-height:100vh; display:flex; align-items:center; justify-content:center;
            overflow:auto; font-family:'Inter',sans-serif; transition:background .3s;
        }
        .wrapper{ display:flex; gap:3rem; align-items:center; padding:1.5rem; }
        .side-img{ width:360px; max-width:90vw; border-radius:18px;
                   overflow:hidden; box-shadow:0 10px 40px rgba(0,0,0,.4);}
        .side-img img{ width:100%; height:auto; display:block;}

        .card-reg{
            background:var(--card); width:500px; max-width:95vw;
            border-radius:18px; padding:3rem 2.5rem;
            box-shadow:0 10px 40px rgba(0,0,0,.3);
        }
        .card-reg h2{ text-align:center; font-weight:600; margin-bottom:2rem; }

        .form-control{
            background:var(--input); border:none; height:48px; padding-left:1rem;
            color:var(--text);
        }
        .form-control:focus{ box-shadow:none; border:2px solid var(--accent-from); }

        .btn-gradient{
            width:100%; border:none; border-radius:12px;
            background:linear-gradient(90deg,var(--accent-from),var(--accent-to));
            color:#fff; font-weight:600; transition:filter .3s;
        }
        .btn-gradient:hover{ filter:brightness(1.1); }

        .theme-toggle{
            position:fixed; top:1.2rem; right:1.2rem; width:45px; height:45px;
            background:var(--card); border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            cursor:pointer; box-shadow:0 4px 15px rgba(0,0,0,.4); z-index:50;
        }
        .theme-toggle i{ font-size:1.2rem; color:var(--text); }

        @media(max-width:767px){
            .wrapper{ flex-direction:column; gap:2rem; }
            .card-reg{ padding:2rem 1.5rem; }
        }
    </style>
</head>
<body>

    <!-- Theme Switch -->
    <div class="theme-toggle" id="themeToggle"><i class="fas fa-moon"></i></div>

    <!-- --------  Main Layout  -------- -->
    <div class="wrapper">
        <!-- Image panel -->
        <div class="side-img">
            <img src="../image/r.png" alt="Registration Artwork">
        </div>

        <!-- Registration form card -->
        <div class="card-reg">
            <h2>New User Registration</h2>
            <form method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="mb-3">
                    <label class="form-label" for="user_username">Username</label>
                    <input class="form-control" id="user_username" name="user_username"
                           placeholder="Enter your username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="user_email">Email</label>
                    <input type="email" class="form-control" id="user_email" name="user_email"
                           placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="user_image">User image</label>
                    <input type="file" class="form-control" id="user_image" name="user_image" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="user_password">Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password"
                           placeholder="Enter password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="confirm_user_password">Confirm password</label>
                    <input type="password" class="form-control" id="confirm_user_password"
                           name="confirm_user_password" placeholder="Confirm password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="user_address">Address</label>
                    <input class="form-control" id="user_address" name="user_address"
                           placeholder="Enter your address" required>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="user_contact">Contact</label>
                    <input class="form-control" id="user_contact" name="user_contact"
                           placeholder="Enter mobile number" required>
                </div>

                <button type="submit" name="user_register" class="btn btn-gradient py-2 mb-3">Register</button>

                <p class="small text-center mb-0">
                    Already have an account?
                    <a href="user_login.php" class="link-danger">Login</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme switch script -->
    <script>
        const toggle  = document.getElementById('themeToggle');
        const root    = document.documentElement;
        const icon    = toggle.querySelector('i');

        const saved   = localStorage.getItem('theme') || 'dark';
        root.setAttribute('data-theme', saved);
        icon.className = saved === 'dark' ? 'fas fa-moon' : 'fas fa-sun';

        toggle.addEventListener('click', () => {
            const newT = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            root.setAttribute('data-theme', newT);
            localStorage.setItem('theme', newT);
            icon.className = newT === 'dark' ? 'fas fa-moon' : 'fas fa-sun';
        });
    </script>
</body>
</html>
