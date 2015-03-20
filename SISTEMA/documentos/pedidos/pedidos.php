<?
  session_start();  
?>
<?php include_once("../../include/session.php"); ?>

<!doctype html>
<html>

	<head>
		<title>Pedidos</title>
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
	 	  $pedido=$database->getLastPedidoTemp();

	 	  $ped =$pedido[0]['idpedtemp']+'1';
	 	  
 	  	?>
 	  		<br/>
			<br/>
		<form action="../../process.php" method="post" class="form-signin"> 
	        <input type="hidden" size="1" readonly="yes" name="action" value="insertPedtemp"/>
	        <input type="hidden" size="1" readonly="yes" name="idpt" value="<?php echo $ped; ?>"/>
			<div class="col-md-2">
		 	  <button type="submit" class="btnEd btn-info btn-md" style="margin-top: 10px;margin-bottom: 10px;"/>
		 	  <img src="../../images/cot.png">  Subir pedido </a>
	 	  	</div>
 	  </form>

  	  <div class="col-md-7">
 	  	<h2 style="color: rgb(0, 15, 128);" class="text-center">Documentos - Pedidos</h2>
 	  </div>

		<br/><br/><br/><br/><br/>
 	  <div class="col-md-12">
		<table width="100%" class="table table-bordered table-hover " id="table_id">
	        <thead >
	            <tr style="background: rgba(91, 192, 222, 0.71);">
	                <th width="auto" class="text-center"><?php echo utf8_decode('Nº') ?></th>
	                <th width="auto" class="text-center">Cliente</th>
	                <th width="auto" class="text-center">Estado</th>
	                <th width="auto" class="text-center">Fecha</th>
	                <th width="auto" class="text-center">Total</th>
	                <th width="auto" class="text-center">Opciones</th>
	            </tr>
	        </thead>
			<tbody>
			<?php 
			$arrayPed = $database->getPedido();


			if(sizeof($arrayPed)>0)
			{
				for($j=0; $j<sizeof($arrayPed); $j++)
	        	{
	        			$an = $database -> getPedidoAnul($arrayPed[$j]['idpedido']);
	        			$stat = $database -> getStatusbyId($arrayPed[$j]['idstatus']);
	        			
	        			if ($stat[0]['idstatus'] == '3') {
	        				$pay="<tr class='warning ' >";
	        				$estado='btn btn-warning';
	        				$dis = '';
	        				$textSt= $stat[0]['status'];
	        			}elseif($stat[0]['idstatus'] == '4')
	        			{
	        				$pay="<tr class='info' >";
	        				$estado='btn btn-primary';
	        				$dis = '';
	        				$textSt= $stat[0]['status'];

	        			}
	        			if ($an[0]['anulada'] == 'si') {
	        				$pay="<tr class='danger' >";
	        				$estado='btn btn-default';
	        				$dis = 'disabled = disabled';
	        				$textSt= 'sin estado';

	        			}
	        			$arrayCli = $database->getClientesbyId($arrayPed[$j]['idcliente']);
	        			echo '<tr>';
	        					echo '<td class="text-center">'.$arrayPed[$j]['idpedido'].'</td>';
			        			echo '<td><span class="label label-success">'.$arrayCli[0]['nombre'].'</span></td>';
			        			echo '<td class="text-center"><strong><a class="'.$estado.'" '.$dis.' href="updstat.php?id='.$arrayPed[$j]['idpedido'].'&stat='.$arrayPed[$j]['idstatus'].'">'.$textSt.'</a></strong></td>';
			        			echo '<td>'.$arrayPed[$j]['fecha'].'</td>';
			        			echo '<td>'.$arrayPed[$j]['total'].'</td>';
			        			echo '<td class="text-center"><a href="editP.php?idpe='.$arrayPed[$j]['idpedido'].'" class="a"><img src="../../images/edit.png"/></a>';
		        				if (($an[0]['anulada']) == 'si') {
			        				echo '<a href="deleteP.php?id='.$arrayPed[$j]['idpedido'].'" onclick="return confirmation()">
			        				<img src="../../images/anulada.png"/></a></td>';
			        			}else{
			        				echo '<a href="deleteP.php?id='.$arrayPed[$j]['idpedido'].'" onclick="return confirmation()">
			        				<img src="../../images/anular.png"/></a></td>';
			        			}
			    }
	        			'</tr>';
        	}
			 ?>
        </tbody>
        </table>
        </div>
        		<br/>
		<br/>


			<script type="text/javascript">
			<!--
			function confirmation() {
			    if(confirm("Realmente desea anular?"))
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
		$("#del").freeow("Aviso","Pedido anulado!",{
		classes: ["gray", "del"]
			});
		});
		$(document).ready(function() {
		$("#del1").freeow("Aviso","Pedido no pudo ser anulado!",{
		classes: ["gray", "error"]
			});
		});
		$(document).ready(function() {
		$("#act").freeow("Aviso","Status de pedido cambiado!",{
		classes: ["gray", "ok"]
			});
		});
		$(document).ready(function() {
		$("#act2").freeow("Aviso","Status de pedido no pudo ser cambiado!",{
		classes: ["gray", "error"]
			});
		});
		</script>

</body>

</html>