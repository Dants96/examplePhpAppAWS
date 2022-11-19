<?
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $file = '/tmp/sample-app.log';
  $message = file_get_contents('php://input');
  file_put_contents($file, date('Y-m-d H:i:s') . " Received message: " . $message . "\n", FILE_APPEND);
}
else
{
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP Application - AWS Elastic Beanstalk</title>
    <link rel="stylesheet" href="/styles.css" type="text/css" media="screen">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();
        
        // Select/Deselect checkboxes
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function(){
            if(this.checked){
                checkbox.each(function(){
                    this.checked = true;                        
                });
            } else{
                checkbox.each(function(){
                    this.checked = false;                        
                });
            } 
        });
        checkbox.click(function(){
            if(!this.checked){
                $("#selectAll").prop("checked", false);
            }
        });
    });
    </script>
</head>
<body>
    <div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>PHP App Listado</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir a Listado</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						
						<td width="40%">Nombre</td>
						<td width="40%">Email</td>
						<td width="30%">identificacion</td>						
						<td width="10%">Eliminar</td>
					</tr>
				</thead>
				<tbody>
					
						
 <?php
            include 'conexion.php';
            $sql = "SELECT * FROM datos";    
            $result = mysqli_query($conn, $sql);     
            if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
            echo"<tr>";
            
            echo "<td>" . $row["nombres"]. "</td><td> ". $row["correo"]. "</td><td>" . $row["identificacion"]. "</td>";
            echo '<td><form action=eliminar.php method="post"><input type="submit" class="material-icons  btn btn-primary" data-toggle="tooltip"  title="Delete" value="&#xE872;"><input type="hidden"  name="id"  value="'.$row["id"].'"></td></form>';
            echo "</tr>";
              
          }
          } else {
          
           echo '<div class="alert alert-warning" role="alert">No existen datos</div>';
           }                
            
           ?>
					
				</tbody>
			</table>
			
		</div>
	</div>        
</div>
<!-- añadir empleado Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form  action =insertar.php method="post">
				<div class="modal-header">						
					<h4 class="modal-title">Añadir al Listado</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nom" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Correo</label>
						<input type="email" name="correo" class="form-control" required>
					</div>
					
					<div class="form-group">
						<label>identificacion</label>
						<input type="text" name="cc" class="form-control" maxlength="10" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-success" value="añadir">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- eliminar Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form  action =eliminar.php method="post">
				<div class="modal-header">						
					<h4 class="modal-title">Eliminar De Listado</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>seguro que desea elminar item con id 	
          <?php
            echo $_POST["id"];
          ?>		
          		</p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
<?php

include 'conexion.php';

if(!$conn)
{
 echo'<div class="alert alert-danger" role="alert">'; 
 echo'no se pudo conectar a la base de datos !';
 echo'</div>';

        die("conexion fallida" . mysqli_connect_error());
}else{
	//echo'<div class="alert alert-success" role="alert">';
	//echo'conectado a la base de datos !';
	//echo'</div>';
}

// $instancia_id = exec( "cat /sys/hypervisor/uuid");

// echo'<div class="alert alert-dark" role="alert">';
// echo'Conectado a la instancia: <b>'.$instancia_id.'</b>';
// echo'</div>';

?>


    <!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
</body>
</html>
<? 
} 
?>
