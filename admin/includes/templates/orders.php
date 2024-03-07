<?php
 if(isset($_POST['confirmé']))
 {
     $delivery = $_POST['delivery'];
     $numOrder = $_POST['numOrder'];

     $order = new Orders();
     if($order->setOrderDelivery($numOrder,$delivery))
     {
        echo
        "<script>
            swal({
                title: 'Success!',
                text: 'Commande Bien Confirmé!',
                icon: 'success'
            }).then(() => {
                window.open('?page=orders&temp=orders-attente','_self');
            });
        </script>";
     }
     else
     {
        "<script>
        swal({
            title: 'Failed!',
            text: 'Error!',
            icon: 'error'
        }).then(() => {
            window.open('?page=orders&temp=orders-attente','_self');
        });
    </script>";
     }
     
 } 
?>
<div class="container-fluid clients">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 tt">Commandes</h1>
    </div>
    <?php
     $temp = isset($_GET["temp"]) ? $_GET["temp"]:"view-commandes";
     switch($temp)
        {
            case "view-commandes":
            ?>
                   <!--Start View commandes -->
                     <div class="view-commandes">
                        <div class="container">
                            <div class="table-section">
                                <table class="table table-view-commandes text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">N° Commande</th>
                                            <th scope="col">CIN Client</th>
                                            <th scope="col">Date Commande</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $order = new Orders();
                                        $orders = $order->getAllOrders();
                                        foreach($orders as $order)
                                        {
                                            $num_c = $order['Numero'];
                                            $cin_cl = $order['CinClient'];
                                            $date_c = $order['DateCommande'];
                                            $status_c = $order['status'];
                                            ?>
                                                <tr>
                                                    <td style="padding-top: 3%;"><?php echo $num_c; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $cin_cl; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $date_c; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $status_c; ?></td>
                                                    <td>
                                                       <a href="?page=orders&temp=delete&num=<?php echo $num_c; ?>" class="confirm-delete btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                              <a href="?page=orders&temp=orders-attente" class="btn btn-secondary" style="margin-top: 40px;">Commandes en attente <span class="badge badge-danger"><?php echo getCount("commande","WHERE status = 'attente'") ?></span></a>
                              <a href="?page=orders&temp=en-livraison" class="btn btn-secondary" style="margin-top: 40px;">Commandes en livraison <span class="badge badge-danger"><?php echo getCount("commande","WHERE status = 'en livraison'") ?></span></a>
                            </div>
                        </div>
                    </div>
                    <!-- End View Clients -->
            <?php
                break;
                case "orders-attente":
                    ?>
                           <!--Start View Clients -->
                            <div class="view-commandes">
                                <div class="container">
                                    <div class="table-section">
                                        <table class="table table-view-commandes text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">N° Commande</th>
                                                    <th scope="col">CIN Client</th>
                                                    <th scope="col">Date Commande</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Livreur</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $order = new Orders();
                                                $orders = $order->getAllOrdersPending();
                                                foreach($orders as $order)
                                                {
                                                    $num_c = $order['Numero'];
                                                    $cin_cl = $order['CinClient'];
                                                    $date_c = $order['DateCommande'];
                                                    $status_c = $order['status'];
                                                    ?>
                                                        <tr>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="numOrder" value="<?php echo $num_c; ?>"/>
                                                            <td style="padding-top: 3%;"><?php echo $num_c; ?></td>
                                                            <td style="padding-top: 3%;"><?php echo $cin_cl; ?></td>
                                                            <td style="padding-top: 3%;"><?php echo $date_c; ?></td>
                                                            <td style="padding-top: 3%;"><?php echo $status_c; ?></td>
                                                            <td style="padding-top: 3%;">
                                                             <select class="form-control" name="delivery">
                                                                 <?php
                                                                   $allDelivery = getFrom("livreur","*");
                                                                   foreach($allDelivery as $Delivery)
                                                                   {
                                                                       ?>
                                                                       <option><?php echo $Delivery["CIN"] ?></option>
                                                                       <?php
                                                                   }
                                                                 ?>
                                                             </select>

                                                            </td>
                                                            <td style="padding-top: 3%;">
                                                             <button type="submit" name="confirmé" class="btn btn-success"><i class="fas fa-fw fa-check"></i></button>
                                                             <a href="?page=orders&temp=delete&num=<?php echo $num_c; ?>" class="confirm-delete btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i></a>
                                                            </td>
                                                            </form>
                                                        </tr>
                                                    <?php
                                                } 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                    <a href="?page=orders" class="btn btn-secondary" style="margin-top: 40px;">Tous Les Commandes <span class="badge badge-danger"><?php echo getCount("commande") ?></span></a>
                                    </div>
                                </div>
                            </div>
                            <!-- End View Clients -->
                    <?php
                        break;
                case "en-livraison":
                    ?>
                           <!--Start View Clients -->
                            <div class="view-commandes">
                                <div class="container">
                                    <div class="table-section">
                                        <table class="table table-view-commandes text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">N° Commande</th>
                                                    <th scope="col">CIN Client</th>
                                                    <th scope="col">Date Commande</th>
                                                    <th scope="col">Livreur</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $order = new Orders();
                                                $orders = $order->getAllOrdersEnLiv();
                                                foreach($orders as $order)
                                                {
                                                    $num_c = $order['Numero'];
                                                    $cin_cl = $order['CinClient'];
                                                    $date_c = $order['DateCommande'];
                                                    $status_c = $order['status'];
                                                    $delivery_c = $order['CINLivreure'];
                                                    ?>
                                                        <tr>
                                                            <td style="padding-top: 3%;"><?php echo $num_c; ?></td>
                                                            <td style="padding-top: 3%;"><?php echo $cin_cl; ?></td>
                                                            <td style="padding-top: 3%;"><?php echo $date_c; ?></td>
                                                            <td style="padding-top: 3%;"><?php echo $delivery_c;?></td>
                                                            <td style="padding-top: 3%;"><?php echo $status_c; ?></td>
                                                            <td style="padding-top: 3%;">
                                                             <a href="?page=orders&temp=delete&num=<?php echo $num_c; ?>" class="confirm-delete btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                } 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                    <a href="?page=orders" class="btn btn-secondary" style="margin-top: 40px;">Tous Les Commandes <span class="badge badge-danger"><?php echo getCount("commande") ?></span></a>
                                    </div>
                                </div>
                            </div>
                            <!-- End View Clients -->
                    <?php
                        break;

            case "delete":
                $num  = isset($_GET['num'])?$_GET['num']:0;
                if(checkItem("commande","Numero",$num))
                {
                    $order = new Orders();
                    if($order->removeOrder($num))
                    {
                        echo 
                        "<script>
                            swal({
                                title: 'Success!',
                                text: 'Commande bien Supprimé!',
                                icon: 'success'
                            }).then(() => {
                                window.open('?page=orders','_self');
                            });
                        </script>";
                    }
                    else
                    {
                        echo 
                        "<script>
                            swal({
                                title: 'Erroe!',
                                text: 'There\'s somthing wrong!',
                                icon: 'error'
                            }).then(() => {
                                window.open('?page=orders','_self');
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
                            text: 'Commande pas Exist!',
                            icon: 'error'
                        }).then(() => {
                            window.open('?page=orders','_self');
                        });
                    </script>";
                }
                break;
        }
    ?>
</div>
