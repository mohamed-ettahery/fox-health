<?php
class Category extends connection
{
    private $name;
    private $description;

    function CategoryProperties($name,$description)
    {
     
      $this->name = $name;
      $this->description = $description;
    }
    function addCategory()
    {
      $stmt = $this->connect()->prepare("INSERT INTO categorie(Nom,description) VALUES('$this->name','$this->description')") ;
      if($stmt->execute())
      {
          return true;
      }
      else
      {
          return false;
      }
    }
    function removeCategory($id)
    {
      $stmt = $this->connect()->prepare("DELETE FROM categorie WHERE ID = $id") ;
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
    function getCategory($id)
    {
      $stmt = $this->connect()->prepare("SELECT * FROM categorie WHERE ID = $id") ;
      $stmt->execute();
      $cat = $stmt->fetch();
      return $cat;
    }
    function getAllCats()
    {
      $stmt = $this->connect()->prepare("SELECT ID,Nom,(SELECT COUNT(*) FROM produit WHERE produit.IDCategorie = categorie.ID) as 'CountProduct',description FROM categorie ORDER BY ID DESC") ;
      $stmt->execute();
      $cats = $stmt->fetchAll();
      return $cats;
    }
    function updateCategory($id,$name,$description)
    {
        // Name,Prix,IDCategorie,Image,description
      $stmt = $this->connect()->prepare("UPDATE categorie set Nom='$name',description='$description' WHERE ID=$id") ;
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
}