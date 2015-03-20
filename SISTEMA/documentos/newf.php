<?
  session_start();  

?>
<?php 
	$idF = $_REQUEST['id'];
	$tipo = $_REQUEST['n'];

	include_once("../include/session.php"); 

	
	include('main.inc.php');

	$contenido="";
	if($statusConexion==true){
		$contenido=consultaUsuarios($idF);	
	}
?>

	<!doctype html5>
	<html>

		<head>
		    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

			<title>Factura</title>
			<link rel="stylesheet" type="text/css" href="../css/main.css">
			<link rel="stylesheet" href="../css/log.css">

			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="../css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="../css/datatables.css">

			<link href="../css/jquery-ui.css" type="text/css" rel="stylesheet"/>


		</head>
	<body>
	 	
	 	<?php include("header.php"); 
		?>


		<div class="container">

			<div class="row ">

			<!-- Form emergente agregar producto -->
				<div id="div-frm"> 

	        		<form name="frm_user" id="frm_user" action="" method="post">
	        			<input type="hidden" name="form_c" value="producto"> 
		                <input type="hidden" size="1" readonly="yes" name="idprod" id="idproducto1">

		                <h2 class="titulo">Agregar Producto</h2>
						<br />
						<input class="form-control" placeholder="Producto" type="text" name="producto" id="producto1" />
		        		<input class="form-control" placeholder="Precio" type="text" name="precio" id="precio1" />
		        		<input class="form-control" placeholder="Cantidad" type="text" name="cantidad" id="cantidad" />
		        		<select class="form-control" name="talla" id="talla">
		        		<?php
		        			$talla=$database->getTallas();
		        			if (sizeof($talla)>0) {
		        				for ($i=0; $i < sizeof($talla); $i++) 
		        				{ ?>
		        					<option name="talla" value="<?php echo $talla[$i]['idtalla']; ?>"><?php echo $talla[$i]['talla'];?></option>
		        			<?php }
		        			}
		        		?>

		        		</select>

						<br/>
	                	<input type="submit" id="enviar" value="Continuar" class="btn btn-primary"/>
					
						<fieldset id="loader">
							<span>Espere un momento</span>
							<img src="../images/loader.gif" style="margin-left: 10px;margin-top: 13px;width: 47px;">
						</fieldset>
					</form>
				</div>
			<!-- Fin Form emergente agregar producto -->

			<!-- DATOS CLIENTES -->
				<div class="col-md-6-offset">
					<h1 style="color: rgb(176, 136, 96);">Factura</h1>
				</div>
				
				<br/>
	        
	        <form name="facturar" id="facturar" action="../process.php" method="post" >
        		<input type="hidden" size="1" readonly="yes" name="action" id="action" value="facturar"/>
        		<input type="hidden" size="1" readonly="yes" name="idF" id="action" value="<?php echo $idF; ?>"/>
        		<input type="hidden" size="1" readonly="yes" name="tipo" id="action" value="<?php echo $tipo; ?>"/>
            	<div class="panel panel-default">
					<div class="panel-heading">Datos del cliente </div>
						<br/>
						<div class="col-xs-4">
							<input class="form-control" placeholder="Nombre" type="text" name="nombre" id="nombre" value=""/>
						</div>

				  		<div class="col-xs-4">
							<input class="form-control" placeholder="RIF" type="text" name="rif" id="rif" value=""/>
						</div>

						<div class="col-xs-4">
							<input class="form-control" placeholder="telefono" type="text" name="tlf" id="tlf" value=""/>
						</div>
						<br/>
						<br/>
						<div class="col-xs-4">
							<textarea class="form-control" placeholder="Direccion" name="direc" id="direc" rows="3" ></textarea>
						</div>
					<br/>
					<br/>
					<br/>
					<br/>
				</div>
			
			<!-- FIN DATOS DEL CLIENTE -->
			<br/>
			<br/>
			<!-- BOTON AGREGAR PRODUCTOS -->
			 	<div id="div-agregar">
					<input id="agregar" type="button" name="agregar" class="btn btn-default" value="Agregar producto" />
		 	  	</div>
			<!-- FIN BOTON AGREGAR PRODUCTOS -->
			<br/>
			<br/>
	 	  	<!-- Tabla productos -->
				<table id="table" class="table table-bordered table-hover">
			        <thead>
			            <tr>
			                <th width="auto" scope="col">id</th>
			                <th width="auto" scope="col">Cantidad</th>
			                <th width="auto" scope="col">Nombre</th>
			                <th width="auto" scope="col">Talla</th>
			                <th width="auto" scope="col">Precio</th>
			                <th width="auto" scope="col">Total</th>
			                <th width="auto" scope="col">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="listausuarios">
		                	<?php echo $contenido; ?>
		             </tbody>
					<!-- <tbody>
						<tr>
		        			<td><input class="form-control" placeholder="Id" type="text" name="idproducto" id="idproducto1"/></td>
		        			<td><input class="form-control" placeholder="Cantidad" type="text" name="cantidad" id="cantidad1"/></td>
		        			<td><input class="form-control" placeholder="Producto" type="text" name="producto" id="producto1" /></td>
		        			<td><input class="form-control" placeholder="Descripcion" type="text" name="descripcion" id="descripcion1" /></td>
		        			<td><input class="form-control" placeholder="Precio" type="text" name="precio" id="precio1" /></td>
		        			<td><input class="form-control" placeholder="Total" type="text" name="total" id="total1"/></td>
		        			<td><button type="button" class="btn remove_button">Remove</button></td>
					    </tr>
					</tbody> -->
				</table>
				<!-- FIN tabla productos -->

<!-- 				<button type="button" id="target" class="add" onClick="clickMe();">Add</button>
				<div id="output">1</div> -->
				<div class="col-xs-12 col-sm-6 col-lg-9">
				</div>
				<div class="col-xs-6 col-lg-3">
			    <button id="mensaje" type="submit" name="agregar" class="btn btn-primary" value="agregar">Guardar</button>
                <button id="mensaje" type="submit" name="cancel" class="btn btn-warning" value="cancel"/>Cancelar</button>
				</div>
			</form>
			</div>
		</div>
			<!-- jQuery -->

			<script type="text/javascript" charset="utf8" src="../js/jquery.formatCurrency-1.4.0.js"></script>
			<!--<script type="text/javascript" src="../js/jquery.js"></script>-->
			
			<script type="text/javascript" src="../js/jquery.min.js"></script>
			<script type="text/javascript" src="../js/jquery-ui.min.js"></script>

			<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>

			<script type="text/javascript" src="myjs.js"></script>
			<script type="text/javascript" src="../jquery-ui-1.10.3.custom/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>

			<!-- bootstrap -->
			<script type="text/javascript" charset="utf8" src="../js/bootstrap.min.js"></script>
			<!-- DataTables -->
			<script src="../js/dataTables.bootstrap.js"></script>


			<script>


			$(document).ready(function ($){
				$('#target').click(function() {
			    $('#output').html(function(i, val) { return val*1+1 });
				});

				// autcompletar
				    $("#nombre").autocomplete({
				        source: "buscarcli.php",
				        minLength: 1
				    });
				 
				    $("#nombre").focusout(function(){
				        $.ajax({
				            url:'cli.php',
				            type:'POST',
				            dataType:'json',
				            data:{nombre:$('#nombre').val()}
				        }).done(function(respuesta){
				            $("#rif").val(respuesta.rif);
				            $("#direc").val(respuesta.direc);
				            $("#tlf").val(respuesta.tlf);
					    });
					});
				    
					$("#producto1").autocomplete({
				        source: "buscarprod.php",
				        minLength: 1
				    });
				 
				    $("#producto1").focusout(function(){
				        $.ajax({
				            url:'product.php',
				            type:'POST',
				            dataType:'json',
				            data:{producto:$('#producto1').val()}
				        }).done(function(respuesta){
				            $("#idproducto1").val(respuesta.idproducto);
				            $("#precio1").val(respuesta.precio);
					    });
					});
				
				// autcompletar 

	});

			function applyFormatCurrency(sender) {
			    $(sender).formatCurrency({
			        roundToDecimalPlace: -1
			    });
			}
			
	     </script>

	</body>

	</html>

