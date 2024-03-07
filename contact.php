<?php
 $active='contact';
 include("includes/templates/header.php");
?>
<!--Start Breadcrumb -->
<div class="Breadcrumb-content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
            </ul>
        </div>
    </div>
</div>
<!--End Breadcrumb -->
<div class="contact-us">
<div class="background">
  <div class="container">
    <div class="screen">
      <div class="screen-header">
        <div class="screen-header-left">
          <div class="screen-header-button close"></div>
          <div class="screen-header-button maximize"></div>
          <div class="screen-header-button minimize"></div>
        </div>
      </div>
      <div class="screen-body">
        <div class="screen-body-item left">
          <div class="app-title">
            <span>CONTACT</span>
          </div>
          <div class="app-contact">CONTACT INFO : +212 81 314 928 595</div>
        </div>
        <div class="screen-body-item">
          <?php
            require 'includes/mailer/SMTP.php';
            require 'includes/mailer/PHPMailer.php';
            require 'includes/mailer/Exception.php';

            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
           if(isset($_POST['send']))
           {
             if(isset($_SESSION['user']))
             {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $msg = $_POST['msg'];
  
                $mail = new PHPMailer(true);
 
                try {
                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'Your Email';                     //SMTP username
                    $mail->Password   = 'Your Password';                               //SMTP password
                    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
                    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
                    //Recipients
                    $mail->setFrom('Your Email');
                    $mail->addAddress('Email');     //Add a recipient
                    // $mail->addAddress('ellen@example.com');               //Name is optional
                    // $mail->addReplyTo('info@example.com', 'Information');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
    
                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = "from : $email";
                    $mail->Body    = " Name : $name <br/> Phone : $phone <br/> Message : $msg";
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
                    $mail->send();
                    echo "<script>alert('Votre Message a été Bien Envoyer ! Merci.');</script>";
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
             echo "<script>window.open('contact.php','_self');</script>";
             }
             else
             {
              echo "<script>window.open('login.php','_self');</script>";
             }    
             
           }
          ?>
          <form action="" method="POST">
            <div class="app-form">
              <div class="app-form-group">
                <input class="app-form-control" name="name" placeholder="NOM" required>
              </div>
              <div class="app-form-group">
                <input class="app-form-control" name="email" placeholder="EMAIL" required>
              </div>
              <div class="app-form-group">
                <input class="app-form-control" name="phone" placeholder="TELE" required>
              </div>
              <div class="app-form-group message">
                <input class="app-form-control" name="msg" placeholder="MESSAGE" required>
              </div>
              <div class="app-form-group buttons">
                <!-- <button  class="app-form-button">CANCEL</button> -->
                <input type="reset" class="app-form-button" value="Reset"/>
                <button type="submit" name="send" class="app-form-button">Envoyer</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->
