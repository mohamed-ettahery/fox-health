<div class="container-fluid clients">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 tt">Clients</h1>
    </div>
    <?php
     $temp = isset($_GET["temp"]) ? $_GET["temp"]:"view-clients";
     switch($temp)
        {
            case "view-clients":
            ?>
                   <!--Start View Clients -->
                     <div class="view-clients">
                        <div class="container">
                            <div class="table-section">
                                <table class="table table-view-clients text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Nom complet</th>
                                            <th scope="col">N° Commandes</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $client = new Client();
                                        $clients = $client->getAllClients();
                                        foreach($clients as $client)
                                        {
                                            $c_cin = $client['CIN'];
                                            $c_img = $client['Image'];
                                            $c_fullname = $client['FullName'];
                                            $c_nbrorders = $client['OrdersCount'];
                                            $c_status = $client['Status'];
                                            ?>
                                                <tr>
                                                    <td>
                                                       <img src="../Images/uploads/profiles/<?php echo $c_img;?>"/>
                                                    </td>
                                                    <td style="padding-top: 3%;"><?php echo $c_fullname; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $c_nbrorders; ?></td>
                                                    <td style="padding-top: 3%;"><?php echo $c_status; ?></td>
                                                    <td>
                                                            <a href="?page=clients&temp=view-profile&cin=<?php echo $c_cin; ?>" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                                            <?php
                                                             switch($c_status)
                                                             {
                                                                 case "active":
                                                                    ?> <a href="?page=clients&temp=disable-account&cin=<?php echo $c_cin; ?>" class="btn" style="background: #ff6e36;color:#FFF"><i class="fas fa-user-alt-slash"></i></a><?php
                                                                    break;
                                                                 case "disabled":
                                                                    ?><a href="?page=clients&temp=enable-account&cin=<?php echo $c_cin; ?>" class="btn btn-success" style="background: #119367;"><i class="fas fa-check"></i></a><?php
                                                                    break;
                                                                 case "pending":
                                                                    ?><a href="?page=clients&temp=enable-account&cin=<?php echo $c_cin; ?>" class="btn btn-success"><i class="fas fa-user-check"></i></a><?php
                                                                    break;
                                                             } 
                                                            ?>
                                                            <a href="?page=clients&temp=delete&cin=<?php echo $c_cin; ?>" class="confirm-delete btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End View Clients -->
            <?php
                break;
                case "clients-attente":
                    ?>
                           <!--Start View Clients -->
                             <div class="view-clients">
                                <div class="container">
                                    <div class="table-section">
                                        <table class="table table-view-clients text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Nom complet</th>
                                                    <th scope="col">N° Commandes</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $client = new Client();
                                                $clients = $client->getAllClientsCondition("WHERE Status = 'pending'");
                                                foreach($clients as $client)
                                                {
                                                    $c_cin = $client['CIN'];
                                                    $c_img = $client['Image'];
                                                    $c_fullname = $client['FullName'];
                                                    $c_nbrorders = $client['OrdersCount'];
                                                    $c_status = $client['Status'];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                               <img src="../Images/uploads/profiles/<?php echo $c_img;?>"/>
                                                            </td>
                                                            <td style="padding-top: 3%;"><?php echo $c_fullname; ?></td>
                                                            <td style="padding-top: 3%;"><?php echo $c_nbrorders; ?></td>
                                                            <td style="padding-top: 3%;"><?php echo $c_status; ?></td>
                                                            <td>
                                                                    <a href="?page=clients&temp=enable-account&cin=<?php echo $c_cin; ?>" style="width:50%" class="btn btn-success"><i class="fas fa-user-check"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                } 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- End View Clients -->
                    <?php
                        break;
            case "enable-account":
                $cin = isset($_GET['cin'])?$_GET['cin']:"0";
                $client = new Client();
                if($client->updateClient($cin,"active"))
                {
                    echo "<script>window.open('?page=clients','_self');</script>";
                }
                break;
            case "disable-account":
                $cin = isset($_GET['cin'])?$_GET['cin']:"0";
                $client = new Client();
                if($client->updateClient($cin,"disabled"))
                {
                    echo "<script>window.open('?page=clients','_self');</script>";
                }
                break;
            case "delete":
                $cin = isset($_GET['cin'])?$_GET['cin']:"0";
                if(checkItem("client","CIN",$cin))
                {
                    foreach(getFrom("client","Image","WHERE CIN = '$cin'") as $row)
                    {
                        $image = $row['Image'];
                    }
                    if($image=="default.jpg")
                    {
                        if(file_exists("../Images/uploads/profiles/$image"))
                        {
                            unlink("../Images/uploads/profiles/$image");
                        }
                    }
                    $client = new Client();
                    if($client->removeClient($cin))
                    {
                        echo 
                        "<script>
                            swal({
                                title: 'Success!',
                                text: 'User has been Deleted Successfuly!',
                                icon: 'success'
                            }).then(() => {
                                window.open('?page=clients','_self');
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
                                window.open('?page=clients','_self');
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
                            text: 'This User Not Exist!',
                            icon: 'error'
                        }).then(() => {
                            window.open('?page=clients','_self');
                        });
                    </script>";
                }
                break;
            case "view-profile":
                $cin = isset($_GET['cin'])?$_GET['cin']:"0";
                $client = new Client();
                $client = $client->getClient($cin);

                $image = $client['Image'];
                $fullName = $client['Prenom']." ".$client['Nom'];
                $mail = $client['Email'];
                $address = $client['Adresse'];
                $b_date = $client['DateNaissance'];
                $cretaion_date = $client['DateCreation'];
                $phone = $client['Tele'];
                $gendre = $client['Sex'];
                $city = $client['Ville'];
                $status = $client['Status'];
                ?>
                <!--Start View Profile-->
                <div class="view-profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="img-box">
                                    <img src="../Images/uploads/profiles/<?php echo $image ?>"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="fullname-box">
                                    <h3><?php echo $fullName."(".$status.")"; ?></h3>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="information-box">
                                            <ul class="list-unstyled">
                                                <li><i class="far fa-envelope"></i>  <?php echo $mail;?></li>
                                                <li><i class="fas fa-map-marker-alt"></i>  <?php echo $address.",".$city;?></li>
                                                <li><i class="fas fa-mobile-alt"></i>  <?php echo $phone;?></li>
                                                <li><i class="fas fa-birthday-cake"></i>  <?php echo $b_date;?></li>
                                                <li><i class="fas fa-venus-mars"></i>  <?php echo $gendre;?></li>
                                                <li><i class="far fa-calendar-check"></i>  <?php echo $cretaion_date;?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                            $client_st = new Client();
                                            $stats = $client_st->getClientStatsOrders($cin);
                                            foreach($stats as $stat)
                                            {
                                                $completed = $stat['completed'];
                                                $pending = $stat['pending'];
                                                $waiting = $stat['waiting'];
                                                $refunde = $stat['refunde'];
                                            }

                                        ?>
                                        <script type="text/javascript">
                                                google.charts.load("current", {packages:["corechart"]});
                                                google.charts.setOnLoadCallback(drawChart);
                                                function drawChart() {
                                                    var data = google.visualization.arrayToDataTable([
                                                    ['Task', 'Hours per Day'],
                                                    ['Waiting',<?php echo $waiting;?>],
                                                    ['Refunde',<?php echo $refunde;?>],
                                                    ['Pending',<?php echo $pending;?>],
                                                    ['Completed',<?php echo $completed;?>],
                                                    ]);

                                                    var options = {
                                                    title: 'Orders Stats',
                                                    is3D: true,
                                                    };

                                                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                                                    chart.draw(data, options);
                                                }
                                        </script>
                                        <div class="chart-box">
                                            <div id="piechart_3d" style="width: 500px; height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="btns-box">
                                <?php
                                    switch($status)
                                    {
                                        case "active":
                                        ?> <a href="?page=clients&temp=disable-account&cin=<?php echo $cin; ?>" class="btn" style="background: #ff6e36;color:#FFF"><i class="fas fa-user-alt-slash"></i></a><?php
                                        break;
                                        case "disabled":
                                        ?><a href="?page=clients&temp=enable-account&cin=<?php echo $cin; ?>" class="btn btn-success" style="background: #119367;"><i class="fas fa-check"></i></a><?php
                                        break;
                                        case "pending":
                                        ?><a href="?page=clients&temp=enable-account&cin=<?php echo $cin; ?>" class="btn btn-success"><i class="fas fa-user-check"></i></a><?php
                                        break;
                                    } 
                                ?>
                                  <a href="?page=clients&temp=delete&cin=<?php echo $cin; ?>" class="confirm-delete btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End View Profile-->
                <?php

                break;
        }
    ?>
</div>
