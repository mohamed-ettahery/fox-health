<div class="container-fluid products">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 tt">Livreur</h1>
    </div>
    <?php
     $temp = isset($_GET["temp"]) ? $_GET["temp"]:"view-delivery";
     switch($temp)
     {
         case "view-delivery":
            ?>
                    <!--Start View Delivery -->
                    <div class="view-delivery">
                        <div class="container">
                            <div class="table-section">
                                <table class="table table-view-delivery text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">CIN</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Prénom</th>
                                            <th scope="col">Tele</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $delivery = new Delivery();
                                        $allDelivery = $delivery->getAllDelivery();
                                        foreach($allDelivery as $delivery)
                                        {
                                            $d_cin = $delivery['CIN'];
                                            $d_nom = $delivery['Nom'];
                                            $d_prénom = $delivery['Prenom'];
                                            $d_tele = $delivery['Tele'];
                                            $d_email = $delivery['Email'];
                                            ?>
                                                <tr>
                                                    <td style="padding-top: 3%;"><?php echo $d_cin; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $d_nom; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $d_prénom; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $d_tele; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $d_email; ?></td>
                                                    <td>
                                                            <a href="?page=delivery&temp=edit&cin=<?php echo $d_cin; ?>" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i></a>
                                                            <a href="?page=delivery&temp=delete&cin=<?php echo $d_cin; ?>" class="confirm-delete btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="add-new-box text-center">
                                <a href="?page=delivery&temp=add" class="btn btn-success"><i class="fas fa-plus-circle"></i> Ajouter un nouveau livreur</a>
                            </div>
                        </div>
                    </div>
                    <!-- End View Products -->
            <?php
            break;
        case "add":
            ?>
                    <!--Start Add Delivery -->
                    <div class="add-delivery">
                        <div class="container">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text"  name="cin" class="form-control" placeholder="CIN" required>
                                        <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                                        <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
                                        <input type="number" name="tele"  class="form-control" placeholder="Télé" required>
                                        <input type="email" name="email" class="form-control" placeholder="exemple@gmail.com" required>
                                        <input type="password" name="mdp"  class="form-control" placeholder="mot de passe" required>
                                        <button type="submit" class="btn btn-success add-btn" style="width: 50%;" name="add-delivery"><i class="fas fa-check-circle"></i> Ajouter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                        if(isset($_POST['add-delivery']))
                        {
                            $cin = $_POST['cin'];
                            $nom = $_POST['nom'];
                            $prenom = $_POST['prenom'];
                            $tele = $_POST['tele'];
                            $email = $_POST['email'];
                            $mdp = $_POST['mdp'];
                            if(!checkItem("livreur","CIN",$cin))
                            {
                                    $delivery = new Delivery();
                                    $delivery->DeliveryProperties($cin,$nom,$prenom,$tele,$email,$mdp);
                                    if($delivery->addDelivery())
                                    {
                                        echo 
                                        "<script>
                                            swal({
                                                title: 'Success!',
                                                text: 'Livreur bien ajouté!',
                                                icon: 'success'
                                            }).then(() => {
                                                window.open('?page=delivery','_self');
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
                                        text: 'CIN déja Exist!',
                                        icon: 'error'
                                    }).then(() => {
                                        window.open('?page=delivery&temp=add','_self');
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
            $d_cin = isset($_GET['cin'])?$_GET['cin']:'0';
            
            if(checkItem("livreur","CIN",$d_cin))
            {
                $delivery = new Delivery();
                if($delivery->removeDelivery($d_cin))
                {
                    echo 
                    "<script>
                        swal({
                            title: 'Success!',
                            text: 'Livreur Bien Supprimé!',
                            icon: 'success'
                        }).then(() => {
                            window.open('?page=delivery','_self');
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
                            window.open('?page=delivery','_self');
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
                        text: 'livreur pad Exist!',
                        icon: 'error'
                    }).then(() => {
                        window.open('?page=delivery','_self');
                    });
                </script>";
            }

            // End delete Product
            break;
        case "edit":
            $d_cin = isset($_GET['cin'])?$_GET['cin']:'0';
            if(checkItem("livreur","CIN",$d_cin))
            {
                $delivery = new Delivery();
                $delivery = $delivery->getDelivery($d_cin);
                $d_cin = $delivery['CIN'];
                $d_nom = $delivery['Nom'];
                $d_prénom = $delivery['Prenom'];
                $d_tele = $delivery['Tele'];
                $d_email = $delivery['Email'];
                $d_mdp = $delivery['MDP'];
             ?>
                <!--Start Edit Delivery -->
                <div class="edit-delivery">
                    <div class="container">
                        <form action="" method="POST" >
                            <div class="row">
                                <div class="col-12">
                                    <input type="text"  name="cin" value="<?php echo $d_cin; ?>" readOnly class="form-control" placeholder="CIN" required>
                                    <input type="text" name="nom" value="<?php echo $d_nom; ?>" class="form-control" placeholder="Nom" required>
                                    <input type="text" name="prenom" value="<?php echo $d_prénom; ?>" class="form-control" placeholder="Prénom" required>
                                    <input type="number" name="tele" value="<?php echo $d_tele; ?>"  class="form-control" placeholder="Télé" required>
                                    <input type="email" name="email" value="<?php echo $d_email; ?>" class="form-control" placeholder="exemple@gmail.com" required>
                                    <input type="password" name="mdp" value="<?php echo $d_mdp; ?>" class="form-control" placeholder="Nouveau mot de passe">
                                    <button type="submit" class="btn btn-success edit-btn" style="width: 50%;" name="edit-delivery"><i class="fas fa-check-circle"></i> Modifier Livreur</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    if(isset($_POST['edit-delivery']))
                    {
                        $cin = $_POST['cin'];
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $tele = $_POST['tele'];
                        $email = $_POST['email'];
                        $mdp = $_POST['mdp'];

                        $delivery = new Delivery();
                        if($delivery->updateDelivery($cin,$nom,$prenom,$tele,$email,$mdp))
                        {
                            echo 
                            "<script>
                                swal({
                                    title: 'Updated!',
                                    text: 'Livreur Bien Modifié!',
                                    icon: 'success'
                                }).then(() => {
                                    window.open('?page=delivery&temp=edit&cin=$d_cin','_self');
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
                        text: 'Livreur pas Exist!',
                        icon: 'error'
                    }).then(() => {
                        window.open('?page=delivery','_self');
                    });
                </script>";
            }
            break;
     }

    ?>
</div>
