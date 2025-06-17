<?php 
include('../includes/connect.php');
include('../function/comman_function.php');
@session_start();

/* ----------  PHP login handler stays exactly as before ---------- */
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];

    $select_query="SELECT * FROM `user_table` WHERE user_name='$user_username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();

    $select_query_cart="SELECT * FROM `card_details` WHERE ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);

    if($row_count>0){
        if(password_verify($user_password,$row_data['user_password'])){
            $_SESSION['username']=$user_username;
            echo "<script>alert('Login Successfully!')</script>"; 
            echo ($row_count_cart==0)
                 ? "<script>window.open('profile.php','_self')</script>"
                 : "<script>window.open('payment.php','_self')</script>";
        }else{
            echo "<script>alert('Password do not match!')</script>";
        }
    }else{
        echo "<script>alert('User Not Found. Register First!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- ----------  Custom Style  ---------- -->
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
            --bg:var(--bg-dark);
            --card:var(--card-dark);
            --text:var(--text-dark);
            --input:var(--input-dark);
        }
        [data-theme="light"]{
            --bg:var(--bg-light);
            --card:var(--card-light);
            --text:var(--text-light);
            --input:var(--input-light);
        }

        body{
            background:var(--bg);
            color:var(--text);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            overflow:auto;
            font-family:'Inter',sans-serif;
            transition:background .3s;
        }
        /* wrapper */
        .login-wrapper{
            display:flex;
            gap:3rem;
            align-items:center;
            justify-content:center;
            padding:1.5rem;
        }
        /* image panel */
        .login-img{
            width:360px;
            max-width:90vw;
            border-radius:18px;
            box-shadow:0 10px 40px rgba(0,0,0,.4);
            overflow:hidden;
            flex-shrink:0;
        }
        .login-img img{ width:100%; height:auto; display:block; }

        /* form card */
        .login-card{
            background:var(--card);
            width:420px;
            max-width:95vw;
            border-radius:18px;
            padding:3rem 2.5rem;
            box-shadow:0 10px 40px rgba(0,0,0,.3);
        }
        .login-card h2{
            font-weight:600;
            margin-bottom:2.5rem;
            text-align:center;
        }
        .form-control{
            background:var(--input);
            border:none;
            height:48px;
            padding-left:1rem;
            color:var(--text);
        }
        .form-control:focus{ box-shadow:none; border:2px solid var(--accent-from); }

        /* gradient button */
        .btn-gradient{
            display:block;
            width:100%;
            border:none;
            border-radius:12px;
            background:linear-gradient(90deg,var(--accent-from),var(--accent-to));
            color:#fff;
            font-weight:600;
            transition:filter .3s;
        }
        .btn-gradient:hover{ filter:brightness(1.1); }

        /* theme switch button */
        .theme-toggle{
            position:fixed;
            top:1.2rem;
            right:1.2rem;
            width:45px;
            height:45px;
            background:var(--card);
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor:pointer;
            box-shadow:0 4px 15px rgba(0,0,0,.4);
            z-index:50;
        }
        .theme-toggle i{ font-size:1.2rem; color:var(--text); }

        /* small screens */
        @media(max-width:767px){
            .login-wrapper{ flex-direction:column; gap:2rem; }
            .login-card{ padding:2rem 1.5rem; }
        }
    </style>
</head>
<body>

    <!-- ============  Theme Toggle  ============ -->
    <div class="theme-toggle" id="themeToggle" title="Switch theme">
        <i class="fas fa-moon"></i>
    </div>

    <!-- ============  Main Layout  ============ -->
    <div class="login-wrapper">
        <!-- image pane -->
        <div class="login-img">
            <img src="../image/l.png" alt="Login Artwork">
        </div>

        <!-- form card -->
        <div class="login-card">
            <h2>User Login</h2>
            <form method="post" autocomplete="off">
                <div class="mb-4">
                    <label class="form-label" for="user_username">User Name</label>
                    <input class="form-control" type="text" id="user_username" name="user_username"
                           placeholder="Enter your username" required>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="user_password">Password</label>
                    <input class="form-control" type="password" id="user_password" name="user_password"
                           placeholder="Enter your password" required>
                </div>
                <button type="submit" name="user_login" class="btn btn-gradient py-2 mb-3">Login</button>

                <p class="small text-center">
                    Don't have an account? 
                    <a href="user_registration.php" class="link-danger">Register</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for future components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ============  Theme Toggle Script  ============ -->
    <script>
        const toggleBtn   = document.getElementById('themeToggle');
        const htmlTag     = document.documentElement;      // <html>
        const icon        = toggleBtn.querySelector('i');

        // 1️⃣ apply saved theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        htmlTag.setAttribute('data-theme', savedTheme);
        icon.className = savedTheme === 'dark' ? 'fas fa-moon' : 'fas fa-sun';

        // 2️⃣ toggle handler
        toggleBtn.addEventListener('click', () => {
            const newTheme = htmlTag.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            htmlTag.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            icon.className = newTheme === 'dark' ? 'fas fa-moon' : 'fas fa-sun';
        });
    </script>
</body>
</html>
