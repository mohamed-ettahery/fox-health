<div class="container-fluid categories">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 tt">Categories</h1>
    </div>
    <?php
     $temp = isset($_GET["temp"]) ? $_GET["temp"]:"view-cats";
     switch($temp)
     {
         case "view-cats":
            ?>
                   <!--Start View Categories -->
                    <div class="view-cats">
                        <div class="container">
                            <div class="table-section">
                                <table class="table table-view-cats text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Nombre Produits</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $category = new Category();
                                        $categories = $category->getAllCats();
                                        foreach($categories as $cat)
                                        {
                                            $c_id = $cat['ID'];
                                            $c_name = $cat['Nom'];
                                            $c_countP = $cat['CountProduct'];
                                            $c_desc = $cat['description'];
                                            ?>
                                                <tr>
                                                    <td style="padding-top: 3%;"><?php echo $c_name; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $c_countP; ?></td>
                                                    <td><textarea readOnly><?php echo $c_desc; ?></textarea></td>
                                                    <td>
                                                            <a href="?page=categories&temp=edit&cid=<?php echo $c_id; ?>" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i></a>
                                                            <a href="?page=categories&temp=delete&cid=<?php echo $c_id; ?>" class="confirm-delete btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="add-new-box">
                                <a href="?page=categories&temp=add" class="btn btn-success"><i class="fas fa-plus-circle"></i> Ajouter une nouvelle catégorie</a>
                            </div>
                        </div>
                    </div>
                    <!-- End View Categories -->
            <?php
            break;
        case 'add':
            ?>
                    <!--Start Add Category -->
                    <div class="add-category">
                        <div class="container">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" name="name" class="form-control" id="addCatName" placeholder="Nom catégorie"/>
                                    </div>
                                    <div class="col-12">
                                        <div style="width: 70%;margin: 26px auto;">
                                            <label for="desc">Description catégorie</label>
                                            <textarea id="desc" name="desc" id="addCatDesc" class="tinymce"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success add-btn" name="add-category" id="btn-add-cat"><i class="fas fa-check-circle"></i> Ajouter catégorie</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                        if(isset($_POST['add-category']))
                        {
                            $name = $_POST['name'];
                            $desc = $_POST['desc'];
                            if(!checkItem("categorie","Nom",$name))
                            {
                                $category = new Category();
                                $category->CategoryProperties($name,$desc);
                                if($category->addCategory())
                                {
                                    echo 
                                    "<script>
                                        swal({
                                            title: 'Success!',
                                            text: 'Category has been Added Successfuly!',
                                            icon: 'success'
                                        }).then(() => {
                                            window.open('?page=categories','_self');
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
                                        window.open('?page=categories&temp=add','_self');
                                    });
                                </script>";
                            }
                        }
                        ?>
                    </div>
                    <!--End Add Category -->
            <?php
            break;
        case 'edit':
            $c_id = isset($_GET['cid']) && is_integer(intval($_GET['cid']))?intval($_GET['cid']):0;
            if(checkItem("categorie","ID",$c_id))
            {
                $category = new Category();
                $category = $category->getCategory($c_id);
                $cat_name = $category['Nom'];
                $cat_desc = $category['description'];
                ?>
                        <!--Start Edit Category -->
                        <div class="edit-category">
                            <div class="container">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" name="name" id="editCatName" value="<?php echo $cat_name; ?>" class="form-control" placeholder="Nom catégorie"/>
                                            <input type="hidden" name="oldName" value="<?php echo $cat_name; ?>"/>
                                        </div>
                                        <div class="col-12">
                                            <div style="width: 70%;margin: 26px auto;">
                                                <label for="desc">Description catégorie</label>
                                                <textarea id="desc" name="desc" id="editCatDesc" class="tinymce"><?php echo $cat_desc; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success edit-btn" name="edit-category" id="btn-edit-cat"><i class="fas fa-check-circle"></i> Modifier catégorie</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                    if(isset($_POST['edit-category']))
                    {
                        $name = $_POST['name'];
                        $oldName = $_POST['oldName'];
                        $desc = $_POST['desc'];
                        $checkName = true;
                        if($name!=$oldName)
                        {
                            if(checkItem("categorie","Nom",$name))
                            {
                                $checkName = false;
                            }
                        }
                        if($checkName)
                        {
                            $category = new Category();
                            if($category->updateCategory($c_id,$name,$desc))
                            {
                                echo 
                                "<script>
                                    swal({
                                        title: 'Updated!',
                                        text: 'Category has been updated successfuly!',
                                        icon: 'success'
                                    }).then(() => {
                                        window.open('?page=categories&temp=edit&cid=$c_id','_self');
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
                                    window.open('?page=categories&temp=edit&cid=$c_id','_self');
                                });
                            </script>";
                        }
                    }
                    ?>
                        </div>
                        <!--End Edit Category -->
                <?php
            }
            else
            {
                echo 
                "<script>
                    swal({
                        title: 'Error!',
                        text: 'This Category Not Exist!',
                        icon: 'error'
                    }).then(() => {
                        window.open('?page=categories','_self');
                    });
                </script>";
            }
            break;
            case "delete":
                // Start delete Product
                $c_id = isset($_GET['cid']) && is_integer(intval($_GET['cid']))?intval($_GET['cid']):0;
                
                if(checkItem("categorie","ID",$c_id))
                {
                    $category = new Category();
                    if($category->removeCategory($c_id))
                    {
                        echo 
                        "<script>
                            swal({
                                title: 'Success!',
                                text: 'Category has been Deleted Successfuly!',
                                icon: 'success'
                            }).then(() => {
                                window.open('?page=categories','_self');
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
                                window.open('?page=categories','_self');
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
                            text: 'This Category Not Exist!',
                            icon: 'error'
                        }).then(() => {
                            window.open('?page=categories','_self');
                        });
                    </script>";
                }
    
                // End delete Product
                break;
     }

    ?>
</div>
