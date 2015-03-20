<?
  session_start();  
?>
<?php include_once("../include/session.php"); ?>

<!doctype html>
<html>

	<head>
		<title>Factura</title>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
<!-- 		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
 -->	<link rel="stylesheet" type="text/css" href="../css/datatables.css">

		<link href="../css/jquery-ui.css" type="text/css" rel="stylesheet"/>
		<link href="../css/datepicker.css" type="text/css" rel="stylesheet"/>

		<link rel="stylesheet" type="text/css" href="../pjdietz-Freeow-c84f9e9/style/freeow/freeow.css" />
		<link rel="stylesheet" type="text/css" href="../pjdietz-Freeow-c84f9e9/demo/demo.css" />

	</head>
	<style>
		.datepicker {z-index: 1151 !important;}</style>
	<body>


 	<?php include("header.php"); 
	$arrayCliente = $database->getClientes();
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
 	  	<?php include('facturar/changeSt.php'); ?>

 	  <div class="">
 	  <?php
 	  $factura=$database->getLastFacturaTemp();

 	  // if (sizeof($factura)<1) {
 	  // 	$factura[0]['idfactemp'] = '0';
 	  // }

 	  $fac =$factura[0]['idfactemp']+'1';
 	  ?>

 	  <form action="../process.php" method="post" class="form-signin"> 
        <input type="hidden" size="1" readonly="yes" name="action" value="insertFTEST"/>
        <input type="hidden" size="1" readonly="yes" name="n" value="1"/>
        <input type="hidden" size="1" readonly="yes" name="idf" value="<?php echo $fac; ?>"/>
 	  		<br/>
			<br/>
 	  	<div class="col-md-4">
	 	  <button type="submit" class="btnEd btn-default btn-md" style="margin-top: 10px;margin-bottom: 10px;"/>
	 	  <img src="../images/addf.png">Nueva factura</button>
 	  	</div>
 	  </form>
  	  <div class="col-md-4">
 	  	<h2 style="color: rgb(0, 15, 128);">Documentos - Factura</h2>
 	  </div>

 	  </div>
 	  		<br/>
			<br/>
			<br/>
			<br/>
			<br/>
		<table width="100%" class="table table-bordered table-hover" id="table_id">
	        <thead>
	            <tr style="background: rgba(110, 110, 110, 0.12);">
	                <th width="auto" class="text-center"><?php echo utf8_decode('Nº') ?></th>
	                <th width="auto" class="text-center">Cliente</th>
	                <th width="auto" class="text-center">Fecha</th>
	                <th width="auto" class="text-center">Status</th>
	                <th width="auto" class="text-center">Total</th>
	                <th width="auto" class="text-center">Opciones</th>
	            </tr>
	        </thead>
			<tbody>
			<?php 

			$arrayFactura = $database->getFactura();
        	
			if(sizeof($arrayFactura)>0)
			{
				for($j=0; $j<sizeof($arrayFactura); $j++)
	        		{

	        			$arrayCli = $database->getClientesbyId($arrayFactura[$j]['idcliente']);
			        	$arrayStat = $database ->getStatusbyId($arrayFactura[$j]['idstatus']);
			        	$an = $database -> getFacturaAnul($arrayFactura[$j]['idfactura']);

	        			if ($arrayStat[0]['idstatus'] == '2') {
	        				$pay="<tr class='warning' >";
	        				$estado='btn btn-warning';
	        				$dis = '';
	        			}elseif($arrayStat[0]['idstatus'] == '1')
	        			{
	        				$pay="<tr class='info' >";
	        				$estado='btn btn-primary';
	        				$dis = '';
	        			}if ($an[0]['anulada'] == 'si') {
	        				$pay="<tr class='danger' >";
	        				$estado='btn btn-default';
	        				$dis = 'disabled = disabled';
	        			}

	        			echo $pay;

	        					echo '<td class="text-center">'.$arrayFactura[$j]['idfactura'].'</td>';

			        			echo '<td><span class="label label-success">'.$arrayCli[0]['nombre'].'</span></td>';

			        			echo '<td>'.$arrayFactura[$j]['fecha'].'</td>';
								// echo '<td class="text-center"><button data-id="'.$arrayFactura[$j]['idfactura'].'" type="button" class="dt '.$estado.'" '.$dis.' data-toggle="modal" data-target="#myModal">
								//   '.$arrayStat[0]['status'].'
								// </button></td>';
			        			 echo '<td class="text-center"><strong><a class="'.$estado.'" '.$dis.' href="udtStat.php?id='.$arrayFactura[$j]['idfactura'].'&stat='.$arrayFactura[$j]['idstatus'].'">'.$arrayStat[0]['status'].'</a></strong></td>';
			        			
			        			echo '<td class="text-center">'.$arrayFactura[$j]['total'].'</td>';
			        			echo '<td class="text-center"><a href="facturar/editF.php?idf='.$arrayFactura[$j]['idfactura'].'&n=1" class="a"><img src="../images/edit.png"/></a>';
			        			if (($an[0]['anulada']) == 'si') {
			        				echo '<a href="facturar/deleteF.php?id='.$arrayFactura[$j]['idfactura'].'&n=1" onclick="return confirmation()" class="b">
			        				<img src="../images/anulada.png"/></a></td>';
			        			}else{
			        				echo '<a href="facturar/deleteF.php?id='.$arrayFactura[$j]['idfactura'].'&n=1" onclick="return confirmation()" class="b">
			        				<img src="../images/anular.png"/></a></td>';
			        			}
			        			

	        			    '</tr>';
        		}
			}
			 ?>
        </tbody>
        </table>

			<script type="text/javascript">
			<!--
			function confirmation() {
			    if(confirm("Realmente desea anular la factura?"))
			    {
			        return true;
			    }
			    return false;
			}

			</script>
			

		</div>
		</div>

		<!-- jQuery -->
		<script type="text/javascript" charset="utf8" src="../js/jquery.js"></script>
		<!-- bootstrap -->
		<script type="text/javascript" charset="utf8" src="../js/bootstrap.min.js"></script>
		<!-- DataTables -->
		<script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.min.js"></script>
		<script src="../js/dataTables.bootstrap.js"></script>
		<script type="text/javascript" charset="utf8" src="../js/bootstrap-datepicker.js"></script>
		<script src="../js/bootstrap-datepicker.es.js" charset="UTF-8"></script>

		<script type="text/javascript" src="../pjdietz-Freeow-c84f9e9/jquery.freeow.js"></script>
		<script type="text/javascript" src="../pjdietz-Freeow-c84f9e9/demo/demo.js"></script>
		<script type="text/javascript">
// $('#aa a').click(function (e) {
//   e.preventDefault();
// 		$('#myModal').modal('show');
// })
$('#myModal').modal({
  keyboard: true,
  show: false
})
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

		$(document).on("click", ".modal", function () {
			var myDNI = document.$(this).value;
			alert(myDNI);
			$(".dt #DNI").val( myDNI );
		});


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
		$("#del").freeow("Aviso","Factura anulada correctamente!",{
		classes: ["gray", "del"]
			});
		});
		$(document).ready(function() {
		$("#del1").freeow("Aviso","Factura no pudo ser anulada!",{
		classes: ["gray", "error"]
			});
		});
		$(document).ready(function() {
		$("#act").freeow("Aviso","Status de factura cambiado!",{
		classes: ["gray", "ok"]
			});
		});
		$(document).ready(function() {
		$("#act2").freeow("Aviso","Status de factura no pudo ser cambiado!",{
		classes: ["gray", "error"]
			});
		});

		</script>

</body>

</html>