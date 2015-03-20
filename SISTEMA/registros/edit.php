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

					<?php if($tipo == '1') : 
			 	 		$getCli = $database->getClientesbyId($id);
			 	 	
			 	 	?>
			 	 		<form action="../process.php" method="post" class="form-signin"> 
			                <input type="hidden" size="1" readonly="yes" name="action" id="action" value="edit">
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
					<!-- PROVEEDORES					-->
					<?php elseif($tipo == '2') : 
			 	 		$getProv = $database->getProvbyId($id);
			 	 	
			 	 	?>
			 	 		<form action="../process.php" method="post" class="form-signin"> 
			                <input type="hidden" size="1" readonly="yes" name="action" id="action" value="edit">
			                <input type="hidden" size="1" readonly="yes" name="id" id="action" value="<?php echo $id;?>">
			                <input type="hidden" size="1" readonly="yes" name="tipo" id="action" value="<?php echo $tipo;?>">

			                <h1 class="titulo">Modificar Proveedor</h1>

							<?php
								$valnombre = $session->checkValueVar($form->value('nombre'),$getProv[0]['nombre']);
								$valrif = $session->checkValueVar($form->value('rif'),$getProv[0]['rif']);
								$valdirec = $session->checkValueVar($form->value('direccion'),$getProv[0]['direc']);
								$valtlf = $session->checkValueVar($form->value('telefono'),$getProv[0]['tlf']);
								$valprod = $session->checkValueVar($form->value('producto'),$getProv[0]['tipo']);

							?>
							<input class="form-control" placeholder="Nombre" type="text" name="nombre" value="<?php echo $valnombre;?>"/>
			                <?php
								$errname = $form->error("nombre");
								if($errname!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errname.'&nbsp;&nbsp;&nbsp;</span>';
								}
			                 ?>
			                 <br />
							
							<input class="form-control" placeholder="RIF" type="text" name="rif" value="<?php echo $valrif;?>"/>
							<?php
								$errrif = $form->error("rif");
								if($errrif!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errrif.'&nbsp;&nbsp;&nbsp;</span>';
								}
			                 ?>
			                 <br />

							<textarea class="form-control" placeholder="Direccion" type="text" name="direccion" style="resize:none;height: 115px;"/><?php echo $valdirec;?></textarea>			
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
							
							<select name="producto" class="form-control">
									<option name="producto">Seleccione un producto</option>
									<option selected name="producto" value="<?php echo $valprod; ?>" > <?php echo $valprod; ?></option>

							<?php
								$prod = $database -> getProductos();
								if (sizeof($prod) > 0) {
									for ($i=0; $i<sizeof($prod); $i++) { 
										if ($prod[$i]["nombre"] != $valprod) {?>
										<option name="producto" value="<?php echo $prod[$i]["nombre"]; ?>" > <?php echo $prod[$i]["nombre"]; ?></option>
								<?php
										}
									}
								}
								// $errproducto = $form->error("producto");
								// if($errproducto!="")
								// {
								// echo '<span class="text-error-field">&nbsp;'.$errproducto.'&nbsp;&nbsp;&nbsp;</span>';
								// }
			                 ?>
			                 </select>	
							<br /><br />
			                <button id="mensaje" type="submit" name="agregar" class="btn btn-lg btn-primary btn-block">Actualizar</button>
						    <input id="mensaje" type="button" name="cancelar" class="btn btn-lg btn-primary btn-block" value="Cancelar" onclick="history.back(-1)"/>
						</form>		
				<!-- PRODUCTOS					-->
					<?php elseif($tipo == '3') : 
			 	 		$getProd = $database->getProdbyId($id);
			        	$arrayCat = $database->getCategoria($getProd[0]['idcategoria']);
			        	$arrayTa = $database->getTallasbyID($getProd[0]['talla']);

			 	 	?>
			 	 		<form action="../process.php" method="post" class="form-signin"> 
			                <input type="hidden" size="1" readonly="yes" name="action" id="action" value="edit">
			                <input type="hidden" size="1" readonly="yes" name="id" id="action" value="<?php echo $id;?>">
			                <input type="hidden" size="1" readonly="yes" name="tipo" id="action" value="<?php echo $tipo;?>">

			                <h1 class="titulo">Modificar Producto</h1>

							<?php
								$valnombre = $session->checkValueVar($form->value('nombre'),$getProd[0]['nombre']);
								$valtalla= $session->checkValueVar($form->value('talla'),$arrayTa[0]['talla']);
								$valprecio = $session->checkValueVar($form->value('precio'),$getProd[0]['precio']);
								$valstock = $session->checkValueVar($form->value('stock'),$getProd[0]['stock']);
								$valcategoria = $session->checkValueVar($form->value('producto'),$arrayCat[0]['nombre']);
								$validcategoria = $session->checkValueVar($form->value('idcategoria'),$getProd[0]['idcategoria']);
							?>
							<input class="form-control" placeholder="Nombre" type="text" name="nombre" value="<?php echo $valnombre;?>"/>
			                <?php
								$errname = $form->error("nombre");
								if($errname!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errname.'&nbsp;&nbsp;&nbsp;</span>';
								}
			                 ?>							
							<br />
            				<select class="form-control" name="talla" id="talla">
	 	        			<option id="talla" name="talla" value="Selecione una opcion">Selecione una talla</option>
	 	        			<option selected name="talla" value="<?php echo $getProd[0]['talla']; ?>" ><?php echo $valtalla; ?></option>
			        		<?php
			        			$talla=$database->getTallas();
			        			if (sizeof($talla)>0) {
			        				for ($i=0; $i < sizeof($talla); $i++) 
			        				{ 
			        				if ($talla[$i]["talla"] != $valtalla) { ?>
			        					<option id="talla" name="talla" value="<?php echo $talla[$i]['idtalla']; ?>"><?php echo $talla[$i]['talla'];?></option>
			        			<?php }
			        				}
			        			}
			        		?>
			        	</select>
							 <br />

							<input class="form-control" placeholder="Precio" id="precio" type="text" name="precio" value="<?php echo $valprecio; ?>"/>
							<?php
								$errprecio = $form->error("precio");
								if($errprecio!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errprecio.'&nbsp;&nbsp;&nbsp;</span>';
								}
							 ?>
							 <br />
							<input class="form-control" placeholder="Stock" id="stock" type="text" name="stock" value="<?php echo $valstock; ?>"/>
							<?php
								$errstock = $form->error("stock");
								if($errstock!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errstock.'&nbsp;&nbsp;&nbsp;</span>';
								}
							 ?>
							 <br />
							<select name="producto" class="form-control">
									<option name="producto">Seleccione una categoria</option>
									<option selected name="producto" value="<?php echo $validcategoria; ?>" ><?php echo $valcategoria; ?></option>

							<?php
								$cat = $database -> getAllCategorias();
								if (sizeof($cat) > 0) {
									for ($i=0; $i<sizeof($cat); $i++) { 
										if ($cat[$i]["nombre"] != $valcategoria) {?>
										<option name="producto" value="<?php echo $cat[$i]["idcategoria"]; ?>" > <?php echo $cat[$i]["nombre"]; ?></option>
								<?php
										}
									}
								}
								// $errproducto = $form->error("producto");
								// if($errproducto!="")
								// {
								// echo '<span class="text-error-field">&nbsp;'.$errproducto.'&nbsp;&nbsp;&nbsp;</span>';
								// }
			                 ?>
			                 </select>	
							 <br />
			                <button id="mensaje" type="submit" name="agregar" class="btn btn-lg btn-primary btn-block">Actualizar</button>
						    <input id="mensaje" type="button" name="cancelar" class="btn btn-lg btn-primary btn-block" value="Cancelar" onclick="history.back(-1)"/>
						</form>

					<!-- USUARIOS					-->
					<?php elseif($tipo == '4') : 
			 	 		$getUser = $database->getUserbyID($id);

			 	 	?>
			 	 		<form action="../process.php" method="post" class="form-signin"> 
			                <input type="hidden" size="1" readonly="yes" name="action" id="action" value="edit">
			                <input type="hidden" size="1" readonly="yes" name="id" id="action" value="<?php echo $id;?>">
			                <input type="hidden" size="1" readonly="yes" name="tipo" id="action" value="<?php echo $tipo;?>">

			                <h1 class="titulo">Modificar Usuario</h1>

							<?php
								$valnombre = $session->checkValueVar($form->value('nombre'),$getUser[0]['nombre']);
								$valclave= $session->checkValueVar($form->value('clave'),$getUser[0]['clave']);
								$valnivel = $session->checkValueVar($form->value('nivel'),$getUser[0]['nivel']);
							?>
							<input class="form-control" placeholder="Nombre" type="text" name="nombre" value="<?php echo $valnombre;?>"/>
			                <?php
								$errname = $form->error("nombre");
								if($errname!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errname.'&nbsp;&nbsp;&nbsp;</span>';
								}
			                 ?>							
							<br />
            				
							<input class="form-control" placeholder="Contraseña" id="clave" type="text" name="clave" value="<?php echo $valclave; ?>"/>
							<?php
								$errclave = $form->error("clave");
								if($errclave!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errclave.'&nbsp;&nbsp;&nbsp;</span>';
								}
							 ?>
							 <br />
							 <select name="nivel" class="form-control">
									<option name="nivel">Seleccione un nivel</option>
									<option selected name="nivel" value="<?php echo $valnivel;?>" ><?php echo $valnivel;?></option>

							<?php
									if ($valnivel == "1"){?>
										<option name="nivel" value="2" >2</option>
										<option name="nivel" value="3" >3</option>
							<?php 	}elseif ($valnivel == "2"){?>
										<option name="nivel" value="1" >1</option>
										<option name="nivel" value="3" >3</option>
							<?php
									}elseif ($valnivel == "3"){?>
										<option name="nivel" value="1" >1</option>
										<option name="nivel" value="2" >2</option>
							<?php
									}
			                 ?>
			                 
			                 </select>	
			                 							<?php
								$errnivel = $form->error("nivel");
								if($errnivel!="")
								{
								echo '<span class="text-error-field">&nbsp;'.$errnivel.'&nbsp;&nbsp;&nbsp;</span>';
								}
							 ?>	
							 <br />
			                <button id="mensaje" type="submit" name="agregar" class="btn btn-lg btn-primary btn-block">Actualizar</button>
						    <input id="mensaje" type="button" name="cancelar" class="btn btn-lg btn-primary btn-block" value="Cancelar" onclick="history.back(-1)"/>
						</form>		
					<?php endif; ?>
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