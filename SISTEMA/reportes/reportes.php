<?
  session_start();  
?>
<?php include_once("../include/session.php"); ?>

<!doctype html>
<html>

	<head>
		<title>Reportes</title>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
<!-- 		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
 -->	<link rel="stylesheet" type="text/css" href="../css/datatables.css">
		<link href="../css/datepicker.css" type="text/css" rel="stylesheet"/>
		<link href="../../css/jquery-ui.css" type="text/css" rel="stylesheet"/>

		<link rel="stylesheet" type="text/css" href="../pjdietz-Freeow-c84f9e9/style/freeow/freeow.css" />
		<link rel="stylesheet" type="text/css" href="../pjdietz-Freeow-c84f9e9/demo/demo.css" />

	</head>
<body>


 	<?php include("header.php");?>

	<div class="container">
		<div class="row">
 	   	<?php
	 	  $pedido=$database->getLastPedidoTemp();

	 	  $ped =$pedido[0]['idpedtemp']+'1';

 	  	?>
  	  <div class="col-md-12">
 	  	<h1 style="color:rgb(61, 104, 140);" class="text-center">Reportes</h1>
 	  </div>

	  		<br/>
		<?php
			$getinv = $database ->getProductos();
		?>


		<br/><br/><br/>
		<div class="row">
		  <div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		      <img data-src="../holder.js/300x300" src="../images/invent.png">
		      <div class="caption">
		      		<br><br>
		        <h3>Productos</h3>
		        <p>Reporte de los productos y su stock</p>
		        <br><br>
		        <p><button onclick="fnc1()" class="btn btn-warning btn-lg btn-block" role="button">Generar</button></p></br>
		      </div>
		    </div>
		    	<script type="text/javascript">
					function fnc1()
					{
						window.open('printAllProd.php?r=1');
					}
				</script>
		  </div>
		
		<form name="fecha">
		<div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		      <img data-src="../holder.js/300x300" src="../images/fact.png">
		      <div class="caption">
		        <h3>Facturas pendientes</h3>
		        <p>Reporte de las facturas por cobrar</p>
		    <div class="col-md-6">
			<div class="input-append date">
				<h4>Desde</h4>
				<input class="form-control" data-provide="datepicker" id="date1" name="fecha1" placeholder="Desde" value="<?php echo $form->value("fecha"); ?>"></input>
			</div>
			<?php
				$errfecha = $form->error("fecha");
				if($errfecha!="")
				{
				echo '<span class="text-error-field">&nbsp;'.$errfecha.'&nbsp;&nbsp;&nbsp;</span>';
				}
			?>
		</div>
		<div class="col-md-6">
			<div class="input-append date">
				<h4>Hasta</h4>
				<input class="form-control" data-provide="datepicker" id="date2" name="fecha2" placeholder="Hasta" value="<?php echo $form->value("fecha"); ?>"></input>
			</div>
			<?php
				$errfecha = $form->error("fecha");
				if($errfecha!="")
				{
				echo '<span class="text-error-field">&nbsp;'.$errfecha.'&nbsp;&nbsp;&nbsp;</span>';
				}
			?>
		</div>
		<br><br>
		<br><br>
		        <p><button onclick="fnc2()" class="btn btn-warning btn-lg btn-block" role="button">Generar</button></p></br>
		      </div>
		    </div>
		    	<script type="text/javascript">
					function fnc2()
					{
						var f1 = document.fecha.fecha1.value;
						var f2 = document.fecha.fecha2.value;
						if (f1 == '' || f2 == '') {
							alert('Debe ingresar los limites de fecha');
						}else{
						window.open('printAllProd.php?r=2&f1='+f1+'&f2='+f2);
						};
					}
				</script>
		  </div>
		  </form>
		<form name="pedidoFecha">
			<div class="col-sm-6 col-md-4">
			    <div class="thumbnail">
			      <img data-src="../holder.js/300x300" src="../images/pend.png">
			      <div class="caption">
			        <h3>Pedidos</h3>
			        <p>Reporte de los pedidos pendientes</p>
					<div class="col-md-6">
						<div class="input-append date">
							<h4>Desde</h4>
							<input class="form-control" data-provide="datepicker" id="date3" name="fecha1" placeholder="Desde" value="<?php echo $form->value("fecha"); ?>"></input>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-append date">
							<h4>Hasta</h4>
							<input class="form-control" data-provide="datepicker" id="date4" name="fecha2" placeholder="Hasta" value="<?php echo $form->value("fecha"); ?>"></input>
						</div>
					</div>
					<br><br>
					<br><br>
			        <p><button onclick="fnc3()" class="btn btn-warning btn-lg btn-block" role="button">Generar</button></p></br>
			      </div>
			    </div>
		    	<script type="text/javascript">
					function fnc3()
					{
						var f1 = document.pedidoFecha.fecha1.value;
						var f2 = document.pedidoFecha.fecha2.value;
						if (f1 == '' || f2 == '') {
							alert('Debe ingresar los limites de fecha');
						}else{
							window.open('printAllProd.php?r=3&f1='+f1+'&f2='+f2);
						};
					}
				</script>
			</div>
		</form>
	
	</div>

        <br/>
		<br/>
			
		</div>
		</div>
		<!-- jQuery -->
		<script type="text/javascript" charset="utf8" src="../js/jquery.js"></script>
		<!-- bootstrap -->
		<script type="text/javascript" charset="utf8" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" charset="utf8" src="../js/bootstrap-datepicker.js"></script>
		<script src="../js/bootstrap-datepicker.es.js" charset="UTF-8"></script>

		<!-- DataTables -->
		<script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.min.js"></script>
		<script src="../js/dataTables.bootstrap.js"></script>
		<script type="text/javascript" src="../pjdietz-Freeow-c84f9e9/jquery.freeow.js"></script>
		<script type="text/javascript" src="../pjdietz-Freeow-c84f9e9/demo/demo.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
	    $('#table_id').dataTable({
	        "language": {
	            "lengthMenu": "Mostrando _MENU_ registros por pagina",
	            "zeroRecords": "No se encontraron resultados",
	            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	            "infoEmpty": "Ningun registro encontrado",
	            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
	            "oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"sProcessing":     "Procesando...",
				"infoPostFix":    "",
				"search":         "Buscar:",
				"infoThousands":  ",",
				"loadingRecords": "Cargando..."
			}
		    });
		});

		$(document).ready( function () {
		    $('#table_id').DataTable();
		} );
				$(document).ready(function(){
					$('#date1').datepicker({
	                    format: "yyyy/mm/dd",
	                    languaje:"es"
	                }); 
	                $('#date2').datepicker({
	                    format: "yyyy/mm/dd",
	                    languaje:"es"
	                }); 
	                $('#date3').datepicker({
	                    format: "yyyy/mm/dd",
	                    languaje:"es"
	                }); 
	                $('#date4').datepicker({
	                    format: "yyyy/mm/dd",
	                    languaje:"es"
	                }); 
				});
		// Simple
		</script>

</body>

</html>