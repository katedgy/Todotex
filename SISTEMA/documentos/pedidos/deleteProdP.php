<?
  session_start();  
?>
<?php
 include_once("../../include/session.php");
 global $database, $form, $mailer; 
 	 	$id = $_REQUEST['idp'];
 	 	$idd = $_REQUEST['idd'];
		
		$getp = $database -> peDet($idd);
		$idprod = $getp[0]['idproducto'];
		$cant = $getp[0]['cantidad'];


			$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
			mysql_select_db(DB_NAME, $con) or die(mysql_error());
			$q = "DELETE FROM pedetalle WHERE idpedetalle= '".$idd."'";
			$result = mysql_query($q,$con);

			if(!$result){

					$_SESSION ['error_array'] = $form->getErrorArray();
					header( "Location: newP.php?idp=".$id);
					$men = "No se puedo eliminar";
			}else{
					$_SESSION ['error_array'] = $form->getErrorArray ();
					header( "Location: newP.php?idp=".$id);
					$men = "Registro eliminado";
			}		


?>
	<script type="text/javascript">
		msj = '<?php echo $men; ?>';
		alert(msj);

	</script>