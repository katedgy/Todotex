<?
  session_start();  
?>
<?php include_once("../include/session.php"); ?>

<!doctype html>
<html>

	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" href="../css/log.css">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/datatables.css">
	</head>
<body>
 	
 	<?php include("header.php"); 
		$tipo = $_REQUEST['n'];
	?>



	<div class="container">
		<div class="row">
    	

      	<?php if($tipo == '1') : 
			?> 
             <form action="../process.php" method="post" class="form-signin"> 
                <input type="hidden" size="1" readonly="yes" name="action" id="action" value="add">
                <input type="hidden" size="1" readonly="yes" name="tipo" id="action" value="<?php echo $tipo;?>">
                <input type="hidden" size="1" readonly="yes" name="producto" id="action" value="0">
                <h2 class="titulo"><p class="text-center">Agregar cliente</p></h2>
				<br />
				<input id="	nombre" type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?php echo $form->value("nombre"); ?>"/>
                <?php
					$errname = $form->error("nombre");
					if($errname!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errname.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?><br />
				
				<input class="form-control" type="text" name="rif" placeholder="RIF" value="<?php echo $form->value("rif"); ?>"/>
				<?php
					$errrif = $form->error("rif");
					if($errrif!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errrif.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?><br />

				<input class="form-control" type="text" name="direccion" placeholder="Direccion"  value="<?php echo $form->value("direccion"); ?>"/>				
				<?php
					$errdireccion = $form->error("direccion");
					if($errdireccion!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errdireccion.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?><br />

				<input class="form-control" type="text" name="telefono" placeholder="Telefono"  value="<?php echo $form->value("telefono"); ?>"/>
				<?php
					$errtelefono = $form->error("telefono");
					if($errtelefono!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errtelefono.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?><br /><br />
<!-- 
				<label for="email">Email</label><br/>
				<input type="text" name="email" value="<?php #echo $form->value("email"); ?>"/>
				<?php
					#$erremail = $form->error("email");
					#if($erremail!="")
					{
					#echo '<span class="text-error-field">&nbsp;'.$erremail.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?><br /><br /> -->

                <button id="mensaje" type="submit" name="agregar" class="btn btn-lg btn-primary btn-block">Agregar</button>
                <input id="mensaje" type="button" name="cancelar" class="btn btn-lg btn-primary btn-block" value="Cancelar" onclick="history.back(-1)"/>
			</form>
			
			<?php elseif($tipo == '2') : 
			?>

			<form action="../process.php" method="post" class="form-signin"> 
                <input type="hidden" size="1" readonly="yes" name="action" id="action" value="add">
                <input type="hidden" size="1" readonly="yes" name="tipo" id="action" value="<?php echo $tipo;?>">

                <h2 class="titulo"><p class="text-center">Agregar proveedor</p></h2><br />
				<input id="	nombre" type="text" name="nombre" class="form-control" placeholder="Nombre"  value="<?php echo $form->value("nombre"); ?>"/>
                <?php
					$errname = $form->error("nombre");
					if($errname!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errname.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?>
                 <br />
				<input  type="text" name="rif" class="form-control" placeholder="RIF" value="<?php echo $form->value("rif"); ?>"/>
				<?php
					$errrif = $form->error("rif");
					if($errrif!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errrif.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?>
                 <br />
				<input  type="text" name="direccion" class="form-control" placeholder="Direccion" value="<?php echo $form->value("direccion"); ?>"/>				
				<?php
					$errdireccion = $form->error("direccion");
					if($errdireccion!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errdireccion.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?><br />
				<input class="form-control" placeholder="Telefono" type="text" name="telefono" value="<?php echo $form->value("telefono"); ?>"/>
				<?php
					$errtelefono = $form->error("telefono");
					if($errtelefono!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errtelefono.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?><br />
				<select name="producto" class="form-control">
						<option name="producto">Seleccione un producto</option>
				<?php
					$prod = $database -> getProductos();
					if (sizeof($prod) > 0) {
						for ($i=0; $i<sizeof($prod); $i++) { ?>
								
							<option name="producto" value="<?php echo $prod[$i]["nombre"]; ?>" > <?php echo $prod[$i]["nombre"]; ?></option>
					<?php
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

                <button id="mensaje" type="submit" name="agregar" class="btn btn-lg btn-primary btn-block">Agregar</button>
                <input id="mensaje" type="button" name="cancelar" class="btn btn-lg btn-primary btn-block" value="Cancelar" onclick="history.back(-1)"/>

			</form>
						
			<?php elseif($tipo == '3') : 
			?>

			<form action="../process.php" method="post" class="form-signin"> 
                <input type="hidden" size="1" readonly="yes" name="action" id="action" value="add">
                <input type="hidden" size="1" readonly="yes" name="tipo" id="action" value="<?php echo $tipo;?>">

                <h2 class="titulo"><p class="text-center">Agregar producto</p></h2><br />
				<input id="	nombre" type="text" name="nombre" class="form-control" placeholder="Producto" value="<?php echo $form->value("nombre"); ?>"/>
                <?php
					$errname = $form->error("nombre");
					if($errname!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errname.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?>
                 <br /><span>*Elija "no aplica" si el producto no posee talla.</span>
                 <select class="form-control" name="talla" id="talla">
	 	        			<option id="talla" name="talla" value="Selecione una opcion">Selecione una talla</option>
			        		<?php
			        			$talla=$database->getTallas();
			        			if (sizeof($talla)>0) {
			        				for ($i=0; $i < sizeof($talla); $i++) 
			        				{ ?>
			        					<option id="talla" name="talla" value="<?php echo $talla[$i]['idtalla']; ?>"><?php echo $talla[$i]['talla'];?></option>
			        			<?php }
			        			}
			        		?>
			        	</select>
<!-- 				<input id="	descrip" type="text" name="descrip" class="form-control" placeholder="Descripci&oacute;n" value="<?php #echo $form->value("descrip"); ?>"/>
                <?php
					#$errdescrip = $form->error("descrip");
					#if($errdescrip!="")
					{
					#echo '<span class="text-error-field">&nbsp;'.$errdescrip.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?> -->
                 <br />
				<input id="	precio" type="text" name="precio" class="form-control" placeholder="Precio" value="<?php echo $form->value("precio"); ?>"/>
                <?php
					$errprecio = $form->error("precio");
					if($errprecio!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errprecio.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?>
                 <br />
                <input id="stock" type="text" name="stock" class="form-control" placeholder="Stock" id="txt_onKeyPressed" value="<?php echo $form->value("stock"); ?>"/>
                <?php
					$errstock = $form->error("stock");
					if($errstock!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errstock.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?>
                 <br />
				<select name="producto" class="form-control"> <!-- producto == categoria -->
				<option name="producto">Seleccione una categoria</option>
				<?php
					$cat = $database -> getAllCategorias();
					if (sizeof($cat) > 0) {
						for ($i=0; $i<sizeof($cat); $i++) { ?>
								
				<option name="producto" value="<?php echo $cat[$i]["idcategoria"]; ?>" > <?php echo $cat[$i]["nombre"]; ?></option>
					<?php
						}
					}
					$errproducto = $form->error("producto");
					if($errproducto!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errproducto.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?>
                 </select>	
				<br />
                <button id="mensaje" type="submit" name="agregar" class="btn btn-lg btn-primary btn-block">Agregar</button>
                <input id="mensaje" type="button" name="cancelar" class="btn btn-lg btn-primary btn-block" value="Cancelar" onclick="history.back(-1)"/>
			</form>
			

			<?php elseif($tipo == '4') : 
			?>
			<form action="../process.php" method="post" class="form-signin"> 
                <input type="hidden" size="1" readonly="yes" name="action" id="action" value="add">
                <input type="hidden" size="1" readonly="yes" name="tipo" id="action" value="<?php echo $tipo;?>">

                <h2 class="titulo"><p class="text-center">Agregar Usuario</p></h2><br />
				<input id="	nombre" type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo $form->value("nombre"); ?>"/>
                <?php
					$errname = $form->error("nombre");
					if($errname!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errname.'&nbsp;&nbsp;&nbsp;</span>';
					}
                 ?>				 <br />

				<input class="form-control" placeholder="Contrase&ntilde;a" id="clave" type="text" name="clave" value="<?php echo $form->value("clave"); ?>"/>
				<?php
					$errclave = $form->error("clave");
					if($errclave!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errclave.'&nbsp;&nbsp;&nbsp;</span>';
					}
				 ?>
				 <br />
				 <h5>Nivel</h5>
				 <select name="nivel" class="form-control" multiple size="3">
							<option name="nivel" value="1" >1</option>
							<option name="nivel" value="2" >2</option>
							<option name="nivel" value="3" >3</option>
                 </select>	
                 <?php
					$errnivel = $form->error("nivel");
					if($errnivel!="")
					{
					echo '<span class="text-error-field">&nbsp;'.$errnivel.'&nbsp;&nbsp;&nbsp;</span>';
					}
				 ?>	
				<br />
                <button id="mensaje" type="submit" name="agregar" class="btn btn-lg btn-primary btn-block">Agregar</button>
                <input id="mensaje" type="button" name="cancelar" class="btn btn-lg btn-primary btn-block" value="Cancelar" onclick="history.back(-1)"/>
			</form>
			<?php endif; ?>
		</div>
	</div>

		<!-- jQuery -->
		<script type="text/javascript" charset="utf8" src="../js/jquery.js"></script>
		<script type="text/javascript" charset="utf8" src="../js/jquery.formatCurrency-1.4.0.js"></script>
		<!-- bootstrap -->
		<script type="text/javascript" charset="utf8" src="../js/bootstrap.min.js"></script>
		<!-- DataTables -->
		<script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.min.js"></script>
		<script src="../js/dataTables.bootstrap.js"></script>


		<script type="text/javascript">
		$(document).ready( function () {
		    $('#table_id').DataTable();
		} );

		$(function() {
 
		   $('#textarea').textext({ plugins: 'tags' });
		 
		   $('#addtag').bind('click', function(e){
		      $('#textarea').textext()[0].tags().addTags([ $('#tagname').val() ]);
		      $('#tagname').val('');
		   });
		 
		});

		function applyFormatCurrency(sender) {
		    $(sender).formatCurrency({
		        roundToDecimalPlace: -1
		    });
		}
        </script>
		</script>

</body>

</html>