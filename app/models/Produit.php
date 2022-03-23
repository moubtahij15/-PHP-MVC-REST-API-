<?php 



class Produit extends DataBase{
    private $conn;
    
      public function __construct(){

        $this->conn=$this->connect();

    }


    public function  read(){


        $sql = 'SELECT * FROM  produit';
    
        $statement = $this->conn->query($sql);
    
    // get all Products
    $produits = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $produits;
    
    }

    // Get Single Post
    public function read_single($id_produit) {
        
       $sql	="SELECT * FROM `produit` WHERE id = ? ";
       $result=$this->conn->prepare($sql);
      if($result->execute([$id_produit])){

        return $result->fetch(PDO::FETCH_ASSOC);

      } else{ return false;}

    
    }
        // create product
        public function create($data){
            $sql="INSERT INTO `produit` (`title`, `quantite`, `categorie`) VALUES (:title, :quantite, :categorie) ";
            $result=$this->conn->prepare($sql);
            //  clean data
          $data->title = htmlspecialchars(strip_tags( $data->title));
          $data->quantite = htmlspecialchars(strip_tags( $data->quantite));
          $data->categorie = htmlspecialchars(strip_tags($data->categorie));
         // Bind data
         return  $result->execute([':title'=>$data->title,
         ':quantite'=>$data->quantite,
         ':categorie'=>$data->categorie]);


        }

        // update product
        public function update($data){
            $sql="update produit set title = :title , quantite= :quantite ,categorie = :categorie where id=:id";
            $result=$this->conn->prepare($sql);
              //  clean data
          $data->title = htmlspecialchars(strip_tags( $data->title));
          $data->quantite = htmlspecialchars(strip_tags( $data->quantite));
          $data->categorie = htmlspecialchars(strip_tags($data->categorie));
          $data->id = htmlspecialchars(strip_tags($data->id));
         // Bind data 

         if($this->read_single($data->id)){
            return  $result->execute([':title'=>$data->title,
            ':quantite'=>$data->quantite,
            ':categorie'=>$data->categorie,
            ':id'=>$data->id]);
         } else {return false;}
        

        }
        
        // delete product
        public function delete($id_produit){
                $sql="delete from produit where id = :id";
                $result=$this->conn->prepare($sql);
                     //  clean data
          $id_produit = htmlspecialchars(strip_tags($id_produit));
          //bind data
          if($this->read_single($id_produit)){
            return  $result->execute([':id'=>$id_produit]);
         } else {return false;}
        

        }



        

    
}




?>