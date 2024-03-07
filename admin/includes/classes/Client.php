<?php
class Client extends connection
{
    private $cin;
    private $fname;
    private $lname;
    private $address;
    private $phone;
    private $gendre;
    private $city;
    private $mail;
    private $password;
    private $image;

    function ClientProperties($cin,$fname,$lname,$address,$phone,$gendre,$city,$mail,$password,$image)
    {
      $this->cin = $cin;
      $this->fname = $fname;
      $this->lname = $lname;
      $this->address = $address;
      $this->phone = $phone;
      $this->gendre = $gendre;
      $this->city = $city;
      $this->mail = $mail;
      $this->password = $password;
      $this->image = $image;
    }
    function addClient()
    {
      $stmt = $this->connect()->prepare("INSERT INTO client(CIN,Nom,Prenom,Adresse,Tele,Sex,Ville,Email,DateNaissance,MDP,Image) 
      VALUES('$this->cin','$this->lname','$this->fname','$this->address','$this->phone','$this->gendre','$this->city','$this->mail',$this->b_date,'$this->password','$this->image')") ;
      if($stmt->execute())
      {
          return true;
      }
      else
      {
          return false;
      }
    }
    function removeClient($cin)
    {
      $stmt = $this->connect()->prepare("DELETE FROM client WHERE CIN = '$cin'") ;
      $stmt->execute();
      if($stmt->execute())
      {
          return true;
      }
      else
      {
          return false;
      }  
    }
    function getClient($cin)
    {
      $stmt = $this->connect()->prepare("SELECT * FROM client WHERE CIN = '$cin'") ;
      $stmt->execute();
      $client = $stmt->fetch();
      return $client;
    }
    function getAllClients()
    {
      $stmt = $this->connect()->prepare("SELECT CIN,Image,CONCAT(Prenom,' ',Nom) as 'FullName',Ville as 'City',(SELECT COUNT(*) FROM commande WHERE commande.CinClient = CIN) as 'OrdersCount',Status FROM client ORDER BY DateCreation DESC");
      $stmt->execute();
      $clients = $stmt->fetchAll();
      return $clients;
    }
    function getAllClientsCondition($where)
    {
      $stmt = $this->connect()->prepare("SELECT CIN,Image,CONCAT(Prenom,' ',Nom) as 'FullName',Ville as 'City',(SELECT COUNT(*) FROM commande WHERE commande.CinClient = CIN) as 'OrdersCount',Status FROM client $where ORDER BY DateCreation DESC");
      $stmt->execute();
      $clients = $stmt->fetchAll();
      return $clients;
    }
    function updateClient($cin,$status)
    {
        // Name,Prix,
      $stmt = $this->connect()->prepare("UPDATE client set Status='$status' WHERE CIN='$cin'") ;
      $stmt->execute();
      if($stmt->execute())
      {
          return true;
      }
      else
      {
          return false;
      } 
    }
    function getClientStatsOrders($cin)
    {
        $stmt = $this->connect()->prepare("SELECT (SELECT COUNT(*) FROM commande WHERE commande.status = 'attente') as 'pending',(SELECT COUNT(*) as 'completed' FROM commande WHERE commande.status = 'complété') as 'completed',(SELECT COUNT(*) as 'refunde' FROM commande WHERE commande.status = 'retour') as 'refunde',(SELECT COUNT(*) as 'waiting' FROM commande WHERE commande.status = 'en livraison') as 'waiting' from commande WHERE CinClient  = '$cin' LIMIT 1") ;
        $stmt->execute();
        $stats = $stmt->fetchAll();
        return $stats;
    }
}