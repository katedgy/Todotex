<?
  session_start();  
?>
<?php include_once("../include/session.php"); ?>

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
	$arrayProd = $database->getProductos();
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
		<br/>
		<br/>
		<div class="col-md-4">
 	  		<a type="button" class="btn btn-default"  href="add.php?n=3" style="margin-top: 10px;">
 	  		<img src="../images/add3.png"> Agregar Producto</a>
	 	</div>
	  	<div class="col-md-4">
	 	  	<h2 style="color: rgb(0, 15, 128);">Archivo - Inventario</h2>
	 	</div>

		<table width="100%" class="table table-bordered table-hover" id="table_id">
	        <thead>
	            <tr style="background: rgba(255, 119, 0, 0.44);">
	                <th width="auto">#</th>
	                <th width="auto">Producto</th>
	                <th width="auto">Talla</th>
	                <th width="auto">Precio</th>
	                <th width="auto">Stock</th>
	                <th width="auto">Categoria</th>
	                <th width="auto">Opciones</th>

	            </tr>
	        </thead>
			<tbody>
			<?php         	
			if(sizeof($arrayProd)>0)
			{
				for($j=0; $j<sizeof($arrayProd); $j++)
	        		{
	        			$talid = $database ->getTallasbyID($arrayProd[$j]['talla']);
	        			echo '
	        				<tr>
	        					<td>'.$arrayProd[$j]['idproducto'].'</td>';
			        			echo '<td>'.$arrayProd[$j]['nombre'].'</td>';
			        			echo '<td>'.$talid[0]['talla'].'</td>';
			        			echo '<td> Bs. '.$arrayProd[$j]['precio'].'</td>';
			        			echo '<td>'.$arrayProd[$j]['stock'].'</td>';
			        			$arrayCat = $database->getCategoria($arrayProd[$j]['idcategoria']);

			        			echo '<td><span class="label label-success">'.$arrayCat[0]['nombre'].'</span></td>';
			        			echo '<td><a href="edit.php?id='.$arrayProd[$j]['idproducto'].'&n=3"><img src="../images/edit.png"/></a>
			        			<a href="delete.php?id='.$arrayProd[$j]['idproducto'].'&n=3" onclick="return confirmation()"><img src="../images/deletep.png"/></a></td>
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


		</script>

</body>

</html>