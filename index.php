<?php 
 $active='home';
 include("includes/templates/header.php");
// $numLett = array("One","Two","Three","Four","Five","Six","Seven","Eight");
//  for($i=0;$i<8;$i++)
//  {
//      $l = $numLett[$i];
//      $p = $i+1;
//      $query = "INSERT INTO produit(Name,Prix,IDCategorie,Image,description) VALUES('Salade sal$l','120',3,'s$p.jpg','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi provident delectus fugiat, corporis nemo vel asperiores pariatur assumenda nulla, adipisci quaerat libero, repellat temporibus consequuntur autem harum dolorem sapiente impedit. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi provident delectus fugiat, corporis nemo vel asperiores pariatur assumenda nulla, adipisci quaerat libero, repellat temporibus consequuntur autem harum dolorem sapiente impedit.')";
//      $stmt = $cnx->prepare($query);
//      if($stmt->execute())
//      {
//          echo "yes";
//      }
//  }

?>
<!--Start Front Section -->
<div class="front-section">
    <div class="row">
        <div class="col-6">
            <img src="Images/home/undraw_personal_trainer_re_cnua.svg" alt=""/>
        </div>
        <div class="col-6">
            <div class="description">
                <h6>MEILLEURS PRIX</h6>
                <h2>Nouveaux Produits</h2>
                <p>Nous reconnaissons que devenir Fit ne s’improvise pas. C’est quelque chose qui s’apprend, s’accompagne et se transmet.</p>
                <a href="about.php" class="btn btn-danger">Lire plus</a>
            </div>
        </div>
    </div>
</div>
<!--End Front Section -->

<!--Start Presentation Boxes Section -->
<div class="presentation-boxes">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <i class="fa fa-truck"></i>
                    <h6>Livraison gratuite à travers le monde</h6>
                    <p>À tout moment et en tout lieu</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <i class="fa fa-map"></i>
                    <h6>Support 24/7</h6>
                    <p>Contactez-nous 24h/24</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <i class="fa fa-check"></i>
                    <!-- <i class="far fa-hand-peace"></i> -->
                    <h6>Produits 100% sécurisés</h6>
                    <p>Votre commande est en sécurité avec nous</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Presentation Boxes Section -->

<!--Start Best Products Section-->
<div class="best-products">
    <div class="chose-list">
        <ul class="list-unstyled">
            <li class="active" data-target="vitamines">Vitamines</li>
            <li data-target="antioxydants">Antioxydants</li>
            <li data-target="protéines">Protéines </li>
        </ul>
        <a href="shop.php" style="position: absolute;top: 0px;right: 10%;color: #ff4444;">Voir tous</a>
    </div>
    <div class="container">
        <div class="vitamines boss-box">
            <div class="row">
            <?php
             $query = "SELECT * FROM produit WHERE IDCategorie = 1 LIMIT 8";
             get_Eight_Products_List($query);
            ?>
            </div>
        </div>
        <div class="antioxydants boss-box">
            <div class="row">
            <?php
             $query = "SELECT * FROM produit WHERE IDCategorie = 2 LIMIT 8";
             get_Eight_Products_List($query);
            ?>
            </div>
        </div>
        <div class="protéines boss-box">
            <div class="row">
            <?php
             $query = "SELECT * FROM produit WHERE IDCategorie = 4 LIMIT 8";
             get_Eight_Products_List($query);
            ?>
            </div>
        </div>
    </div>
</div>
<!--End Best Products Section-->

<!--Start Partnership-->
<div class="partnership text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="box">
                    <img src="Images/partnership/1.png" alt=""/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box">
                    <img src="Images/partnership/2.png" alt=""/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box">
                    <img src="Images/partnership/3.png" alt=""/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box">
                    <img src="Images/partnership/4.png" alt=""/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box">
                    <img src="Images/partnership/5.png" alt=""/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box">
                    <img src="Images/partnership/6.png" alt=""/>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Partnership-->
<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->
