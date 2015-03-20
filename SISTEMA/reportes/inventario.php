<?
  session_start();  
?>
<?php include_once("../include/session.php"); 
include_once("../dompdf/dompdf/dompdf_config.inc.php"); 
?>

<!doctype html>
<html>

	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
<!-- 		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
 -->	<link rel="stylesheet" type="text/css" href="../css/datatables.css">

 <link rel="stylesheet" type="text/css" href="../pjdietz-Freeow-c84f9e9/style/freeow/freeow.css" />
<link rel="stylesheet" type="text/css" href="../pjdietz-Freeow-c84f9e9/demo/demo.css" />

	</head>
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
    ?>


	<div class="container">
		<div class="row">
 	  
 	  <div class="">
 	  <a type="button" class="btn btn-default"  href="add.php?n=1" style="margin-top: 10px;margin-bottom: 10px;"><img src="../images/add1.png"> Agregar cliente</a>
 	  </div>

		<table width="100%" class="table table-bordered table-hover" id="table_id">
	        <thead>
	            <tr>
	                <th width="auto">#</th>
	                <th width="auto">Empresa</th>
	                <th width="auto">RIF</th>
	                <th width="auto">Direcci&oacute;n</th>
	                <th width="auto">Tel&eacute;fono</th>
	                <th width="auto">Opciones</th>
	            </tr>
	        </thead>
			<tbody>
			<?php         	
			if(sizeof($arrayCliente)>0)
			{
				for($j=0; $j<sizeof($arrayCliente); $j++)
	        		{
	        			echo '
	        				<tr>
	        					<td>'.$arrayCliente[$j]['idcliente'].'</td>';
			        			echo '<td>'.$arrayCliente[$j]['nombre'].'</td>';
			        			echo '<td>'.$arrayCliente[$j]['rif'].'</td>';
			        			echo '<td>'.$arrayCliente[$j]['direc'].'</td>';
			        			echo '<td>'.$arrayCliente[$j]['tlf'].'</td>';
			        			echo '<td><a href="edit.php?id='.$arrayCliente[$j]['idcliente'].'&n=1">Modificar </a>
			        			<a href="delete.php?id='.$arrayCliente[$j]['idcliente'].'&n=1" onclick="return confirmation()">Eliminar</a></td>
	        			    </tr>';
        		}
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
		<script type="text/javascript" charset="utf8" src="../js/jquery.js"></script>
		<!-- bootstrap -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
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
		$("#del").freeow("Aviso","Cliente eliminado correctamente!",{
		classes: ["gray", "del"]
			});
		});
		$(document).ready(function() {
		$("#del1").freeow("Aviso","Cliente no pudo ser eliminado!",{
		classes: ["gray", "error"]
			});
		});


		</script>

</body>

</html>