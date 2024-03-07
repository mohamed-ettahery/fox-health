<?php

$dsn = "mysql:host=localhost;dbname=complement_alimentaire";
$options = array(
 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
);

try
{
    $cnx = new PDO($dsn,"root","",$options);

    // echo "You are Connected Now<br/>";
}
catch(PDOException $ex)
{
    echo "Failed Connection : ".$ex ->getMessage();
}
?>