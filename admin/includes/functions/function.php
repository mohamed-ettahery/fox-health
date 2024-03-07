<?php
function getLastOrders()
{
    global $cnx;
    $stmt = $cnx->prepare("SELECT Numero,CinClient as 'Client',DateCommande as 'OrderDate',Status FROM commande ORDER BY Numero DESC LIMIT 4");
    $stmt->execute();
    $orders = $stmt->fetchAll();
    return $orders;
}
function getLastUsers()
{
    global $cnx;
    $stmt = $cnx->prepare("SELECT CIN,Image,Status FROM client ORDER BY DateCreation DESC LIMIT 4");
    $stmt->execute();
    $users = $stmt->fetchAll();
    return $users;
}
function getOrdersStats()
{
    global $cnx;
    $stmt = $cnx->prepare("CALL sp_getOrdersStats");
    $stmt->execute();
    $stats = $stmt->fetchAll();
    return $stats;
}
function getCountOrdersStats()
{
    global $cnx;
    $stmt = $cnx->prepare("CALL sp_getCountOrdersStats");
    $stmt->execute();
    $stats = $stmt->fetchAll();
    return $stats;
}
function getCount($table,$where="")
{
    global $cnx;
    $stmt = $cnx->prepare("SELECT * FROM $table $where");
    $stmt->execute();
    return $stmt->rowCount();
}
function getCats()
{
    global $cnx;
    $stmt = $cnx->prepare("SELECT * FROM categorie");
    $stmt->execute();
    $cats = $stmt->fetchAll();
    return $cats;
}
function checkItem($table,$champ,$val)
{
    global $cnx;
    if(gettype($val)=="string")
    {
        $stmt = $cnx->prepare("SELECT * FROM $table WHERE $champ='$val'");
    }
    else
    {
        $stmt = $cnx->prepare("SELECT * FROM $table WHERE $champ=$val");
    }
    $stmt->execute();
    return $stmt->rowCount()>0?true:false;
}
function getFrom($table,$select="*",$where="")
{
    global $cnx;
    $stmt = $cnx->prepare("SELECT $select FROM $table $where");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}
function getFetch($table,$select="*",$where="")
{
    global $cnx;
    $stmt = $cnx->prepare("SELECT $select FROM $table $where");
    $stmt->execute();
    $rows = $stmt->fetch();
    return $rows;
}

 ?>