<?
  session_start();  
?>
<?php include_once("../../include/session.php"); ?>

<!doctype html>
<html>

	<head>
		<title>Cotizacion</title>
		<link rel="stylesheet" type="text/css" href="../../css/main.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="../../css/bootstrap.min.css">
<!-- 		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
 -->	<link rel="stylesheet" type="text/css" href="../../css/datatables.css">

 <link rel="stylesheet" type="text/css" href="../../pjdietz-Freeow-c84f9e9/style/freeow/freeow.css" />
<link rel="stylesheet" type="text/css" href="../../pjdietz-Freeow-c84f9e9/demo/demo.css" />

	</head>
<body>


 	<?php include("header.php"); 

	if(isset($_GET["a"])==1)
	{

		echo '<div id="add" class="freeow freeow-top-right"></div>';

 	}

	if(isset($_GET["m"])==1) {
		echo '<div id="edit" class="freeow freeow-top-right"></div>';
	}

	if (isset($_GET["e"])==1) {
		echo '<div id="del" class="freeow freeow-top-right"></div>';
	}

	if (isset($_GET["f"])==2) {
		echo '<div id="del1" class="freeow freeow-top-right"></div>';
	}

	if (isset($_GET["x"])==1) {
		echo '<div id="exist" class="freeow freeow-top-right"></div>';
	}

	if (isset($_GET["ac"])==1) {
		echo '<div id="act" class="freeow freeow-top-right"></div>';
	}

	if (isset($_GET["ac1"])==2) {
		echo '<div id="act2" class="freeow freeow-top-right"></div>';
	}
    ?>



	<div class="container">
		<div class="row">
 	   	<?php
	 	  $cotizacion=$database->getLastCotizacionTemp();

	 	  // if (sizeof($cotizacion)<1) {
	 	  // 	$cotizacion[0]['idfactemp'] = '0';
	 	  // }
	 	  $cot =$cotizacion[0]['idcotemp']+'1';
 	  	?>

		<form action="../../process.php" method="post" class="form-signin"> 
	        <input type="hidden" size="1" readonly="yes" name="action" value="insertCotemp"/>
	        <input type="hidden" size="1" readonly="yes" name="idct" value="<?php echo $cot; ?>"/>
	 	  		<br/>
				<br/>
		<div class="col-md-4">
	 	  <button type="submit" class="btnEd btn-success btn-md" style="margin-top: 10px;margin-bottom: 10px;"/>
	 	  <img src="../../images/cot.png">Nueva cotizacion</button>
 	  	</div>
 	  </form>

  	  <div class="col-md-5">
 	  	<h2 style="color: rgb(0, 15, 128);">Documentos - Cotizaciones</h2>
 	  </div>
		<br/><br/>
		<br/><br/>
		<br/>
		<table width="100%" class="table table-bordered table-hover" id="table_id">
	        <thead>
	            <tr style="background: rgba(85, 255, 40, 0.36);">
	                <th width="auto" class="text-center"><?php echo utf8_decode('Nº') ?></th>
	                <th width="auto" class="text-center">Cliente</th>
	                <th width="auto" class="text-center">Fecha</th>
	                <th width="auto" class="text-center">Total</th>
	                <th width="auto" class="text-center">Opciones</th>
	            </tr>
	        </thead>
			<tbody>
			<?php 
			$arrayCot = $database->getCotizacion();
        	
			if(sizeof($arrayCot)>0)
			{
				for($j=0; $j<sizeof($arrayCot); $j++)
	        	{
	        			$arrayCli = $database->getClientesbyId($arrayCot[$j]['idcliente']);
	        			echo '<tr>';
	        					echo '<td class="text-center">'.$arrayCot[$j]['idcot'].'</td>';
			        			echo '<td><span class="label label-success">'.$arrayCli[0]['nombre'].'</span></td>';
			        			echo '<td>'.$arrayCot[$j]['fecha'].'</td>';
			        			echo '<td>'.$arrayCot[$j]['total'].'</td>';
			        			echo '<td class="text-center"><a href="editC.php?idc='.$arrayCot[$j]['idcot'].'" class="a"><img src="../../images/edit.png"/></a>';
		        				echo '<a href="deleteC.php?id='.$arrayCot[$j]['idcot'].'&n=1" onclick="return confirmation()" class="b">
		        				<img src="../../images/pdel.png"/></a></td>';
			    }
	        			    '</tr>';
        	}
			 ?>
        </tbody>
        </table>

			<script type="text/javascript">
			<!--
			function confirmation() {
			    if(confirm("Realmente desea eliminar?"))
			    {
			        return true;
			    }
			    return false;
			}

			</script>
			

		</div>
		</div>

		<!-- jQuery -->
		<script type="text/javascript" charset="utf8" src="../../js/jquery.js"></script>
		<!-- bootstrap -->
		<script type="text/javascript" charset="utf8" src="../../js/bootstrap.min.js"></script>
		<!-- DataTables -->
		<script type="text/javascript" charset="utf8" src="../../js/jquery.dataTables.min.js"></script>
		<script src="../../js/dataTables.bootstrap.js"></script>
		<script type="text/javascript" src="../../pjdietz-Freeow-c84f9e9/jquery.freeow.js"></script>
		<script type="text/javascript" src="../../pjdietz-Freeow-c84f9e9/demo/demo.js"></script>
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

		// Simple
				
		$(document).ready(function() {
		$("#add").freeow("Aviso","Cliente agregado con exito",{
		classes: ["gray", "ok"]
			});
		});	
		$(document).ready(function() {
		$("#edit").freeow("Aviso","Cliente modificado satisfactoriamente",{
		classes: ["gray", "ok"]
			});
		});
		
		$(document).ready(function() {
		$("#del").freeow("Aviso","Factura eliminada correctamente!",{
		classes: ["gray", "del"]
			});
		});
		$(document).ready(function() {
		$("#del1").freeow("Aviso","Factura no pudo ser eliminada!",{
		classes: ["gray", "error"]
			});
		});
		</script>

</body>

</html>