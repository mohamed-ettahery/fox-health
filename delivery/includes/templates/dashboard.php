<?php
 if(isset($_POST['confirmer']))
 {
     $num = $_POST['num'];
     $query = "UPDATE commande SET status = 'complété' WHERE Numero = $num";
     $stmt = $cnx->prepare($query);
     if($stmt->execute())
     {
        echo 
        "<script>
            swal({
                title: 'Success!',
                text: 'Commande bien Confirmé!',
                icon: 'success'
            }).then(() => {
                window.open('index.php','_self');
            });
        </script>";
     }
     else
     {
        echo 
        "<script>
            swal({
                title: 'Failed!',
                text: 'Oups , Error!',
                icon: 'error'
            }).then(() => {
                window.open('index.php','_self');
            });
        </script>";
     }
 }
 if(isset($_POST['rembourse']))
 {
    $num = $_POST['num'];
    $query = "UPDATE commande SET status = 'retour' WHERE Numero = $num";
    $stmt = $cnx->prepare($query);
    if($stmt->execute())
    {
       echo 
       "<script>
           swal({
               title: 'Success!',
               text: 'Commande bien Remboursé!',
               icon: 'success'
           }).then(() => {
               window.open('index.php','_self');
           });
       </script>";
    }
    else
    {
       echo 
       "<script>
           swal({
               title: 'Failed!',
               text: 'Oups , Error!',
               icon: 'error'
           }).then(() => {
               window.open('index.php','_self');
           });
       </script>";
    }
 }
?>
<div class="container-fluid dashboard">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="container">
            <h2 style="text-align: center;margin-bottom: 50px;">Bonjour <span style="color: #ff416c;font-weight: 600;"> 
            <?php 
                $cin = $_SESSION['delivery'];
                $delivery = getFetch("livreur","*","WHERE CIN = '$cin'");
                echo $delivery['Prenom'];
            ?> !
            </span> Comment allez-vous ?</h2>
            <div class="container">
                <div class="col-12">
                    <div class="card card-last-orders shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Les dernières commandes vous attendent</h6>
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
                                     $orders = getFrom("commande","*","WHERE CINLivreure = '$cin' AND status = 'en livraison' ORDER BY Numero DESC LIMIT 5");
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
                                                    <td>
                                                        <button type="submit" class="btn btn-success" name="confirmer"> <i class="fas fa-badge-check"></i> Confirmer</button>
                                                        <button type="submit" class="btn btn-danger" name="rembourse"><i class="fas fa-times"></i> Remboursé</button>
                                                    </td>
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