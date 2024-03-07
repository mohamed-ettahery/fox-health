<?php

//function use it for return user IP
function getIP()
{
    switch (true) {
        case (!empty($_SERVER['HTTP_X_REAL_IP'])):
            return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])):
            return $_SERVER['HTTP_CLIENT_IP'];
        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        default:
            return $_SERVER["REMOTE_ADDR"];
    }
}

//function use it for add products in cart
function add_cart()
{
    global $cnx;
    if (isset($_GET['add_cart'])) {
        $id_p = $_GET['add_cart'];
        $ip   =  getIP();
        $qty  = $_POST['qty'];

        $query = "SELECT * FROM cart WHERE p_id = $id_p AND ip_addr = '$ip'";
        $stmt = $cnx->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {

            echo
            "<script>
                swal({
                    title: 'Notice!',
                    text: 'this product already added in your cart.',
                    icon: 'error'
                }).then(() => {
                    window.open('details.php?pid=$id_p','_self');
                });
            </script>";
            // echo "<script>alert('this product already added in your cart.')</script>";
            // echo "<script>window.open('details.php?pid=$id_p','_self')</script>";
        } else {
            $insert_query = "INSERT INTO cart VALUES($id_p,$qty,'$ip')";
            $stmt = $cnx->prepare($insert_query);
            if ($stmt->execute()) {
                echo
                "<script>
                    swal({
                        title: 'Added!',
                        text: 'product added in your cart!',
                        icon: 'success'
                    }).then(() => {
                        window.open('details.php?pid=$id_p','_self');
                    });
                </script>";

                // echo "<script>alert('product added in your cart.')</script>";
                // echo "<script>window.open('details.php?pid=$id_p','_self')</script>";
            }
        }
    }
}

//Function use it for Select The best 8 products in any category from our categories.
function get_Eight_Products_List($query)
{
    global $cnx;
    // $query = "SELECT * FROM produit WHERE IDCategorie = 1 LIMIT 8";
    $stmt = $cnx->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll();
    foreach ($products as $product) {
        $id_p = $product['id'];
        $img_p = $product['Image'];
        $name_p = $product['Name'];
        $price_p = $product['Prix'];
        $promotion_p = $product['Promotion'];
        $rating_p = $product['Rating'];
        $calc_promo = $price_p * ($promotion_p / 100);
?>
        <div class="col-md-3">
            <div class="product-box">
                <?php if ($promotion_p != 0) {
                ?>
                    <span class="reduction">
                        -<?php echo $promotion_p ?>%
                    </span>
                <?php
                } ?>

                <div class="img-box">
                    <img src="admin/img/products/<?php echo $img_p; ?>" alt="" />
                </div>
                <div class="description">
                    <h6 class="product-title"><?php echo $name_p; ?></h6>
                    <ul class="list-unstyled list-stars">
                        <?php
                        for ($i = 0; $i < $rating_p; $i++) {
                        ?>
                            <li><i class="fa fa-star"></i></li>

                        <?php
                        }
                        ?>
                    </ul>
                    <p class="prices"><span class="new-price">$<?php echo $price_p - $calc_promo; ?></span><?php if ($promotion_p != 0) { ?><span class="old-price">$<?php echo $price_p ?></span><?php } ?></p>
                    <a href="details.php?pid=<?php echo $id_p; ?>" class="btn btn-danger">Voir détails</a>
                </div>
            </div>
        </div>
<?php

    }
}

//Function getCount use it for get Numbers of rows in any table
function getCount($tbl = NULL, $where = NULL)
{
    global $cnx;
    $query = "SELECT * FROM $tbl $where";
    $stmt = $cnx->prepare($query);
    $stmt->execute();
    $count = $stmt->rowCount();
    return $count;
}

//Function getCats use it for get All Categories
function getCats()
{
    global $cnx;
    $query = "SELECT * FROM categorie";
    $stmt = $cnx->prepare($query);
    $stmt->execute();
    $cats = $stmt->fetchAll();
    return $cats;
}

//function get_From use it for Selected rows or clomumns from any table
function get_From($select = "*", $tbl = NULL, $where = NULL)
{
    global $cnx;
    $query = "SELECT $select FROM $tbl $where";
    $stmt = $cnx->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

//function use it for get current page title
function getTitle()
{
    global $active;
    if (isset($active)) {
        echo $active;
    } else {
        echo 'Default';
    }
}

//function use it for Check Element if exist or no
function CheckElement($select = NULL, $table = NULL, $where = NULL)
{
    global $cnx;
    $statement = $cnx->prepare("SELECT $select FROM $table $where");
    $statement->execute();
    $count = $statement->rowCount();
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

//function use it for update Elements
function UpdateElements($table = NULL, $keyAndVal = NULL, $where = NULL)
{
    global $cnx;
    $statement = $cnx->prepare("UPDATE $table SET $keyAndVal $where");
    if ($statement->execute()) {
        return true;
    } else {
        return false;
    }
}
//function use it for Insert Elements
function InsertElements($table = NULL, $specTblValues = NULL, $values = NULL)
{
    global $cnx;
    $statement = $specTblValues == NULL ? $cnx->prepare("INSERT INTO $table VALUES($values)") : $cnx->prepare("INSERT INTO $table($specTblValues) VALUES($values)");
    if ($statement->execute()) {
        return true;
    } else {
        return false;
    }
}

//function use it for Delete Elements
function DeleteElements($table = NULL, $champ = NULL, $value = NULL)
{
    global $cnx;
    $statement = $cnx->prepare("DELETE FROM $table WHERE $champ = $value");
    if ($statement->execute()) {
        return true;
    } else {
        return false;
    }
}
?>