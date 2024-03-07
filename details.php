<?php 
 $active='shop';
 include("includes/templates/header.php");
 $pid = isset($_GET['pid']) && is_numeric($_GET['pid']) ?$_GET['pid']:0;
 $query = "SELECT * FROM produit WHERE id = $pid";
 $stmt = $cnx->prepare($query);
 $stmt->execute();
 if($stmt->rowCount() > 0)
 {
     $product = $stmt->fetchAll();
     foreach($product as $product)
     {
         $name_p = $product['Name'];
         $id_p = $product['id'];
         $price_p = $product['Prix'];
         $desc_p = $product['description'];
         $img_p = $product['Image'];
         $idcat_p = $product['IDCategorie'];
         $promotion_p = $product['Promotion'];
         $rating_p = $product['Rating'];
         $calc_promo = $price_p * ($promotion_p/100);
         $finalPrice = $price_p-$calc_promo;
     }
 }
 else
 {
    //  header("location:index.php");
    echo "<script>window.open('index.php','_self');</script>";
     exit();
 }
?>
<!--Start Breadcrumb -->
<div class="Breadcrumb-content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="shop.php" class="active">Details</a></li>
            </ul>
        </div>
    </div>
</div>
<!--End Breadcrumb -->

<!-- Start Details Page -->
<div class="details">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="img-box" style="height: 100%;width: 100%;">
                        <!-- Start Slider-->
                        <div class="product-slider" style="height: 100%;width: 100%;">
                            <div id="main-slide" style="height: 100%;width: 100%;" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" style="height: 100%;width: 100%;">
                                    <div class="carousel-item carousel-one active" style="height: 100%;width: 100%;">
                                        <img src="admin/img/products/<?php echo $img_p; ?>" alt=""/>
                                    </div>
                                    <div class="carousel-item carousel-two" style="height: 100%;width: 100%;">
                                        <img src="admin/img/products/<?php echo $img_p; ?>" alt=""/>
                                    </div>
                                    <div class="carousel-item carousel-three" style="height: 100%;width: 100%;">
                                        <img src="admin/img/products/<?php echo $img_p; ?>" alt=""/>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- End Slider-->
                </div>
            </div>
            <?php
             if(isset($_POST['add_cart']))
             {
                add_cart();
             }
             elseif(isset($_POST['buyit_now']))
             {
                 $id = $id_p;
                 $name = $name_p;
                 $price = $price_p;
                 $qty = $_POST['qty'];
                
                 echo "<script>window.open('confirm_unique_product_order.php?p_id=$id&n=$name&p=$price&q=$qty','_self');</script>";
             }
            ?>
            <div class="col-md-6">
                <div class="content-box">
                    <h2 class="product-title"><?php echo $name_p;?></h2>
                    <p class="prices"><span class="new-price">$<?php echo $finalPrice; ?></span><?php if($promotion_p!=0){ ?> <span class="old-price text-danger" style="font-size: 14px;">$<?php echo $price_p ?></span><?php } ?></p>
                    <ul class="list-unstyled stars">
                        <?php
                            for($i=0;$i<$rating_p;$i++)
                            {
                                ?>
                                <li><i class="fa fa-star text-warning"></i></li>

                                <?php
                            } 
                        ?>
                    </ul>
                    <p class="product-description">
                       <?php echo $desc_p;?>
                    </p>
                    <form action="details.php?add_cart=<?php echo $id_p ?>&pid=<?php echo $id_p ?>" method="POST">
                      <div class="count">
                          <span class="mince-count"><i class="fa fa-minus"></i></span><input type="number" value="1" min="1" max="5" name="qty" class="form-control count-input"/><span class="plus-count"><i class="fa fa-plus"></i></span>
                        </div>
                        <div class="box-add-btns">
                            <input type="submit" name="add_cart" value="Ajouter au panier" class="btn btn-danger add-cart"/>
                            <input type="submit" name="buyit_now" value="Acheter maintenant!" class="btn btn-dark buyit-now"/>
                            <!-- <button type="button" name="buyit_now" class="btn btn-dark buyit-now"><a href="confirm_addr_order.php" style="text-decoration: none;color: #FFF;">Buy it now!</a></button> -->
                        </div>
                      <!-- <input type="submit" name="buyit_now" value="Buy it now!" class="btn btn-dark buyit-now"/> -->
                    </form>
                </div>
            </div>
            <div class="col-12">
                <div class="container">
                    <div class="more-details">
                        <h3>Plus de détails</h3>
                        <p>
                            <?php echo $desc_p; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="container">
                    <div class="similar-products">
                        <h3>Produits similaires</h3>
                        <div class="row">
                            <?php
                             $query="SELECT * FROM produit WHERE IDCategorie = $idcat_p ORDER BY rand() LIMIT 0,4";
                             $stmt = $cnx->prepare($query);
                             $stmt->execute();
                             $products = $stmt->fetchAll();
                             foreach($products as $product)
                             {
                                 $img_p = $product["Image"];
                                 $id_p = $product["id"];
                                 $name_p = $product["Name"];
                                 $peice_p = $product["Prix"];
                                 $promotion_p = $product['Promotion'];
                                 $rating_p = $product['Rating'];
                                 $calc_promo = $price_p * ($promotion_p/100);
                                 $finalPrice = $price_p-$calc_promo;
                                 ?>
                                    <div class="col-md-3">
                                        <div class="box">
                                            <div class="img-box">
                                            <img src="admin/img/products/<?php echo $img_p; ?>" alt="<?php echo $name_p; ?>"/>
                                            </div>
                                            <h6 class="product-title"><?php echo $name_p; ?></h6>
                                            <span class="price">$<?php echo $finalPrice; ?></span><?php if($promotion_p!=0){ ?> <span class="old-price text-danger" style="font-size: 14px;text-decoration: line-through">$<?php echo $price_p ?></span><?php } ?><span class="add"><a href="details.php?pid=<?php echo $id_p; ?>">Add</a></span>
                                        </div>
                                    </div>
                                 <?php
                             }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Details Page -->

<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->
