<?php
// echo "<script>swal('Hello world!');
// </script>";
// echo checkItem("categorie","ID",2)==true?"<script>aleft('kayn')</script>":"<script>alert('makaynch')</script>";
?>
<!-- <script>
    swal({
    title: 'Failed!',
    text: 'This Name already Exist!',
    icon: 'error'
    })
    .then(() => {
    window.open("?page=products&temp=add",'_self');
});
</script> -->
<div class="container-fluid products">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 tt">Products</h1>
    </div>
    <?php
     $temp = isset($_GET["temp"]) ? $_GET["temp"]:"view-products";
     switch($temp)
     {
         case "view-products":
            ?>
                    <!--Start View Products -->
                    <div class="view-products">
                        <div class="container">
                            <div class="table-section">
                                <table class="table table-view-products text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Categorie</th>
                                            <th scope="col">Prix</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $product = new Products();
                                        $products = $product->getAllProducts();
                                        foreach($products as $product)
                                        {
                                            $p_id = $product['id'];
                                            $p_img = $product['Image'];
                                            $p_name = $product['name'];
                                            $p_cat = $product['catName'];
                                            $p_price = $product['price'];
                                            $p_desc = $product['description'];
                                            ?>
                                                <tr>
                                                    <td>
                                                        <img src="img/products/<?php echo $p_img; ?>"/>
                                                    </td>
                                                    <td style="padding-top: 3%;"><?php echo $p_name; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $p_cat; ?></td>
                                                    <td style="padding-top: 3%;">$<?php echo $p_price; ?></td>
                                                    <td><textarea readOnly><?php echo $p_desc; ?></textarea></td>
                                                    <td>
                                                            <a href="?page=products&temp=edit&pid=<?php echo $p_id; ?>" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i></a>
                                                            <a href="?page=products&temp=delete&pid=<?php echo $p_id; ?>" class="confirm-delete btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="add-new-box">
                                <a href="?page=products&temp=add" class="btn btn-success"><i class="fas fa-plus-circle"></i> Ajouter un nouveau produit</a>
                            </div>
                        </div>
                    </div>
                    <!-- End View Products -->
            <?php
            break;
        case "add":
            ?>
                    <!--Start Add Products -->
                    <div class="add-products">
                        <div class="container">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="img-file" class="imgFile-label"><i class="fal fa-file-upload"></i> Choose an image</label>
                                            <input style="display:none;" accept="image/*" type="file" id="img-file" name="img" class="form-control" name="img" placeholder="test" required>
                                            <img class="new-img-insert" src="img/Upload.png"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" id="addproCat" name="cat" required>
                                          <option value="0" selected>Select Category:</option>
                                            <?php
                                             foreach(getCats() as $cat)
                                             {
                                                 $cat_id=$cat["ID"];
                                                 $cat_name=$cat["Nom"];
                                                 ?>
                                                   <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                                                 <?php
                                             } 
                                            ?>
                                        </select>
                                        <input type="text"  name="name" id="addproName" class="form-control" placeholder="Nom produit" required>
                                        <input type="number" name="price" id="addproPrice" class="form-control" placeholder="Prix produit" required>
                                        <input type="number" name="promotion" id="addproPromotion" class="form-control" placeholder="Promotion produit" required>
                                        <input type="number" name="rating" id="addproRating" class="form-control" placeholder="Rating" required>
                                        <label for="desc">Product Description</label>
                                        <textarea id="desc" name="desc" id="addproDesc" class="tinymce"></textarea>
                                        <button type="submit" class="btn btn-success add-btn" id="add-product-btn" name="add-product"><i class="fas fa-check-circle"></i> Ajouter produit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script>
                            const input = document.getElementById('img-file');

                            input.addEventListener('change', function (e) {
                                const reader = new FileReader()
                                reader.onload = function () {
                                var src = reader.result
                                $('.new-img-insert').attr("src",src);
                                }
                                reader.readAsDataURL (input.files [0]) 
                            }, false);
                        </script>
                        <?php
                        if(isset($_POST['add-product']))
                        {
                            $name = $_POST['name'];
                            $price = $_POST['price'];
                            $desc = $_POST['desc'];
                            $cat = $_POST['cat'];
                            $promotion = $_POST['promotion'];
                            $rating = $_POST['rating'];
                            $getImgName = $_FILES['img']['name'];
                            $getImgtmp = $_FILES['img']['tmp_name'];
                            $imgExtension = @strtolower(end(explode(".",$getImgName)));
                            $imgName = rand(1000000,99999999999)."_".$getImgName;
                            $extensions = array('jpg','jpeg','png');
                            if(!checkItem("produit","Name",$name))
                            {
                                if(in_array($imgExtension,$extensions))
                                {
                                    $product = new Products();
                                    $product->ProductProperties($name,$price,$cat,$imgName,$desc,$promotion,$rating);
                                    if($product->addProduct())
                                    {
                                        move_uploaded_file($getImgtmp,"img/products/$imgName");
                                        echo 
                                        "<script>
                                            swal({
                                                title: 'Success!',
                                                text: 'Product has been Added Successfuly!',
                                                icon: 'success'
                                            }).then(() => {
                                                // window.open('?page=products&temp=add','_self');
                                                window.open('?page=products','_self');
                                            });
                                        </script>";
                                    }
                                }
                                else
                                {
                                    echo
                                    "<script>
                                        swal({
                                            title: 'Failed!',
                                            text: 'There\'s a wrong in Image Extension!',
                                            icon: 'error'
                                        }).then(() => {
                                            window.open('?page=products&temp=add','_self');
                                        });
                                    </script>";
                                }
                            }
                            else
                            {
                                echo 
                                "<script>
                                    swal({
                                        title: 'Failed!',
                                        text: 'This Name already Exist!',
                                        icon: 'error'
                                    }).then(() => {
                                        window.open('?page=products&temp=add','_self');
                                    });
                                </script>";
                            }
                        }
                        ?>
                    </div>
                    <!--End Add Products -->
            <?php
            break;
        case "delete":
            // Start delete Product
            $p_id = isset($_GET['pid']) && is_integer(intval($_GET['pid']))?intval($_GET['pid']):0;
            
            if(checkItem("produit","id",$p_id))
            {
                foreach(getFrom("produit","Image","WHERE id = $p_id") as $row)
                {
                    $image = $row['Image'];
                }
                if(file_exists("img/products/$image"))
                {
                    unlink("img/products/$image");
                }
                $product = new Products();
                if($product->removeProduct($p_id))
                {
                    echo 
                    "<script>
                        swal({
                            title: 'Success!',
                            text: 'Product has been Deleted Successfuly!',
                            icon: 'success'
                        }).then(() => {
                            window.open('?page=products','_self');
                        });
                    </script>";
                }
                else
                {
                    echo 
                    "<script>
                        swal({
                            title: 'Erroe!',
                            text: 'There's somthing wrong!',
                            icon: 'error'
                        }).then(() => {
                            window.open('?page=products','_self');
                        });
                    </script>";
                }
            }
            else
            {
                echo 
                "<script>
                    swal({
                        title: 'Error!',
                        text: 'This Product Not Exist!',
                        icon: 'error'
                    }).then(() => {
                        window.open('?page=products','_self');
                    });
                </script>";
            }

            // End delete Product
            break;
        case "edit":
            $p_id = isset($_GET['pid']) && is_integer(intval($_GET['pid']))?intval($_GET['pid']):0;
            if(checkItem("produit","id",$p_id))
            {
                $product = new Products();
                $product = $product->getProduct($p_id);
                $p_name = $product['name'];
                $p_price = $product['price'];
                $p_desc = $product['description'];
                $p_catID = $product['idCat'];
                $p_promotion = $product['Promotion'];
                $p_rating = $product['Rating'];
                $p_img = $product['Image'];
             ?>
                <!--Start Edit Products -->
                <div class="edit-products">
                    <div class="container">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <label for="img-file" class="imgFile-label"><i class="fal fa-file-upload"></i> Choose an image</label>
                                        <input style="display:none;" accept="image/*" type="file" id="img-file" name="img" class="form-control" name="img">
                                        <img class="new-img-insert" src="img/products/<?php echo $p_img; ?>"/>
                                        <input type="hidden" name="oldImg" value="<?php echo $p_img;?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" id="addproCat" name="cat" required>
                                        <option value="0">Select Category:</option>
                                        <?php
                                            foreach(getCats() as $cat)
                                            {
                                                $cat_id=$cat["ID"];
                                                $cat_name=$cat["Nom"];
                                                ?>
                                                <option value="<?php echo $cat_id; ?>" <?php if($cat_id==$p_catID)echo "selected"; ?>><?php echo $cat_name; ?></option>
                                                <?php
                                            } 
                                        ?>
                                    </select>
                                    <input type="text"  name="name" id="addproName" class="form-control" placeholder="Nom produit" value="<?php echo $p_name; ?>" required>
                                    <input type="hidden"  name="oldName" value="<?php echo $p_name; ?>">
                                    <input type="number" name="price" id="addproPrice" class="form-control" placeholder="Prix produit" value="<?php echo $p_price; ?>" required>
                                    <input type="number" name="promotion" id="addproPromotion" class="form-control" placeholder="Promotion produit" value="<?php echo $p_promotion; ?>" required>
                                    <input type="number" name="rating" id="addproRating" class="form-control" placeholder="Rating" value="<?php echo $p_rating; ?>" required>
                                    <label for="desc">Product Description</label>
                                    <textarea id="desc" name="desc" id="addproDesc" class="tinymce"><?php echo $p_desc; ?></textarea>
                                    <button type="submit" class="btn btn-success edit-btn" id="edit-product-btn" name="edit-product"><i class="fas fa-check-circle"></i> Modifier Produit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <script>
                        const input = document.getElementById('img-file');

                        input.addEventListener('change', function (e) {
                            const reader = new FileReader()
                            reader.onload = function () {
                            var src = reader.result
                            $('.new-img-insert').attr("src",src);
                            }
                            reader.readAsDataURL (input.files [0]) 
                        }, false);
                    </script>
                    <?php
                    if(isset($_POST['edit-product']))
                    {
                        $name = $_POST['name'];
                        $oldName = $_POST['oldName'];
                        $price = $_POST['price'];
                        $desc = $_POST['desc'];
                        $cat = $_POST['cat'];
                        $promotion = $_POST['promotion'];
                        $rating = $_POST['rating'];
                        $img = $_POST['oldImg'];
                        $checkName = true;
                        if($name!=$oldName)
                        {
                            if(checkItem("produit","Name",$name))
                            {
                                $checkName = false;
                            }
                        }
                        if($checkName)
                        {
                            if(isset($_FILES['img']['name']) && !empty($_FILES['img']['name']))
                            {
                                $getImgName = $_FILES['img']['name'];
                                $getImgtmp = $_FILES['img']['tmp_name'];
                                $imgExtension = @strtolower(end(explode(".",$getImgName)));
                                $imgName = rand(1000000,99999999999)."_".$getImgName;
                                $extensions = array('jpg','jpeg','png');
    
                                if(in_array($imgExtension,$extensions))
                                {
                                    if(file_exists("img/products/$img"))
                                    {
                                        unlink("img/products/$img");
                                    }
                                    move_uploaded_file($getImgtmp,"img/products/$imgName");
                                    $img = $imgName;
                                }
                                else
                                {
                                    echo
                                    "<script>
                                        swal({
                                            title: 'Failed!',
                                            text: 'There\'s a wrong in Image Extension!',
                                            icon: 'error'
                                        }).then(() => {
                                            window.open('?page=products&temp=add','_self');
                                        });
                                    </script>";
                                }
                            }
                            $product = new Products();
                            if($product->updateProduct($p_id,$name,$price,$cat,$img,$desc,$promotion,$rating))
                            {
                                echo 
                                "<script>
                                    swal({
                                        title: 'Updated!',
                                        text: 'Product has been updated successfuly!',
                                        icon: 'success'
                                    }).then(() => {
                                        window.open('?page=products&temp=edit&pid=$p_id','_self');
                                    });
                                </script>";
                            }
                        }
                        else
                        {
                            echo 
                            "<script>
                                swal({
                                    title: 'Failed!',
                                    text: 'This Name already Exist!',
                                    icon: 'error'
                                }).then(() => {
                                    window.open('?page=products&temp=edit&pid=$p_id','_self');
                                });
                            </script>";
                        }
                    }
                    ?>
                </div>
                <!--End Edit Products -->
             <?php
            }
            else
            {
                echo 
                "<script>
                    swal({
                        title: 'Error!',
                        text: 'This Product Not Exist!',
                        icon: 'error'
                    }).then(() => {
                        window.open('?page=products','_self');
                    });
                </script>";
            }
            break;
     }

    ?>
</div>
