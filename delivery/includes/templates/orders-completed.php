<div class="container-fluid dashboard">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tous Les Commandes Déja Complété</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="container">
            <div class="container">
                <div class="col-12">
                    <div class="card card-last-orders shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Tous Les Commandes Déja Complété</h6>
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
                                     $cin = $_SESSION['delivery'];
                                     $orders = getFrom("commande","*","WHERE CINLivreure = '$cin' AND status = 'complété' ORDER BY Numero DESC");
                                    foreach($orders as $order)
                                    {
                                        $num = $order['Numero'];
                                        $client = $order['CinClient'];
                                        $date = $order['DateCommande'];
                                        $status = $order['status'];
                                        ?>
                                           <form action="" method="POST">
                                                <tr>
                                                    <th scope="row">
                                                        <?php echo $num; ?>
                                                        <input type="hidden" value="<?php echo $num; ?>" name="num"/>
                                                    </th>
                                                    <td><?php echo $client; ?></td>
                                                    <td><?php echo $date; ?></td>
                                                    <td><span class="<?php echo $status;?>"><?php echo $status; ?></span></td>
                                                </tr>
                                           </form>
                                        <?php
                                    }
                                     ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>