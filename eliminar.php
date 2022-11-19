<?php

if(isset($_POST["id"])){
  include 'conexion.php';
  $id=$_POST["id"];
  $sql="Delete from datos where id=".$id;  
  if(mysqli_query($conn,$sql)){
    echo'funciono'; 
    echo '<div class="alert alert-warning" role="alert">registro eliminado </div>';
    echo '<h5 class="card-title">Se ha eliminado el registro exito</h5>';    
    header('Location:' . getenv('HTTP_REFERER'));
  }
  else {  
    echo'no funciono';  
    echo '<div class="alert alert-warning" role="alert">registro no eliminado </div>';
    echo '<h5 class="card-title">no Se  ha eliminado el registro exito'.$id.'</h5>';
  
  }
  
}
      
  
