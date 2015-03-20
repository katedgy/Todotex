<?
  session_start();  
?>
<?php include_once("../include/session.php"); ?>

<!doctype html>
<html>

	<head>
		<title>Cuentas</title>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
<!-- 	<link rel="stylesheet" href="css/bootstrap-theme.min.css">-->
		<link rel="stylesheet" type="text/css" href="../css/datatables.css">
		<link rel="stylesheet" type="text/css" href="../pjdietz-Freeow-c84f9e9/style/freeow/freeow.css" />
		<link rel="stylesheet" type="text/css" href="../pjdietz-Freeow-c84f9e9/demo/demo.css" />

	</head>
<body>

 	<?php include("header.php"); 
	$arrayUser = $database->getAllUser();
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
    ?>
	<div class="container">
		<div class="row">
		<br/>
		<br/>
		<div class="col-md-4">
 			<a type="button" class="btn btn-default"  href="add.php?n=4" style="margin-top: 10px;margin-bottom: 10px;">
 			<img src="../images/usera.png"> Agregar nuevo usuario</a>
	 	</div><br/>
	  	<div class="col-md-4">
	 	  	<h2 style="color: rgb(0, 15, 128);">Archivo - Usuarios</h2>
	 	</div>

		<table width="100%" class="table table-bordered table-hover" id="table_id">
	        <thead>
	            <tr style="background: rgba(61, 215, 156, 0.33);">
	                <th width="auto">#</th>
	                <th width="auto">Usuario</th>
	                <th width="auto">Clave</th>
	                <th width="auto">Nivel</th>
	                <th width="auto">Opciones</th>
	            </tr>
	        </thead>
			<tbody>
				<?php         	
				if(sizeof($arrayUser)>0)
				{
					for($j=0; $j<sizeof($arrayUser); $j++)
		        		{
		        			echo '
		        				<tr>
		        					<td>'.$arrayUser[$j]['iduser'].'</td>';
				        			echo '<td>'.$arrayUser[$j]['nombre'].'</td>';
				        			echo '<td>'.$arrayUser[$j]['clave'].'</td>';
				        			if ($arrayUser[$j]['nivel'] == '1') {
				        			echo '<td><span class="label label-success">'.$arrayUser[$j]['nivel'].'</span></td>';
				        			}else{
				        			echo '<td><span class="label label-info">'.$arrayUser[$j]['nivel'].'</span></td>';

				        			}
				        			echo '<td><a href="edit.php?id='.$arrayUser[$j]['iduser'].'&n=4"><img src="../images/edit.png"/></a>
				        			<a href="delete.php?id='.$arrayUser[$j]['iduser'].'&n=4" onclick="return confirmation()"><img src="../images/deleteu.png"/></a></td>
		        			    </tr>';
	        		}
				}
				?>
        	</tbody>
        </table>
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


			function confirmation() {
			    if(confirm("Realmente desea eliminar?"))
			    {
			        return true;
			    }
			    return false;
			}

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
			$("#add").freeow("Aviso","Registro agregado con exito",{
			classes: ["gray", "ok"]
				});
			});	
			$(document).ready(function() {
			$("#edit").freeow("Aviso","Registro modificado satisfactoriamente",{
			classes: ["gray", "ok"]
				});
			});
			
			$(document).ready(function() {
			$("#del").freeow("Aviso","Registro eliminado correctamente!",{
			classes: ["gray", "del"]
				});
			});
			$(document).ready(function() {
			$("#del1").freeow("Aviso","Registro no pudo ser eliminado!",{
			classes: ["gray", "error"]
				});
			});

			$(document).ready(function() {
			$("#exist").freeow("Aviso","El nombre o rif ya existe!",{
			classes: ["gray", "error"]
				});
			});
		</script>
</body>
</html>