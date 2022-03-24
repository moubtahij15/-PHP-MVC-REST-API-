<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class ProduitsController {


  public  function index(){




        echo "heelooo";
    }
   
 
      public function read(){

        if($_SERVER["REQUEST_METHOD"] == "GET"){ 
            $produit = new produit();

            // Blog post query
            $result = $produit->read();
            // Turn to JSON & output
            echo json_encode($result);

        }  else  echo json_encode(
          array('message' => 'change method to GET')
                );

       
    
      }


      
      public function read_single($id){
           
        if($_SERVER["REQUEST_METHOD"] == "GET"){ 
              $produit = new produit();

              //    get id
              // $id = isset($_GET['id']) ? $_GET['id'] : die("please enter id");

              // get product

              $product =$produit->read_single($id);


              if($product){
              print_r( json_encode($product)) ;

              } else {

              print_r( json_encode(array('message' => 'No Product Found'))) ;
              }

         } else   echo json_encode(
          array('message' => 'change method to GET')
                );

       



            }

            public function create(){
            

              if($_SERVER["REQUEST_METHOD"] == "POST"){

                      $produit = new produit();
                    //get posted data
                    $data= json_decode(file_get_contents("php://input"));
                    // create product
                    if($produit->create($data)){

                    echo json_encode(
                            array('message' => 'Post Created')
                            );
                }else { 
                        echo json_encode(
                        array('message' => 'Post Not Created')
                        );
                }

              } else  echo json_encode(
                      array('message' => 'change method to Post')
                            );
               

            }


            public function update(){

              if($_SERVER["REQUEST_METHOD"] == "PUT"){

                    $produit = new produit();

                      //get posted data
                      $data= json_decode(file_get_contents("php://input"));
                      // create product
                      if($produit->update($data)){

                          echo json_encode(
                              array('message' => 'Post updated')
                            );
                      }else { 
                          echo json_encode(
                            array('message' => 'Post Not updated check your id')
                          );
                        }

                    }else echo json_encode(
                      array('message' => 'change method to PUT')
                    );

              } 
              
              public function delete($id){
                if($_SERVER["REQUEST_METHOD"] == "DELETE"){
                  $produit = new produit();

                  
                      if($produit->delete($id)){

                      echo json_encode(
                        array('message' => 'Post deleted')
                      );
                      }else { 
                      echo json_encode(
                      array('message' => 'Post Not deleted')
                      );
                      }

                      }else echo json_encode(
                        array('message' => 'change method to DELETE')
                      );
  
                }
               



   // Instantiate blog post object
  





}


?>