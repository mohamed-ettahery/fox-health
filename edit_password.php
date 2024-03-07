<?php
$active = "Confirm";
// session_start();
include("includes/templates/header.php");
if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}
else
{
    $cin = $_SESSION['userCIN'];
}
if(isset($_POST['edit-pass']))
{
    $pass =sha1($_POST['pass']);
    $newpass = $_POST['newpass'];
    $confpass = $_POST['confnewpass'];

    if(CheckElement("*","client","WHERE CIN = '$cin' AND MDP = '$pass'"))
    {
        if($newpass == $confpass)
        {
            $password = sha1($newpass);
            if(UpdateElements("client","MDP = '$password'","WHERE CIN = '$cin'"))
            {
                echo "<script>alert('Votre mot de passe bien modifé!')</script>";
                echo "<script>window.open('edit_password.php','_self')</script>";
            }
            else
            {
                echo "<script>alert('ERROR!')</script>";
                echo "<script>window.open('edit_password.php','_self')</script>";
            }
        }
        else
        {
            echo "<script>alert('Le nouveau mot de passe ne correspond pas à la confirmation du mot de passe!')</script>";
            echo "<script>window.open('edit_password.php','_self')</script>";
        }
        // echo "<script>alert('yes')</script>";
    }
    else
    {
        echo "<script>alert('ancien mot de passe incrorrect!')</script>";
        echo "<script>window.open('edit_password.php','_self')</script>";
    }
}
?>
<!-- Start Edit Password -->
<div class="edit-password">
    <h2>Modifier le mot de passe</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum unde nihil molestiae deserunt at maiores culpa amet officiis nesciunt quae, veritatis voluptatibus dolor explicabo quo, exercitationem ipsam facilis aperiam! Fugit.</p>
  <form action="" method="POST">
    <input class="form-control form-control-lg" name="pass" type="password" placeholder="ancien mot de passe" required/>
    <input class="form-control form-control-lg" name="newpass" type="password" placeholder="nouveau mot de passe"required/>
    <input class="form-control form-control-lg" name="confnewpass" type="password" placeholder="Confirm New Password" required/>
    <input class="btn btn-danger btn-lg" style="display:block;" type="submit" name="edit-pass" value="Change Password"/>
  </form>
</div>
<!-- End Edit Password -->

<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->
