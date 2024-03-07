 <div class="container-fluid dashboard">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Produits
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                   echo getCount("produit");
                                 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cookie-bite fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a href="?page=products" class="link-view-boxes">Voir <i class="fas fa-chevron-right view-ch-icon"></i></a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Commandes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                   echo getCount("commande");
                                 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a href="?page=orders" class="link-view-boxes" style="border-color: #2acb91;background: #2acb91;">Voir <i class="fas fa-chevron-right view-ch-icon"></i></a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Clients
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php
                                   echo getCount("client");
                                 ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a href="?page=clients" class="link-view-boxes" style="border-color: #36b9cc;background: #36b9cc;">Voir <i class="fas fa-chevron-right view-ch-icon"></i></a>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Commandes en attente
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                   echo getCount("commande","WHERE CINLivreure is Null");
                                 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-business-time fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a href="?page=orders&temp=orders-attente" class="link-view-boxes" style="border-color: #f6c23e;background: #f6c23e;">Voir <i class="fas fa-chevron-right view-ch-icon"></i></a>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Last Orders Section -->
        <div class="col-xl-8 col-lg-7">
            <div class="card card-last-orders shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dernières Commandes</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <table class="table text-center ">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Client</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $orders = getLastOrders();
                           foreach($orders as $order)
                           {
                               $num = $order['Numero'];
                               $client = $order['Client'];
                               $date = $order['OrderDate'];
                               $status = $order['Status'];
                               ?>
                                <tr>
                                    <th scope="row"><?php echo $num; ?></th>
                                    <td><?php echo $client; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><span class="<?php echo $status;?>"><?php echo $status; ?></span></td>
                                </tr>
                               <?php
                           }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card last-users-card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Derniers Utilisateurs</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <?php
                        $users = getLastUsers();
                        foreach($users as $user)
                        {
                            $image = $user['Image'];
                            $cin = $user['CIN'];
                            $status = $user['Status'];
                            ?>
                            <div class="col-12">
                                <div class="box-user">
                                    <div class="row">
                                        <div class="col-3">
                                            <img class="img-profile rounded-circle" src="../Images/uploads/profiles/<?php echo $image;?>"/>
                                        </div>
                                        <div class="col-3">
                                            <p class="username"><?php echo $cin;?></p>
                                        </div>
                                        <div class="col-3">
                                            <p class="status <?php echo $status;?>"><?php echo $status;?></p>
                                        </div>
                                        <div class="col-2">
                                            <a href="?page=clients&temp=view-profile&cin=<?php echo $cin; ?>" class="btn btn-primary">View</a>
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