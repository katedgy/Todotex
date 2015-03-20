<?
  session_start();  
?>
<?php
 include_once("../../include/session.php");
 	 	$status = $_REQUEST['stat'];

 	 	$id = $_REQUEST['id'];

 	 	if ($status == '3'){
 	 		$newStatus='4';
 	 	}else{
 	 		$newStatus = '3';
 	 	}

		// include('../include/constants.php');
			$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
		  	mysql_select_db(DB_NAME, $con) or die(mysql_error());
		  	
			$q= "UPDATE pedido SET idstatus = '".$newStatus."' WHERE idpedido= '".$id."' ";


	$result = mysql_query($q,$con);

		if($result){

				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: pedidos.php?ac=1");

		}else{

				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: pedidos.php?ac1=2");

		}


?>