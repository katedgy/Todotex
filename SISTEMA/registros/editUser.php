<?
  session_start();  
?>
<?php include_once("../include/session.php"); ?>
<!doctype html>
<html>
	<head>
		<title>Modificar</title>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" href="../css/log.css">
		<link rel="stylesheet" href="../css/form.css" />
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/datatables.css">
	</head>
<body>
 	
 	<?php include("header.php"); ?>

	<div class="container">
		<div class="row">
                <?php
			 	 	$id = $_REQUEST['id'];
			 	 	$tipo = $_REQUEST['n'];
			 	 	?>

					<?php 
			 	 		$getCli = $database->getClientesbyId($id);
			 	 	
			 	 	?>
			 	 		<form action="../process.php" method="post" class="form-signin"> 
			                <input type="hidden" size="1" readonly="yes" name="action" id="action" value="editUser">
			                <input type="hidden" size="1" readonly="yes" name="id" id="action" value="<?php echo $id;?>">
			                <input type="hidden" size="1" readonly="yes" name="tipo" id="action" value="<?php echo $tipo;?>">

			                <h1 class="titulo">Modificar cliente</h1>

							<?php
								$valnombre = $session->checkValueVar($form->value('nombre'),$getCli[0]['nombre']);
								$valrif = $session->checkValueVar($form->value('rif'),$getCli[0]['rif']);
								$valdirec = $session->checkValueVar($form->value('direccion'),$getCli[0]['direc']);
								$valtlf = $session->checkValueVar($form->value('telefono'),$getCli[0]['tlf']);
							?>
							<input  class="form-control" placeholder="Nombre" type="text" name="nombre" value="<?php echo $valnombre;?>"/>
			                <?php
								$errname = $form->error("nombre");
								if($errname!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errname.'&nbsp;&nbsp;&nbsp;</span>';
								}
			                 ?>
			                 <br />
							<input  class="form-control" placeholder="RIF" type="text" name="rif" value="<?php echo $valrif;?>"/>
							<?php
								$errrif = $form->error("rif");
								if($errrif!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errrif.'&nbsp;&nbsp;&nbsp;</span>';
								}
			                 ?>
			                 <br />

							<textarea class="form-control" placeholder="Direccion" type="text" name="direccion" style="resize:none;height: 115px;" /><?php echo $valdirec;?></textarea>			
							<?php
								$errdireccion = $form->error("direccion");
								if($errdireccion!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errdireccion.'&nbsp;&nbsp;&nbsp;</span>';
								}
			                 ?><br />

							<input class="form-control" placeholder="Telefono" type="text" name="telefono" value="<?php echo $valtlf;?>"/>
							<?php
								$errtelefono = $form->error("telefono");
								if($errtelefono!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errtelefono.'&nbsp;&nbsp;&nbsp;</span>';
								}
			                 ?><br />
				
			                <button id="mensaje" type="submit" name="agregar" class="btn btn-lg btn-primary btn-block">Actualizar</button>
						    <input id="mensaje" type="button" name="cancelar" class="btn btn-lg btn-primary btn-block" value="Cancelar" onclick="history.back(-1)"/>
						</form>

			</div>
		</div>

		<!-- jQuery -->
		<script type="text/javascript" charset="utf8" src="../js/jquery.js"></script>
		<!-- bootstrap -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<!-- DataTables -->
		<script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.min.js"></script>
		<script src="../js/dataTables.bootstrap.js"></script>

		<script type="text/javascript">
		$(document).ready(function () {
		    $('#table_id').DataTable();
		} );
		</script>
</body>

</html>