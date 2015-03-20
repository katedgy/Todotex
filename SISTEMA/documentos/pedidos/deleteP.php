<?
  session_start();  
?>
<?php
 include_once("../../include/session.php");
 	 	$id = $_REQUEST['id'];
			$an = $database -> getPedidoAnul($id);

			$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
		  	mysql_select_db(DB_NAME, $con) or die(mysql_error());
			
			if (($an[0]['anulada']) == 'si') {
				$s= "UPDATE pedido SET anulada = 'no' WHERE idpedido= '".$id."' ";

			}else{
				$s= "UPDATE pedido SET anulada = 'si' WHERE idpedido = '".$id."' ";
			}

			$result = mysql_query($s,$con);

		if($result)
		{
			$_SESSION ['error_array'] = $form->getErrorArray ();
			header( "Location: pedidos.php?e=1");
		}else{

			$_SESSION ['error_array'] = $form->getErrorArray ();
			header( "Location: pedidos.php?f=2");

		}
?>