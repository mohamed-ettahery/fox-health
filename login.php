<?php
$active = "Login";
// session_start();
if(isset($_SESSION['user']))
{
    header("Location: index.php");
    exit();
}
 include("includes/templates/header.php");
 $action = isset($_GET['action']) ? $_GET['action'] : "login";
 if(($action != "login") && ($action != "signup"))
 {
     $action = "login";
 }
 if($_SERVER['REQUEST_METHOD'] == "POST")
 {
    if(isset($_POST['login']))
    {
        $email = $_POST['email'];
        $password = $_POST['psw'];
        $hashedPassword = sha1($password);

        $stmt = $cnx -> prepare("SELECT CIN,Email,MDP,Nom from client WHERE Email = ? AND MDP = ? AND Status = 'active'");
        $stmt -> execute(array($email,$hashedPassword));
        $count = $stmt -> rowCount();
        $row = $stmt -> fetch();
        if($count > 0)
        {
            $_SESSION['user'] = $row['Nom'];
            $_SESSION['userCIN'] = $row['CIN'];
            // header("Location:index.php");
            echo "<script>window.open('index.php','_self');</script>";
            exit();
        }
        else
        {
            $incorrectLogin = "<p style='color:red;'>E-mail ou mot de passe incorrect ou votre compte n'est pas approuvé !</p>";
        }
    }
    else
    {
        $Notice_Errors = array();

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $cin = $_POST['cin'];
        $city = $_POST['ville'];
        $address = $_POST['address'];
        $phone = $_POST['tele'];
        $dn = $_POST['dn'];
        $sex = $_POST['sex'];
        $email    = $_POST['email'];
        $pass1    = $_POST['password'];
        $pass2    = $_POST['Conf_password'];
        if(isset($_POST['fname']))
        {
            $filterFname = filter_var($fname,FILTER_SANITIZE_STRING);
            if(strlen($fname)<4)
            {
                $Notice_Errors[] = "first name can't be less than 4 characters.";
            }
        }
        if(isset($_POST['lname']))
        {
            $filterLname = filter_var($lname,FILTER_SANITIZE_STRING);
            if(strlen($filterLname)<4)
            {
                $Notice_Errors[] = "last name can't be less than 4 characters.";
            }
        }
        if(isset($_POST['password']) && isset($_POST['Conf_password']))
        {
            if(empty($pass1))
            {
                $Notice_Errors[] = "password can't be empty.";
            }
            if( sha1($_POST['Conf_password']) !== sha1($_POST['password']))
            {
                $Notice_Errors[] = "password and confirm password not matching.";
            }
            if(strlen($pass1) < 6)
            {
                $Notice_Errors[] = "password can't be less than 6 characters.";
            }
        }
        if(isset($email))
        {
            if(empty($email))
            {
                $Notice_Errors[] = "email can\'t be empty.";
            }
            $filterEmail = filter_var($email,FILTER_SANITIZE_EMAIL);
            if(filter_var($filterEmail,FILTER_VALIDATE_EMAIL) != true)
            {
                $Notice_Errors[] = "email not valid.";
            }
        }
        if(empty($Notice_Errors))
        {
            if(!CheckElement("CIN","client","WHERE CIN = '$cin' OR Email = '$email'"))
            {
                // echo "<script>alert('YES');</script>";
                    $stmt = $cnx -> prepare("INSERT INTO client(CIN,Nom,Prenom,	Adresse,Tele,Sex,Ville,Email,DateNaissance,MDP) VALUES(:cin,:nom,:prenom,:addr,:tele,:sex,:ville,:email,:daten,:psw)");
                    $stmt -> execute(array(
                        "cin"    => $cin,
                        "nom"    => ucFirst($filterLname),
                        "prenom" => ucFirst($filterFname),
                        "addr"   => $address,
                        "tele"   => $phone,
                        "sex"    => ucFirst($sex),
                        "ville"  => ucFirst($city),
                        "daten"  => $dn,
                        "email"  => $filterEmail,
                        "psw" => sha1($pass1)
                    ));
                    if($stmt)
                    {
                        // echo "<script>window.open('?action=signup','_self');</script>";
                         $succesRegistered = '<p class="succes-registered">Congratz! Thank you for your inscription</p>';
                    }
            }
            else
            {
                $Notice_Errors[] = "Sorry this user already exist(CIN or Email already exist).";

            }
        }
    }
 }
 ?>
<div class="login-page">
    <div class="container">
        <h1 class="text-center login-title"><span data-class ="login" class="<?php if($action == "login"){echo "selected-login";} ?>">Connéxion</span>|<span  data-class ="signup" class="<?php if($action == "signup"){echo "selected-signup";} ?>">Inscription</span></h1>
        <!-- Start Login -->
        <form action="<?php echo $_SERVER['PHP_SELF']."?action=login";?>" method="POST" class="login <?php if($action == "signup"){echo "dsnone";} ?>">
            <div class="input-box"><input type="email" class="form-control" name="email" placeholder="email" autocomplete="off" required/></div>
            <div class="input-box"><input type="password" class="form-control" name="psw" placeholder="mot de passe" autocomplete="new-password" required/></div>
            <input type="submit" class="form-control btn btn-info" name="login" value="Connecter"/>
        </form>
        <!-- End Login -->
        <!-- Start Signup -->
        <form action="<?php echo $_SERVER['PHP_SELF']."?action=signup";?>" method="POST" class="signup <?php if($action == "login"){echo "dsnone";} ?>">
        <div class="input-box"><input type="text"  class="form-control" name="fname" placeholder="Prénom" maxlength="20" autocomplete="off" required /></div>
        <div class="input-box"><input type="text"  class="form-control" name="lname" placeholder="Nom" maxlength="20" autocomplete="off" required /></div>
        <div class="input-box"><input type="text"  class="form-control" name="cin" placeholder="CIN" maxlength="10" style="text-transform: uppercase;" autocomplete="off" required/></div>
        <div class="input-box"><input type="text"  class="form-control" name="ville" placeholder="Ville" maxlength="10" autocomplete="off" required/></div>
        <div class="input-box"><input type="text"  class="form-control" name="address" placeholder="Adresse" autocomplete="off" required/></div>
        <div class="input-box"><input type="tel"  class="form-control" name="tele" placeholder="Télephone" maxlength="10" autocomplete="off" required/></div>
        <div class="input-box"><input type="date"  class="form-control" name="dn" placeholder="Date Naissance" autocomplete="off" required/></div>
        <div class="input-box"><input type="email" class="form-control" name="email" placeholder="email" maxlength="50" required/></div>
        <div class="input-box">
            <select style="margin-bottom:10px;" class="form-control" name="sex" required>
                <option value="male">Homme</option>
                <option value="female">Femme</option>
            </select>
        </div>
        <div class="input-box"><input type="password" minlength="6" class="form-control" name="password" placeholder="Mot de passe" autocomplete="new-password" required /></div>
        <div class="input-box"><input type="password" minlength="6" class="form-control" name="Conf_password" placeholder="confirmer mot de passe" autocomplete="new-password" required /></div>
        <div class="input-box"><input type="submit" class="form-control btn btn-success" value="S'incrire"/></div>
        </form>
        <!-- End Signup -->
        <!-- Start Notices -->
        <div class="notices-errors">
            <?php
            if(!empty($Notice_Errors))
            {
                foreach($Notice_Errors as $error)
                {
                    echo '<p class="error-p">'.$error.'</p>';
                }
            }
            if(isset($succesRegistered))
            {
                echo $succesRegistered;
            }
            if(isset($incorrectLogin))
            {
                echo $incorrectLogin;
            }

            ?>
        </div>
        <!-- End Notices -->
    </div>
</div>
<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->