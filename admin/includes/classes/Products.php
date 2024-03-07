<?php
class Products extends connection
{
    private $name;
    private $price;
    private $idCategory;
    private $image;
    private $description;
    private $promotion;
    private $rating;

    function ProductProperties($name,$price,$idCategory,$image,$description,$promotion,$rating)
    {
     
      $this->name = $name;
      $this->price = $price;
      $this->idCategory = $idCategory;
      $this->image = $image;
      $this->description = $description;
      $this->promotion = $promotion;
      $this->rating = $rating;
    }
    function addProduct()
    {
      $stmt = $this->connect()->prepare("INSERT INTO produit(Name,Prix,IDCategorie,Image,description,Promotion,Rating) VALUES('$this->name','$this->price','$this->idCategory','$this->image','$this->description',$this->promotion,$this->rating)") ;
      if($stmt->execute())
      {
          return true;
      }
      else
      {
          return false;
      }
    }
    function removeProduct($id)
    {
      $stmt = $this->connect()->prepare("DELETE FROM produit WHERE id = $id") ;
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
    function getProduct($id)
    {
      $stmt = $this->connect()->prepare("SELECT produit.id,produit.Image,produit.Name as 'name',IDCategorie as 'idCat',categorie.Nom as 'catName',produit.Prix as 'price',produit.description,produit.Promotion,produit.Rating FROM produit INNER JOIN categorie on categorie.ID = produit.IDCategorie WHERE produit.id = $id") ;
      $stmt->execute();
      $product = $stmt->fetch();
      return $product;
    }
    function getAllProducts()
    {
      $stmt = $this->connect()->prepare("SELECT produit.id,produit.Image,produit.Name as 'name',categorie.Nom as 'catName',produit.Prix as 'price',produit.description,produit.Promotion,produit.Rating FROM produit INNER JOIN categorie on categorie.ID = produit.IDCategorie ORDER BY produit.id DESC") ;
      $stmt->execute();
      $products = $stmt->fetchAll();
      return $products;
    }
    function updateProduct($id,$name,$price,$idCategory,$image,$description,$promotion,$rating)
    {
        // Name,Prix,IDCategorie,Image,description
      $stmt = $this->connect()->prepare("UPDATE produit set Name='$name',Prix=$price,IDCategorie=$idCategory,Image='$image',description='$description',Promotion = $promotion,Rating = $rating WHERE id=$id") ;
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