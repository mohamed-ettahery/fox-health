<?php 
 $active='mustpop';
 include("includes/templates/header.php");
?>
<!--Start Breadcrumb -->
<div class="Breadcrumb-content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="mustpopular.php" class="active">Plus Populaire</a></li>
            </ul>
        </div>
    </div>
</div>
<!--End Breadcrumb -->
<!-- Start Must Popular Page-->
<div class="must-popular">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php include("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-9">
                <div class="content">
                    <?php
                    $query = "SELECT produit.id,produit.Name,produit.Image,produit.Prix,produit.description,produit.Promotion,produit.Rating,COUNT(detailcommande.ReferenceProduit) as 'count' FROM produit 
                    INNER JOIN detailcommande ON detailcommande.ReferenceProduit = produit.id
                    GROUP BY produit.id,produit.Name
                    ORDER BY count DESC LIMIT 5";
                    $stmt = $cnx->prepare($query);
                    $stmt->execute();
                    $products = $stmt->fetchAll();

                    foreach($products as $product)
                    {
                        $id_p = $product['id'];
                        $img_p = $product['Image'];
                        $name_p = $product['Name'];
                        $price_p = $product['Prix'];
                        $promotion_p = $product['Promotion'];
                        $desc_p = $product['description'];
                        $rating_p = $product['Rating'];
                        $calc_promo = $price_p * ($promotion_p/100);
                        ?>

                            <div class="pop-product">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="img-box">
                                        <img src="admin/img/products/<?php echo $img_p; ?>" alt="" />
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc-info">
                                        <h3 class="title"><?php echo $name_p; ?></h3>
                                        <p class="prices"><span class="new-price">$<?php echo $price_p-$calc_promo; ?></span> <?php if($promotion_p!=0){ ?> <span class="old-price text-danger">$<?php echo $price_p ?></span><?php } ?></p>
                                        <div class="description"><?php echo $desc_p; ?></div>
                                        <a href="details.php?pid=<?php echo $id_p;?>" class="add-btn">Add</a>
                                    </div>
                                </div>
                            
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
<!-- End Must Popular-->

<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->
