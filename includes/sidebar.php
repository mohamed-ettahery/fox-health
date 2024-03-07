<!--Start Sidebar -->
<div class="sidebar">
    <!--Start Products Category -->
    <div class="panel">
        <div class="panel-header">
            <h5 class="panel-title">Categories</h5>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
            <li <?php if(!isset($_GET['idcat'])){echo "class='active'";} ?>><a href="<?php echo $_SERVER['PHP_SELF']; ?>" >Tous</a><span class="products-count"><?php 
              $countPro = count(get_From("*","produit"));
              echo $countPro;
            ?> produits</span></li>
            <?php
             $cats = get_From("*","categorie");
             foreach($cats as $cat)
             {
                 $cat_id = $cat['ID'];
                 $cat_name = $cat['Nom'];
                 $countPro = count(get_From("*","produit","WHERE IDCategorie = $cat_id"));
                 ?>
                   <li <?php if(isset($_GET['idcat'])&&$_GET['idcat']==$cat_id){echo "class='active'";} ?>><a href="shop.php?idcat=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a><span class="products-count"><?php echo $countPro; ?> produits</span></li>
                 <?php
             } 
            ?>
            </ul>
        </div>
    </div>
    <!--End Products Category -->
        <!--Start  Best Sale -->
        <?php
        $bestSalePro = get_From("*","produit","ORDER BY rand() ASC LIMIT 1");
        foreach($bestSalePro as $pro)
        {
            $p_id = $pro['id'];
            $p_name = $pro['Name'];
            $p_price = $pro['Prix'];
            $p_img = $pro['Image'];
            $promotion_p = $pro['Promotion'];
            $rating_p = $pro['Rating'];
            $calc_promo = $p_price * ($promotion_p/100);
            $finalPrice = $p_price-$calc_promo;
            ?>
                <div class="panel panel-best-sale">
                    <div class="panel-header">
                        <h5 class="panel-title"> Meilleure vente</h5>
                    </div>
                    <div class="panel-body">
                    <p class="desc">
                      c'est notre produit le plus vendu.
                    </p>
                    <div class="img-box">
                        <img src="admin/img/products/<?php echo $p_img; ?>" alt=""/>
                    </div>
                    <h6 class="product-title"><?php echo $p_name; ?></h6>
                    <span class="price">$<?php echo $finalPrice; ?></span><?php if($promotion_p!=0){ ?> <span class="old-price text-danger" style="font-size: 14px;text-decoration: line-through;">$<?php echo $p_price ?></span><?php } ?><span class="add"><a href="details.php?pid=<?php echo $p_id; ?>">Add</a></span>
                    </div>
                </div>
            <?php
        }
        ?>
</div>
<!--End Sidebar -->
