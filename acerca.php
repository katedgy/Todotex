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

	//print_r($_SESSION['username']);

    ?>
		<br>
		<br><br>
		<br>
	<div class="container">
	</br></br>
		<div class="jumbotron">			
			<div class="col-sm-5 col-sm-offset-2 col-md-offset-0"><img  src="images/ab2.png"></div>
			<h1>Acerca de </h1>
			<p>Sistema para gestionar de manera r&aacute;pida y eficiente las operaciones administrativas de la empresa.</p>			
		<br>
		<br><br>
		<br>
			<div class="col-sm-3 text-center">
				<address>
				  <h4><strong>Creado por:</strong></h4>
				  <h4>Edgylin Rodr&iacute;guez</h4>
				  <kbd>Desarrollador.</kbd><br><br><br>
				</address>
			</div>
			<div class="col-sm-7 col-md-offset-1 text-center">
			<address>
			  <h4><strong>Soporte y dudas:</strong> <a href="#">E-mail: katedgy_148@hotmail.com</a></h5>
			</address>
			</div>
					<br><br>
		<br>
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