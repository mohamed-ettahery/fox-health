<?php

function getCount($table,$where="")
{
    global $cnx;
    $stmt = $cnx->prepare("SELECT * FROM $table $where");
    $stmt->execute();
    return $stmt->rowCount();
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