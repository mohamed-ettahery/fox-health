<?php 
 $active='profile';
 include("includes/templates/header.php");
  if(!isset($_SESSION['user']) || empty($_SESSION['user']))
 {
     header("location:login.php");
     exit();
 }
 else
 {
     $cin = $_SESSION['userCIN'];
     $select = "SELECT * FROM client WHERE CIN = '$cin'";
     $stmt = $cnx->prepare($select);
     $stmt->execute();
     $row = $stmt->fetch();

         $img     = $row['Image'];
         $fname    = $row['Prenom'];
         $lname    = $row['Nom'];
         $city = $row['Ville'];
         $phone = $row['Tele'];
         $dateN     = $row['DateNaissance'];
         $address   = $row['Adresse'];
 }
 if(isset($_POST['editImage']))
 {
     if(isset($_FILES['profile']['name']) && !empty($_FILES['profile']['name']))
     {
         $cin = $_SESSION['userCIN'];
         $oldimg = $_POST['imgOld'];
         $getImgName = $_FILES['profile']['name'];
         $getImgtmp = $_FILES['profile']['tmp_name'];
         $imgExtension = @strtolower(end(explode(".",$getImgName)));
         $imgName = rand(1000000,99999999999)."_".$getImgName;
         $extensions = array('jpg','jpeg','png');
         if(in_array($imgExtension,$extensions))
         {
            $update = "UPDATE client SET Image = '$imgName' WHERE CIN = '$cin'";
            $stmt = $cnx->prepare($update);
            $stmt->execute();
            if($stmt)
            {
                if(file_exists("Images/uploads/profiles/$oldimg"))
                {
                    unlink("Images/uploads/profiles/$oldimg");
                }
                move_uploaded_file($getImgtmp,"Images/uploads/profiles/$imgName");
                echo "<script>window.open('profile.php','_self');</script>";
            }
        }
        else
        {
           echo "<script>alert('your image extension not approved!');</script>";
           echo "<script>window.open('profile.php','_self');</script>";
        }
        //  echo "<script>alert('$imgName');</script>";
        //  echo "<script>window.open('index.php?profile','_self');</script>";
     }
     else
     {
        // $oldimg = $_POST['imgOld'];
        // echo "<script>alert('$oldimg');</script>";
        echo "<script>window.open('index.php?profile','_self');</script>";
     }
 }
 if(isset($_POST['edit-addr']))
 {
     $cin = $_SESSION['userCIN'];
     $addr = $_POST['address'];
     $update = "UPDATE client SET Adresse='$addr' WHERE CIN = '$cin'";
     $stmt=$cnx->prepare($update);
     $stmt->execute();
     echo "<script>window.open('profile.php','_self');</script>";
 }
 if(isset($_POST['edit-desc']))
 {
     $cin = $_SESSION['userCIN'];
     $city = $_POST['city'];
     $phone = $_POST['phone'];
     $dateN = $_POST['dateN'];
     $update = "UPDATE client SET Ville='$city',Tele='$phone',DateNaissance='$dateN' WHERE CIN = '$cin'";
     $stmt=$cnx->prepare($update);
     $stmt->execute();
     echo "<script>window.open('profile.php','_self');</script>";
 }
 if(isset($_POST['edit-name']))
 {
     $cin = $_SESSION['userCIN'];
     $name = $_POST['username'];
     $expName = explode(" ",$name);
     $fname = ucfirst($expName[0]);
     $lname = ucfirst($expName[1]);
     $update = "UPDATE client SET Nom='$lname',Prenom='$fname' WHERE CIN = '$cin'";
     $stmt=$cnx->prepare($update);
     $stmt->execute();
     echo "<script>window.open('profile.php','_self');</script>";
 }
?>
    <!--Start Breadcrumb -->
<div class="Breadcrumb-content">
    <div class="box-breadcumb">
        <ul class="breadcrumb">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="profile.php" class="active">Profile</a></li>
        </ul>
    </div>
</div>
<!--End Breadcrumb -->
<!-- Start Profile -->
<div class="profile">
    <div class="title-head">
      <h5><i class="fa fa-edit"></i> Profile</h5>
    </div>
    <div class="content-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="profile-img-box">
                        <div class="imgs-box">
                            <img src="Images/uploads/profiles/<?php echo $img; ?>" alt=""/>
                            <form action="profile.php" method="POST" enctype="multipart/form-data">
                             <input type="file"  name="profile" class="upload"/>
                             <input type="hidden"  name="imgOld" value="<?php echo $img; ?>"/>
                             <input type="submit"  name="editImage" value="save" class="btn btn-info saveImg"/>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="profile-name-box">
                        <form action="profile.php" method="POST">
                            <h2 class="username" data-text="<?php echo $fname.' '.$lname; ?>"><?php echo $fname.' '.$lname; ?></h2>
                            <span class="edit-username"><i class="fa fa-edit"></i></span>
                            <span class="changeToSaveName"></span>
                            <span class="changeToCloseName"></span>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-description-box">
                                <form action="profile.php" method="POST">
                                    <p class="p-cin" data-text="<?php echo $cin; ?>"><i class="fa fa-address-card"></i> <span><?php echo $cin; ?></span></p>
                                    <p class="p-city" data-text="<?php echo $city; ?>"><i class="fa fa-map-marker"></i> <span><?php echo $city; ?></span></p>
                                    <p class="p-phone" data-text="<?php echo $phone; ?>"><i class="fa fa-phone"></i> <span><?php echo $phone; ?></span></p>
                                    <p class="p-dateN" data-text="<?php echo $dateN; ?>"><i class="fa fa-birthday-cake"></i> <span><?php echo $dateN; ?></span></p>
                                    <span class="edit-desc-box"><i class="fa fa-edit"></i></span>
                                    <span class="changeToSubmit"></span>
                                    <span class="changeToClose"></span>
                                 </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about">
                                <h4>ADRESSE</h4>
                                <p class="p-addr" data-text="<?php echo $address; ?>"><?php echo $address; ?></p>
                                <span class="edit-about"><i class="fa fa-edit"></i></span>
                            </div>
                            <script>
                                function closeAbout()
                                {
                                    var text = $('.txtarea-addr').val();
                                     $('#about-form').replaceWith("<p class='p-addr' data-text='"+text+"'>"+text+"</p>");
                                }
                                function closeName()
                                {
                                    var name = $('.input-name').val();
                                    $('.edit-username').fadeIn();
                                    $('.input-name').replaceWith("<h2 class='username' data-text='"+name+"'>"+name+"</h2>");
                                    $('.saveName').replaceWith("<span class='changeToSaveName'></span>");
                                    $('.closeName').replaceWith("<span class='changeToCloseName'></span>");
                                    // alert(name);
                                }
                                function closeDesc()
                                {
                                    var text_p_cin = $('.ch-input-cin').val();
                                    var text_p_city = $('.ch-input-city').val();
                                    var text_p_phone = $('.ch-input-phone').val();
                                    var text_p_dateN = $('.ch-input-dateN').val();

                                    $('.ch-input-cin').replaceWith("<p class='p-cin' data-text='"+text_p_cin+"'><i class='fa fa-address-card'></i> <span>"+text_p_cin+"</span></p>");
                                    $('.ch-input-city').replaceWith("<p class='p-city' data-text='"+text_p_city+"'><i class='fa fa-map-marker'></i> <span>"+text_p_city+"</span></p>");
                                    $('.ch-input-phone').replaceWith("<p class='p-phone' data-text='"+text_p_phone+"'><i class='fa fa-phone'></i> <span>"+text_p_phone+"</span></p>");
                                    $('.ch-input-dateN').replaceWith("<p class='p-dateN' data-text='"+text_p_dateN+"'><i class='fa fa-birthday-cake'></i> <span>"+text_p_dateN+"</span></p>");

                                    $('.saveDesc').replaceWith("<span class='changeToSubmit'></span>");
                                    $('.closeDesc').replaceWith("<span class='changeToClose'></span>");
                                }
                            </script>
                            <!-- <span class="btn btn-info" onclick='closeAbout()'>Click</span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->
