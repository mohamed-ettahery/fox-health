<?php
$active = "Confirm";
// session_start();
include("includes/templates/header.php");
if(!isset($_SESSION['user']))
{
    // header("Location: login.php");
    echo "<script>window.open('login.php','_self');</script>";
    exit();
}
else
{
    $countCART = getCount("cart","WHERE ip_addr = '$ip'");
    if($countCART < 1)
    {
        // header("Location:index.php");
        echo "<script>window.open('index.php','_self');</script>";
        exit();
    }
    else
    {
        $cin = $_SESSION['userCIN'];
        $row =  get_From("*","client","WHERE CIN = '$cin'");
        foreach($row as $person)
        {
            $city = $person["Ville"];
            $phone = $person["Tele"];
            $addr = $person["Adresse"];
        }
    }
}
if(isset($_POST['confirm']))
{
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $addr = $_POST["address"];

    if(UpdateElements("client","Ville = '$city',Tele = '$phone',Adresse = '$addr'","WHERE CIN = '$cin'"))
    {
        if(InsertElements("commande","CinClient","'$cin'"))
        {
            $NumCmnd = get_From("MAX(Numero) as 'Num'","commande","WHERE CinClient = '$cin'");
            foreach($NumCmnd as $num)
            {
                $Num = $num['Num'];
            }
           $rows = get_From("*","cart","WHERE ip_addr = '$ip'");
           foreach($rows as $row)
           {
               $pro_id = $row['p_id'];
               $pro_qty = $row['qty'];
               InsertElements("detailcommande","NumCommande,Quantite,ReferenceProduit","'$Num','$pro_qty','$pro_id'");
           }
           if(DeleteElements("cart","ip_addr","'$ip'"))
           {
               echo "<script>window.open('pdf/invoice.php?invoice=$Num','_self');</script>";
           }
        //    echo "<script>window.open('".$_SERVER["PHP_SELF"]."','_self');</script>";
        }
        else
        {
            echo "<script>alert('Failed');</script>";
        }
    }
    else
    {
        echo "<script>alert('Maybe Theres An Error!');</script>";
    }
}
?>
<!-- Start Confirm addr Order -->
<div class="confirm-addr-order">
    <h2>Confirmation de commande</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum unde nihil molestiae deserunt at maiores culpa amet officiis nesciunt quae, veritatis voluptatibus dolor explicabo quo, exercitationem ipsam facilis aperiam! Fugit.</p>
  <form action="" method="POST">
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="inputCity">Ville</label>
        <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" maxlength="20" id="inputCity" placeholder="casablanca"/>
        </div>
        <div class="form-group col-md-6">
        <label for="inputPhone">Télé</label>
        <input type="tel" class="form-control" name="phone" value="<?php echo $phone; ?>" id="inputPhone" placeholder="06287 .....">
        </div>
    </div>
    <div class="form-group">
        <label for="inputAddress">Adresse</label>
        <input type="text" class="form-control" name="address" value="<?php echo $addr; ?>" id="inputAddress" placeholder="1234 Main St">
    </div>
    <div class="row div-btns">
        <div class="col-6">
          <a href="cart.php" class="btn btn-light"><i class="fa fa-chevron-left"></i> Retour</a>
        </div>
        <div class="col-6">
          <button type="submit" name="confirm" class="btn btn-danger" style="float:right;">Confirmer la commande <i class="fa fa-chevron-right"></i></button>            
        </div>
    </div>
  </form>
</div>
<!-- End Confirm addr Order -->

<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->
