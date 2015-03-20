<?
  session_start();  
?>
<?php
 include_once("../../include/session.php");
 global $database, $form, $mailer; 
 	 	$tipo = $_REQUEST['tipo'];
 	 	$id = $_REQUEST['idf'];
 	 	$idd = $_REQUEST['idd'];
		
		$getp = $database -> FactDet($idd);
		$idprod = $getp[0]['idproducto'];
		$cant = $getp[0]['cantidad'];
		$verif = $database -> getProdbyId($idprod);
		$sumaStock = $verif[0]['stock'] + $cant;

		$updStock = $database -> changeStock($idprod,$sumaStock);

		if ($updStock) {
			$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
			mysql_select_db(DB_NAME, $con) or die(mysql_error());
			$q = "DELETE FROM facturadetalle WHERE idfacturadetalle= '".$idd."'";
			$result = mysql_query($q,$con);

			if(!$result){

					$_SESSION ['error_array'] = $form->getErrorArray();
					header( "Location: newf.php?n=".$tipo."&idf=".$id);
					$men = "No se puedo eliminar";
			}else{
					$_SESSION ['error_array'] = $form->getErrorArray ();
					header( "Location: newf.php?n=".$tipo."&idf=".$id);
					$men = "Registro eliminado";
			}		
		}else{
			$men = 'Ha ocurrido un error, vuelva a intentarlo';
		}

?>
	<script type="text/javascript">
		msj = '<?php echo $men; ?>';
		alert(msj);

	</script>