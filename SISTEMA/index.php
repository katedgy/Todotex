<?
  session_start();  
?>
<?php include_once("include/session.php"); ?>

<!doctype html5>
<html>

	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- 		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
 -->		<link rel="stylesheet" type="text/css" href="css/datatables.css">

 		<!-- metro -->
        <link rel="stylesheet" href="css/metro-bootstrap.css">

	</head>

<body>

 	<?php include("header.php"); 

	$arrayCliente = $database->getClientes();
	if(isset($_GET["a"])==1)
	{
	echo '<span class="text-error">&nbsp;Cliente agregado satisfactoriamente!&nbsp;&nbsp;&nbsp;</span>';
	}

	if(isset($_GET["m"])==1) {
	echo '<span class="text-error">&nbsp;Cliente modificado satisfactoriamente!&nbsp;&nbsp;&nbsp;</span>';
	}

	if (isset($_GET["e"])==1) {
	echo '<span class="text-error">&nbsp;Cliente eliminado correctamente!&nbsp;&nbsp;&nbsp;</span>';
	}

	if (isset($_GET["f"])==2) {
	echo '<span class="text-error">&nbsp;Cliente no pudo ser eliminado. intentelo de nuevo.!&nbsp;&nbsp;&nbsp;</span>';
	}

							$q= "SELECT * FROM productos WHERE stock='0' ";
							$result = mysql_query($q);
							$invNull = mysql_num_rows($result);

							$q= "SELECT * FROM pedido WHERE idstatus='3' ";
							$r = mysql_query($q);
							$pedi = mysql_num_rows($r);

							$q= "SELECT * FROM factura WHERE idstatus='2' ";
							$l = mysql_query($q);
							$fac = mysql_num_rows($l);
	
    ?>

	<div class="container">
	</br></br>
		<div class="jumbotron">			
			<div class="col-sm-5 col-sm-offset-2 col-md-offset-0"><img  src="images/in.png"></div>
			<h1>Bienvenido/a <?php print_r($_SESSION['usename']);?></h1>

			<p>Sistema administrativo. Controle sus operaciones de manera rapida y eficiente.</p>		   <br>
			   <br>	 <br>			
		<div  class="col-sm-3 alert alert-info" style="width: auto;background: rgba(32, 185, 221, 0.46);border-color: rgba(151, 222, 238, 0.22);margin-right: 7px;margin-left: 380px;">
		  <a href="documentos/pedidos/pedidos.php" style="color: rgb(147, 147, 147);font-weight: 700;"><span class="badge"><?php echo $pedi; ?></span> Pedidos pendientes</a>
		</div> 
		<div  class="col-sm-3 alert alert-info" style="width: auto;background: rgba(32, 185, 221, 0.46);border-color: rgba(151, 222, 238, 0.22);margin-right: 7px;">
		  <a href="documentos/factura.php" style="color: rgb(147, 147, 147);font-weight: 700;"><span class="badge"><?php echo $fac; ?></span> Facturas pendientes</a>
		</div>
		<div  class="col-sm-3 alert alert-info" style="width: auto;background: rgba(32, 185, 221, 0.46);border-color: rgba(151, 222, 238, 0.22);<!-- margin-right: 7px; -->">
		  <a href="registros/prod.php" style="color: rgb(147, 147, 147);font-weight: 700;"><span class="badge"><?php echo $invNull; ?></span> Productos sin stock</a>
		</div>
			   <br>
			   <br>

		</div>


		<div class="row">
		  <div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		      <img data-src="holder.js/300x300" src="images/user.png">
		      <div class="caption">
		        <h3>Clientes</h3>
		        <p>Agregue, modifique o elimine registros de los clientes de su empresa</p>
		        <p><a href="registros/cliente.php" class="btn btn-primary" role="button">Ir</a></p></br>
		      </div>
		    </div>
		  </div>


		<div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		      <img data-src="holder.js/300x300" src="images/prov1.png">
		      <div class="caption">
		        <h3>Proveedores</h3>
		        <p>Agregue, modifique o elimine registros de los proveedores de su empresa y vealos segun el producto que ofrecen</p>
		        <p><a href="registros/prov.php" class="btn btn-primary" role="button">Ir</a></p>
		      </div>
		    </div>
		  </div>
		
		<div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		      <img data-src="holder.js/300x300" src="images/product1.png">
		      <div class="caption">
		        <h3>Productos y servicios</h3>
		        <p>Modifique los productos y precios existentes o agregue lo mas nuevo de la empresa.</p>
		        <p><a href="registros/prod.php" class="btn btn-primary" role="button">Ir</a></p></br>
		      </div>
		    </div>
		  </div>
		
	</div>



		<!-- jQuery -->
		<script type="text/javascript" charset="utf8" src="js/jquery.js"></script>
		<!-- bootstrap -->
		<script type="text/javascript" charset="utf8" src="js/bootstrap.min.js"></script>

		<!-- DataTables -->
		<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.js"></script>		

</body>

</html>