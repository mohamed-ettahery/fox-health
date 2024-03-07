<?php
$active = "My Orders";
// session_start();
include("includes/templates/header.php");
if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}
else
{
    $cin = $_SESSION['userCIN'];
}
if(isset($_POST['delete']))
{
    $invoice = $_POST['delete'];
    if(DeleteElements('commande','Numero',$invoice))
    {
        echo "<script>alert('Invoice No° : $invoice Is Deleted');</script>";
        echo "<script>window.open('orders.php','_self');</script>";
    }
    
    
}
?>
<!-- Start My Orders -->
<div class="my-orders">
    <h2>Mes Commandes</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum unde nihil molestiae deserunt at maiores culpa amet officiis nesciunt quae, veritatis voluptatibus dolor explicabo quo, exercitationem ipsam facilis aperiam! Fugit.</p>
    <?php
    $countOrders = getCount("commande","WHERE CinClient = '$cin'");
    if($countOrders<1)
    {
        echo "<p class='orders-empty'>Il n'y a pas des commandes</p>";
    }
    else
    {
     ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">N° Facture</th>
                <th scope="col">Date Commande</th>
                <th scope="col">Total Prix</th>
                <th scope="col">Status</th>
                <th scope="col" style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT commande.Numero as 'invoice',commande.DateCommande as 'orderDate',status
                FROM `commande`
            WHERE commande.CinClient = '$cin'";

            $stmt = $cnx->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            // echo count($rows);
            foreach($rows as $row)
            {
                $invoice = $row['invoice'];
                $orderDate = $row['orderDate'];
                $status = $row['status'];

                $queryTotal = "SELECT SUM(detailcommande.Quantite * produit.Prix) as 'Total' FROM detailcommande
                INNER JOIN produit ON produit.id = detailcommande.ReferenceProduit WHERE detailcommande.NumCommande = $invoice";
                $stmt = $cnx->prepare($queryTotal);
                $stmt->execute();
                $column = $stmt->fetch();
                $totalPrice = $column['Total'];
             ?>
            <tr>
                <th scope="row"><?php echo $invoice; ?></th>
                <td><?php echo $orderDate; ?></td>
                <td>$<?php echo $totalPrice; ?></td>
                <td class="status-<?php echo $status;?>"><?php echo $status; ?></td>
                <td>
                    <button type="submit" value="<?php echo $invoice; ?>" name="delete" class="btn btn-danger confirm"><i class="fa fa-trash"></i></button>
                    <a href="pdf/invoice.php?invoice=<?php echo $invoice; ?>" target="_blank" class="btn btn-info"><i class="fa fa-book"></i> Voir Facture</a>
                </td>
            </tr>
            <?php
            } 
            ?>
        </tbody>
    </table>
  </form>
  <?php } ?>
</div>
<!-- End My Orders-->

<!-- Start Include footer-->
<?php include("includes/templates/footer.php"); ?>
<!--End Include footer -->
