<?php
if(isset($_POST['nom']) && isset($_POST['correo']) && isset($_POST['cc'])){
    include 'conexion.php';
    $nombre= $_POST['nom'];
    $correo = $_POST['correo'];
    $cc  = $_POST['cc'];
    
    $sql = "insert into datos(nombres,correo,identificacion) values ('$nombre','$correo','$cc')";
    mysqli_query($conn, $sql); 

    if(true){
        
        echo '<div class="alert alert-warning" role="alert">registro ingresado </div>';
        echo '<h5 class="card-title">Se ha ingresado el registro exito</h5>';    
        header('Location:' . getenv('HTTP_REFERER'));
    }
    else {  
        
        echo '<div class="alert alert-warning" role="alert">registro no ingresado </div>';
        echo '<h5 class="card-title">no Se  ha ingresado el registro exito</h5>';
    }

}





?>