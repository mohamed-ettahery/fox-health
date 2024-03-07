<?php 
$active = "search";
include("includes/templates/header.php");
 $countOfBoxesPreview = 4;
 if(!isset($_GET['term'])&&!isset($_GET['blog']))
 {
     echo "<script>window.open('index.php','_self');</script>";
     exit();
 }
 elseif(isset($_GET['term']))
 {
     $term = $_GET['term'];
     $select = "SELECT * FROM `produit` WHERE Name LIKE '%$term%'";
     $stmt = $cnx->prepare($select);
     $stmt->execute();
     $results = $stmt->fetchAll();
     $count = count($results);
 }
 else
 {
    $term = $_GET['blog'];
    $select = "SELECT * FROM `blog` WHERE title LIKE '%$term%'";
    $stmt = $cnx->prepare($select);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $count = count($results);
 }
?>
<!--Start Breadcrumb -->
<div class="Breadcrumb-content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="search.php" class="active">Recherche</a></li>
            </ul>
        </div>
    </div>
</div>
<!--End Breadcrumb -->
<!--Start Search Content -->
<div class="search-content">
 <div class="container">
     <div class="row">
        <div class="col-md-3">
                <!--Start Include Sidebar -->
                <?php include("includes/sidebar.php"); ?>
                <!--End Include Sidebar -->
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <h2 class="searching-for">Résultats de recherche pour :<span><?php echo $term; ?></span></h2>
                <h4 class="count-result">Nombre de résultats :<span>(<?php echo $count; ?>)</span></h4>
                <?php
                 if(isset($_GET['page']) && is_numeric($_GET['page']))
                 {
                     $page = $_GET['page'];
                     $start = ($page - 1)*$countOfBoxesPreview;
                    //  echo "<script>alert('$start')</script>";
                    $limit = "LIMIT $start,$countOfBoxesPreview";
                 }
                 else
                 {
                    $limit = "LIMIT $countOfBoxesPreview";
                 }
                 if(isset($_GET['term']))
                 {
                     $term = $_GET['term'];
                     $select = "SELECT * FROM `produit` WHERE Name LIKE '%$term%' $limit";
                        $stmt = $cnx->prepare($select);
                        $stmt->execute();
                        $results = $stmt->fetchAll();
                    foreach($results as $product)
                    {
                        $id = $product['id'];
                        $image = $product['Image'];
                        $name = $product['Name'];
                        $desc = $product['description'];
                        ?>
                            <div class="box">
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="details.php?pid=<?php echo $id; ?>"><img src="admin/img/products/<?php echo $image; ?>" alt=""/></a>
                                        </div>
                                        <div class="col-8 desc-part">
                                            <a href="details.php?pid=<?php echo $id; ?>"><h4 class="pro-title"><?php echo $name; ?></h4></a>
                                            <p class="pro-desc"><?php echo $desc; ?></p>
                                        </div>
                                    </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    $term = $_GET['blog'];
                    $select = "SELECT * FROM `blog` WHERE title LIKE '%$term%' $limit";
                       $stmt = $cnx->prepare($select);
                       $stmt->execute();
                       $results = $stmt->fetchAll();
                       $count = count($results);
                    //    echo "<script>alert('$count');</script>";
                   foreach($results as $blog)
                   {
                       $id = $blog['id'];
                       $image = $blog['image'];
                       $title = $blog['title'];
                    //    $desc = $product['description'];
                       ?>
                           <div class="box">
                                   <div class="row">
                                       <div class="col-4">
                                           <a href="blog.php?b_id=<?php echo $id; ?>"><img src="admin/img/blogs/<?php echo $image; ?>" alt=""/></a>
                                       </div>
                                       <div class="col-8 desc-part">
                                           <a href="blog.php?b_id=<?php echo $id; ?>"><h4 class="pro-title"><?php echo $title; ?></h4></a>
                                           <!-- <p class="pro-desc"><?php echo $desc; ?></p> -->
                                       </div>
                                   </div>
                           </div>
                       <?php
                   }
                }
                 ?>
                <!-- <div class="box">
                        <div class="row">
                            <div class="col-4">
                                <a href="#"><img src="admin/Images/products/05064534.jpg" alt=""/></a>
                            </div>
                            <div class="col-8 desc-part">
                                <a href="#"><h4 class="pro-title">Product Title</h4></a>
                                <p class="pro-desc">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis cum iusto, sit et eveniet architecto possimus obcaecati quasi id similique aperiam nulla corporis soluta mollitia alias voluptate maiores itaque fugiat?</p>
                                <div class="pro-keywords"><a href="#"><span class="keyword">New</span></a> <span class="keyword">Feature</span> <span class="keyword">Good</span></div>
                            </div>
                        </div>
                </div> -->
            </div>
            <?php
                 $num = ceil($count/$countOfBoxesPreview);
             ?>
             <div class="box-pagination">
                <ul class="pagination">
                    <?php
                    if($count>$countOfBoxesPreview)
                    {
                        $get = isset($_GET['term']) ? "term":"blog";
                        $page = isset($_GET['page']) && is_numeric($_GET['page'])?intval($_GET['page']):1;
                        echo "<li><a href='search.php?$get=$term'";
                            if($page == 1){ echo "class='active'";}
                        echo ">First</a><li>";
                        for($i=2;$i<$num;$i++)
                        {
                            echo "<li><a href='search.php?$get=$term&page=$i'";
                            if($page == $i){ echo "class='active'";}
                            echo ">$i</a><li>";
                        }
                        echo "<li><a href='search.php?$get=$term&page=$num'";
                        if($page == $num){ echo "class='active'";}
                        echo ">Last</a><li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
     </div>
 </div>
</div>
<!--End Search Content -->
<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->