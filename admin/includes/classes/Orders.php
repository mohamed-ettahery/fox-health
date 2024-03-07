<?php
class Orders extends connection
{
    function getAllOrders()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM commande ORDER BY DateCommande DESC") ;
        $stmt->execute();
        $orders = $stmt->fetchAll();
        return $orders;
    }
    function getAllOrdersPending()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM commande  WHERE status = 'attente' ORDER BY DateCommande DESC") ;
        $stmt->execute();
        $orders = $stmt->fetchAll();
        return $orders;
    }
    function getAllOrdersEnLiv()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM commande  WHERE status = 'en livraison' ORDER BY DateCommande DESC") ;
        $stmt->execute();
        $orders = $stmt->fetchAll();
        return $orders;
    }
    function getOrder($num)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM commande WHERE Numero = $num") ;
        $stmt->execute();
        $order = $stmt->fetch();
        return $order;
    }
    function removeOrder($num)
    {
        $stmt = $this->connect()->prepare("DELETE FROM commande WHERE Numero = $num") ;
        $stmt->execute();
        if($stmt->execute())
        {
            $stmt = $this->connect()->prepare("DELETE FROM detailcommande WHERE NumCommande = $num") ;
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
        else
        {
            return false;
        }  
    }
    //function pour Donner a un livreure une commande 
    function setOrderDelivery($Numero,$CIN){
     $stmt = $this->connect()->prepare("Update commande set commande.CINLivreure ='$CIN',commande.status = 'en livraison' where commande.Numero =$Numero");
     if($stmt->execute())
     {
         return true;
     }
     else
     {
         return false;
     }
    }
}