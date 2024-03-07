<?php 
require "admin/includes/cnx.php";
require "includes/functions/functions.php";
session_start();
$ip = getIP();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>FOX HEALTH - <?php getTitle(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="layouts/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="layouts/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="layouts/css/front.css"/>
        <script src="layouts/js/sweet-alert.min.js"></script>   
        <style>
        </style>
    </head>
    <body>
    <nav class="navbar navbar-light navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <!-- <span style="margin-right: 17px;">Elite</span> -->
                  <img src="Images/logo.png"/>
                <!-- <span >Food</span></a> -->
            <ul class="list-unstyled header-actions">
                <!-- <li><a href="#"><i class="fa fa-search"></i></a></li> -->
                <li class="li-search">
                    <a class="nav-link">
                     <i class="fa fa-search"></i>
                    </a>
                    <div class="search-collapse">
                        <form action="search.php" method="GET">
                        <div class="input-group">
                            <input type="text" name="term" id="search" class="form-control" placeholder="Recherche  ..."/>
                            <span class="input-group-btn">
                                <button type="submit" class="btn"><li class="fa fa-search"></li></button>
                            </span>
                        </div>
                        </form>
                    </div> 
                </li>
                <li>
                    <a href="cart.php">
                        <i class="fa fa-shopping-cart"></i>
                        <span style="position: absolute;text-decoration: none;font-size: 11px;color: red;" class="cart-count"><?php echo getCount("cart","WHERE ip_addr = '$ip'"); ?></span>
                    </a>
                </li>
                <!-- <li><a href="#"><i class="fa fa-user"></i></a></li> -->
                <li>
                    <div class="dropdown">
                        <button style="border:none;background:none;" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-user"></i><span class="head-username"><?php if(isset($_SESSION["user"])&&!empty($_SESSION["user"])){echo $_SESSION["user"];}else{echo "connéxion";} ?></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                             if(isset($_SESSION['user']))
                             {
                                 ?>
                                    <a class="dropdown-item" href="profile.php">Profile</a>
                                    <a class="dropdown-item" href="orders.php">Mes Commandes</a>
                                    <hr/>
                                    <a class="dropdown-item" href="edit_password.php">Modifier mot de passe</a>
                                    <a class="dropdown-item" href="logout.php">Déconnexion</a>
                                 <?php
                             } 
                             else
                             {
                                 ?>
                                     <a class="dropdown-item" href="login.php">Connéxion</a>
                                     <a class="dropdown-item" href="login.php?action=signup">Inscription</a>
                                 <?php
                             }
                            ?>
                        </div>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($active)&&$active == 'home'){echo "active";} ?>" href="index.php">Accueil</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php if(isset($active)&&$active == 'shop'){echo "active";} ?>" href="shop.php">Produits</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link <?php if(isset($active)&&$active == 'mustpop'){echo "active";} ?>" href="mustpopular.php"> Plus Populaire</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link <?php if(isset($active)&&$active == 'contact'){echo "active";} ?>" href="contact.php">Contact</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link <?php if(isset($active)&&$active == 'about'){echo "active";} ?>" href="about.php">A propos</a>
                </li>
                </ul>
            </div>
        </div>
</nav>
<div class="dress-height-nav"></div>