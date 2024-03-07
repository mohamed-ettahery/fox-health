<?php 
 $active='shop';
 include("includes/templates/header.php");
//  $pr=get_From("*","categorie","WHERE id = 1");
//  print_r($pr);
?>
<!--Start Breadcrumb -->
<div class="Breadcrumb-content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="shop.php" class="active">Produits</a></li>
            </ul>
        </div>
    </div>
</div>
<!--End Breadcrumb -->
<!-- Start Shop Page-->
<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php include("includes/sidebar.php"); ?>
            </div>
            <div class="col-md-9">
                <div class="content">
                    <div class="row">
                        <?php
                        $start = isset($_GET['page'])&&is_numeric($_GET['page'])&&intval($_GET['page'])>1?(intval($_GET['page']) - 1)*9:0;
                        $whereIDCat = isset($_GET['idcat'])&& is_numeric($_GET['idcat'])?"WHERE IDCategorie = {$_GET['idcat']}":NULL;
                        $query = "SELECT * FROM produit $whereIDCat ORDER BY 1 ASC LIMIT $start,9";
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
                            $rating_p = $product['Rating'];
                            $calc_promo = $price_p * ($promotion_p/100);
                            ?>
                                <div class="col-md-4">
                                    <div class="product-box">
                                         <?php if($promotion_p!=0)
                                         {
                                             ?>
                                            <span class="reduction">
                                                -<?php echo $promotion_p ?>%
                                            </span>
                                             <?php
                                         } ?>

                                            <div class="img-box">
                                                <img src="admin/img/products/<?php echo $img_p; ?>" alt=""/>
                                            </div>
                                            <div class="description">
                                                <h6 class="product-title"><?php echo $name_p; ?></h6>
                                                <ul class="list-unstyled list-stars">
                                                    <?php
                                                      for($i=0;$i<$rating_p;$i++)
                                                      {
                                                          ?>
                                                            <li><i class="fa fa-star"></i></li>

                                                          <?php
                                                      } 
                                                    ?>
                                                </ul>
                                                <p class="prices"><span class="new-price">$<?php echo $price_p-$calc_promo; ?></span><?php if($promotion_p!=0){ ?><span class="old-price">$<?php echo $price_p ?></span><?php } ?></p>
                                                <a href="details.php?pid=<?php echo $id_p; ?>" class="btn btn-danger">View details</a>
                                            </div>
                                    </div>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!--Start Pagination -->
                    <div class="box-pagination">
                       <ul class="pagination">
                           <?php
                            // $count = getCount("produit");
                            $count =isset($_GET['idcat'])&&is_numeric($_GET['idcat'])? getCount("produit","WHERE idCategorie ={$_GET['idcat']}"):getCount("produit");
                            $res = ceil($count/9);
                            $page = isset($_GET['page'])&&is_numeric($_GET['page'])&&intval($_GET['page'])<=$res?intval($_GET['page']):1;
                            if($res>1)
                            {
                                $idcat = isset($_GET['idcat'])&&is_numeric($_GET['idcat'])?intval($_GET['idcat']):"";
                                echo "<li><a href='?page=1&idcat=$idcat'";
                                  if($page == 1)
                                  {
                                      echo "class='active'";
                                  }
                                 echo ">First</a><li>";
                                for($i=2;$i<$res;$i++)
                                {
                                    echo "<li><a href='?page=$i&idcat=$idcat'";
                                        if($page == $i)
                                        {
                                            echo "class='active'";
                                        }
                                    echo ">$i</a><li>";
                                }
                                echo "<li><a href='?page=$res&idcat=$idcat'";
                                    if($page == $res)
                                    {
                                        echo "class='active'";
                                    }
                                echo ">Last</a><li>";
                            }
                           ?>
                       </ul>
                    </div>
                    <!--End Pagination -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Shop Page-->

<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->
