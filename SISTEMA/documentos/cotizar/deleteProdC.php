<?
  session_start();  
?>
<?php
 include_once("../../include/session.php");
 global $database, $form, $mailer; 
 	 	$id = $_REQUEST['idc'];
 	 	$idd = $_REQUEST['idd'];
		
		$getp = $database -> cotDet($idd);
		$idprod = $getp[0]['idproducto'];
		$cant = $getp[0]['cantidad'];


			$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
			mysql_select_db(DB_NAME, $con) or die(mysql_error());
			$q = "DELETE FROM cotdetalle WHERE idcotdetalle= '".$idd."'";
			$result = mysql_query($q,$con);

			if(!$result){

					$_SESSION ['error_array'] = $form->getErrorArray();
					header( "Location: newC.php?idc=".$id);
					$men = "No se puedo eliminar";
			}else{
					$_SESSION ['error_array'] = $form->getErrorArray ();
					header( "Location: newC.php?idc=".$id);
					$men = "Registro eliminado";
			}		


?>
	<script type="text/javascript">
		msj = '<?php echo $men; ?>';
		alert(msj);

	</script>