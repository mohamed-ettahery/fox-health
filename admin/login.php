<?php
session_start();
if(isset($_SESSION['admin']))
{
    header("Location: index.php");
    exit();
}
require 'includes/cnx.php';
 if($_SERVER['REQUEST_METHOD'] == "POST")
 {
    if(isset($_POST['login']))
    {
        $email = $_POST['email'];
        $password = $_POST['psw'];

        $stmt = $cnx->prepare("SELECT * from admin WHERE email = '$email' AND mdp = '$password'");
        $stmt->execute();
        $count = $stmt->rowCount();
        $row = $stmt->fetch();
        if($count > 0)
        {
            $_SESSION['admin'] = $row['id'];
            echo "<script>window.open('index.php','_self');</script>";
            exit();
        }
        else
        {
            $incorrectLogin = "<p style='color:red;text-align: center;'>E-mail ou mot de passe incorrect !</p>";
        }
    }
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../layouts/css/bootstrap.min.css"/>
    <style>
            /*Start Login*/
        .login-page
        {
            padding-top: 70px;
            height: 130vh;
            background-color: whitesmoke;
        }
        .login-page h1
        {
            color: #666;
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .login-page span
        {
            cursor: pointer;
        }
        .login-page .selected-login{
            color:#ff4444;
        }
        .login-page .btn-info
        {
            background-color: #ff4444;
            border-color: #ff4444;
        }
        .login-page form
        {
            max-width: 350px;
            margin: auto;
        }
        .login-page form input
        {
            margin-bottom: 10px;
        }
        /*End Login*/
    </style>
</head>
<body>
    <div class="login-page">
        <div class="container">
            <h1 class="text-center login-title"><span data-class ="login" class="selected-login">Admin Login</span></h1>
            <!-- Start Login -->
            <form action="<?php echo $_SERVER['PHP_SELF']."?action=login";?>" method="POST" class="login">
                <div class="input-box"><input type="email" class="form-control" name="email" placeholder="email" autocomplete="off" required/></div>
                <div class="input-box"><input type="password" class="form-control" name="psw" placeholder="password" autocomplete="new-password" required/></div>
                <input type="submit" class="form-control btn btn-info" name="login" value="Login"/>
            </form>
            <!-- End Login -->
            <!-- Start Notices -->
            <div class="notices-errors">
                <?php
                if(isset($incorrectLogin))
                {
                    echo $incorrectLogin;
                }

                ?>
            </div>
            <!-- End Notices -->
        </div>
    </div>
</body>
  <script src="../layouts/js/jquery-3.6.0.min.js"></script>
  <script src="../layouts/js/bootstrap.min.js"></script>
  <script src="../layouts/js/popper.min.js"></script>
</html>
