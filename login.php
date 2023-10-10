<?php
session_start();
require_once 'config.php'; 
include 'dbConnect.php';

if (isset($_POST['submit'])) {
    $query = " SELECT * FROM `user_info` WHERE `email`='$_POST[email]'";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1)
         {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['verified'] == 1) {
                if (password_verify($_POST['password'], $result_fetch['password'])) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_email'] = $result_fetch['email'];
                    $_SESSION['user_id'] = $result_fetch['id'];
                    $_SESSION['user_fullname'] = $result_fetch['fullname'];
                    setcookie("useremail",$result_fetch['email'],time()+(86400*30),"/");
                    header("location:index.php");
                } else {
                    echo "<script>
                    alert('Incorrect password');
                     window.location.href='login.php';
                    </script>
                       ";
               
                }
               } 
               else 
               {
                echo "
      <script>
      alert('Email not verified check your email');
      window.location.href='login.php';
      </script>
      ";
               }
        } else {
            echo "
      <script>
      alert('Email not registered');
      window.location.href='signup.php';
      </script>
      ";
        }
    } else {
        echo "
      <script>
      alert('Can not run query');
      window.location.href='index.php';
      </script>
      ";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- external css link  -->
    <link rel="stylesheet" href="externals/css/style.css">
    <!-- bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- swipper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- font awesome cdn 6.3.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <!-- favicon link  -->
    <link rel="shortcut icon" href="images/logo/favicon.ico" type="image/x-icon">
    <!-- website title  -->
    <title>MTBS | Login</title>
</head>

<body class="overflow-x-hidden">
    <!-- header start  -->
    <?php include("includes/header.php") ?>
    <!-- header end  -->
    <!-- main start  -->
    <main>
        <div class="d-flex flex-column align-items-center justify-content-center p-5 bg-secondary">
            <div class="bg-light p-3 res-width">
                <h2 class="text-muted text-center pt-2">Log in with Google</h2>
                <form class="p-3" action="" method="POST" autocomplete="off">
                <button class="btn btn-width btn-outline-success bg-success text-light" name="submit" type="submit"><i class="fa-brands fa-google"></i> Google</button>
                </form>
                <h6 class="text-center text-muted">or</h6>
                <h2 class="text-muted text-center pt-2">Enter your login details</h2>
                <form class="p-3" action="" method="POST" autocomplete="off">
                    <div class="form-group py-2">
                        <div class="input-field">
                            <input type="email" name="email" placeholder="Enter your Email" required class="form-control px-3 py-2" value="<?php if(isset($_COOKIE['useremail'])){ echo $_COOKIE['useremail']; }  ?>">
                        </div>
                    </div>
                    <div class="form-group py-2">
                        <div class="input-field">
                            <input type="password" id="myInput" name="password" placeholder="Enter your Password" required class="form-control px-3 py-2 ">
                        </div>
                    </div>
                    <div class="form-group py-2">
                        <label for="showpass">
                            <div class="input-field">
                                <input type="checkbox" id="showpass" onclick="myFunction()">&nbsp;Show Password
                            </div>
                        </label>
                    </div>
                    <button class="btn btn-width btn-outline-success bg-success text-light" name="submit" type="submit">Log in</button>
                    <div class="text-center mt-3 text-muted">Not a member? <a href="signup.php">Sign up</a></div>
                    <div class="text-center mt-3 text-muted">
                        <a href="forgetpassword.php">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!-- main end  -->

    <!-- footer start  -->
    <?php include("includes/footer.php") ?>
    <!-- footer end  -->

    <!-- external js link  -->
    <script type="text/javascript" src="externals/js/script.js"></script>
    <!-- bootstrap js link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- swipper js link  -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <!-- internal script link  -->
    <script>
        function myFunction() {
            let x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>