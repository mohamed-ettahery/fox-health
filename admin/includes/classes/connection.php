<?php
class connection
{
    private $name = "root"; 
    private $pass = ""; 
    private $dsn =  "mysql:host=localhost;dbname=complement_alimentaire";

    function connect()
    {
      $options = array(
       PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
      );
      
      try
      {
          $cnx = new PDO($this->dsn,$this->name,$this->pass,$options);
          return $cnx;
      }
      catch(PDOException $ex)
      {
          echo "Failed Connection : ".$ex ->getMessage();
      }
    }
}