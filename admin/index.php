<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("Location:login.php");
    exit();
}
    spl_autoload_register(function($class)
    {
        require "includes/classes/$class.php";
    });
    require "includes/functions/function.php";
    $cnx = new connection();
    $cnx = $cnx->connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin - Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <!-- <link href="layouts/css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href="layouts/css/sb-admin-2.css" rel="stylesheet">
    <link href="layouts/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- <link rel="stylesheet" href="layouts/css/font-awesome-cdn.min.css"/> -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="layouts/js/sweet-alert.min.js"></script>   
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="img/logo.png" class="img-fluid" style="width: 65px;"/>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item Products -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-cookie-bite"></i>
                    <span>Produits</span>
                </a>
                <div id="collapseProducts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?page=products">Voir Produits</a>
                        <a class="collapse-item" href="?page=products&temp=add">Ajouter Produits</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item Categories -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-list-ul"></i>
                    <span>Categories</span>
                </a>
                <div id="collapseCategories" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?page=categories">Voir Categories</a>
                        <a class="collapse-item" href="?page=categories&temp=add">Ajouter Categorie</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item Clients -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClients"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-users"></i>
                    <span>Clients</span>
                </a>
                <div id="collapseClients" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?page=clients">Voir Clients</a>
                        <a class="collapse-item" href="?page=clients&temp=clients-attente">Utilisateurs en attente</a>
                    </div>
                    </div>
                </div>
            </li>

            <!-- Nav Item Orders -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Commandes</span>
                </a>
                <div id="collapseOrders" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?page=orders">Voir Commandes</a>
                        <a class="collapse-item" href="?page=orders&temp=orders-attente">Commandes en attente</a>
                    </div>
                </div>
            </li>

            <!-- nav item Delivery-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDelivery"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Livreur</span>
                </a>
                <div id="collapseDelivery" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="?page=delivery">Voir livreur</a>
                            <a class="collapse-item" href="?page=delivery&temp=add">Ajouter livreur</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnéxion</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle">
                    <i class="fas fa-chevron-left" style="color:#FFF;"></i>
                </button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php 
                                 $id = $_SESSION['admin'];
                                 $admin = getFetch("admin","*","WHERE id = $id");
                                 echo $admin['prénom'];
                                 ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?php
                if(isset($_GET['page']))
                {
                    switch($_GET['page'])
                    {
                        case 'dashboard': include('includes/templates/dashboard.php'); break;
                        case 'products': include('includes/templates/products.php'); break;
                        case 'clients': include('includes/templates/clients.php'); break;
                        case 'orders': include('includes/templates/orders.php'); break;
                        case 'categories': include('includes/templates/categories.php'); break;
                        case 'delivery': include('includes/templates/delivery.php'); break;
                        case 'newslater': include('includes/templates/newslater.php'); break;
                        default : include('includes/templates/dashboard.php');
                    }
                }
                else
                {
                    include('includes/templates/dashboard.php');
                }
                ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; ORIGINAL PRODUCTS 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <button class="scroll-to-top rounded">
        <i class="fas fa-angle-up"></i>
    </button>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Fermer</button>
                    <a class="btn btn-primary" href="logout.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="layouts/js/jquery.min.js"></script>
    <script src="layouts/js/bootstrap.bundle.min.js"></script>
    <!-- Custom scripts for all pages-->
    <!-- <script src="layouts/js/sb-admin-2.min.js"></script> -->
    <script src="layouts/js/sb-admin-2.js"></script>
    <script src="layouts/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea.tinymce'});</script>
    <!-- <script src="layouts/js/sweet-alert.min.js"></script> -->

    <script src="layouts/js/main.js"></script>
</body>
</html>