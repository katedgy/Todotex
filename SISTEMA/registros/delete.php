<?
  session_start();  
?>
<?php
 include_once("../include/session.php");
 	 	$tipo = $_REQUEST['n'];

 	 	$id = $_REQUEST['id'];

		// include('../include/constants.php');
			$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
		  	mysql_select_db(DB_NAME, $con) or die(mysql_error());
		  	
		if ($tipo == "1"){

			$q = "DELETE FROM cliente WHERE idcliente= '".$id."'";

		}elseif ($tipo == "2"){

			$q = "DELETE FROM proveedor WHERE idproveedor= '".$id."'";

		}elseif ($tipo == "3"){

			$q = "DELETE FROM productos WHERE idproducto= '".$id."'";
		}elseif ($tipo == "4"){

			$q = "DELETE FROM user WHERE iduser= '".$id."'";
		}

	$result = mysql_query($q,$con);

		if($result){

			if ($tipo == "1"){
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: cliente.php?e=1");
			}elseif ($tipo == "2"){
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: prov.php?e=1");
			}elseif ($tipo == "3"){
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: prod.php?e=1");
			}elseif ($tipo == "4"){
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: cuentas.php?e=1");
			}
		}else{

			if ($tipo == "1"){
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: cliente.php?f=2");
			}elseif ($tipo == "2"){
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: prov.php?f=2");
			}elseif ($tipo == "3"){
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: prod.php?f=2");
			}
		}


?>