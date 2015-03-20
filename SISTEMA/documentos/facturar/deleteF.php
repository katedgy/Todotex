<?
  session_start();  
?>
<?php
 include_once("../../include/session.php");
 	 	$tipo = $_REQUEST['n'];

 	 	$id = $_REQUEST['id'];
			$an = $database -> getFacturaAnul($id);

			$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
		  	mysql_select_db(DB_NAME, $con) or die(mysql_error());
			
			if (($an[0]['anulada']) == 'si') {
				$s= "UPDATE factura SET anulada = 'no' WHERE idfactura = '".$id."' ";

			}else{
				$s= "UPDATE factura SET anulada = 'si' WHERE idfactura = '".$id."' ";
			}

			$result = mysql_query($s,$con);

		if($result)
		{
			$_SESSION ['error_array'] = $form->getErrorArray ();
			header( "Location: ../factura.php");
		}else{
			include('elseDelFac.php');
		}
?>