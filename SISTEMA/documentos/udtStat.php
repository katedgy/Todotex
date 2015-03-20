<?
  session_start();  
?>
<?php
 include_once("../include/session.php");
 	 	$status = $_REQUEST['stat'];

 	 	$id = $_REQUEST['id'];

 	 	if ($status == '1'){
 	 		$newStatus='2';
 	 	}else{
 	 		$newStatus = '1';
 	 	}

		// include('../include/constants.php');
			$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
		  	mysql_select_db(DB_NAME, $con) or die(mysql_error());
		  	
			$q= "UPDATE factura SET idstatus = '".$newStatus."' WHERE idfactura= '".$id."' ";


	$result = mysql_query($q,$con);

		if($result){

				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: factura.php?ac=1");

		}else{

				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: factura.php?ac1=2");

		}


?>