<?php
class Delivery extends connection
{
    private $cin;
    private $nom;
    private $prenom;
    private $tele;
    private $email;
    private $mdp;

    function DeliveryProperties($cin,$nom,$prenom,$tele,$email,$mdp)
    {
      $this->cin = $cin;
      $this->nom = $nom;
      $this->prenom = $prenom;
      $this->tele = $tele;
      $this->email = $email;
      $this->mdp = $mdp;
    }
    function addDelivery()
    {
      $stmt = $this->connect()->prepare("INSERT INTO livreur(CIN,Nom,Prenom,Tele,Email,MDP) 
      VALUES('$this->cin','$this->nom','$this->prenom','$this->tele','$this->email','$this->mdp')") ;
      if($stmt->execute())
      {
          return true;
      }
      else
      {
          return false;
      }
    }
    function removeDelivery($cin)
    {
      $stmt = $this->connect()->prepare("DELETE FROM livreur WHERE CIN = '$cin'") ;
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
    function getDelivery($cin)
    {
      $stmt = $this->connect()->prepare("SELECT * FROM livreur WHERE CIN = '$cin'") ;
      $stmt->execute();
      $client = $stmt->fetch();
      return $client;
    }
    function getAllDelivery()
    {
      $stmt = $this->connect()->prepare("SELECT * FROM livreur");
      $stmt->execute();
      $clients = $stmt->fetchAll();
      return $clients;
    }
    function updateDelivery($cin,$nom,$prenom,$tele,$email,$mdp)
    {
        // Name,Prix,
      $stmt = $this->connect()->prepare("UPDATE livreur set Nom='$nom',Prenom='$prenom',Tele='$tele',Email = '$email',MDP='$mdp' WHERE CIN='$cin'") ;
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
    function getDeliveryStatsOrders($cin)
    {
        $stmt = $this->connect()->prepare("SELECT (SELECT COUNT(*) FROM commande WHERE commande.CINLivreure is null and commande.CinClient = '$cin') as 'pending',(SELECT COUNT(*) as 'completed' FROM commande WHERE commande.LivreurValide is NOT null and commande.CinClient = '$cin') as 'completed',(SELECT COUNT(*) as 'refunde' FROM commande WHERE commande.LivreureRetour is NOT null and commande.CinClient = '$cin') as 'refunde',(SELECT COUNT(*) as 'waiting' FROM commande WHERE commande.CINLivreure IS NOT null and commande.LivreurValide IS null and commande.LivreureRetour IS null and commande.CinClient = '$cin') as 'waiting' from commande LIMIT 1") ;
        $stmt->execute();
        $stats = $stmt->fetch();
        return $stats;
    }
}