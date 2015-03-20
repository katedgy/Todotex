<?
  session_start();  
?>
<?php
 include_once("../../include/session.php");

 	 	$id = $_REQUEST['id'];

			$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
		  	mysql_select_db(DB_NAME, $con) or die(mysql_error());
			

			$s= "DELETE FROM cotizacion WHERE idcot = '".$id."' ";
			

			$result = mysql_query($s,$con);

		if($result)
		{
			$t= "DELETE FROM cotdetalle WHERE idcot = '".$id."' ";
			$r = mysql_query($t,$con);
			if ($r)
			{
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: cotizacion.php?e=1");
			}else{
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: cotizacion.php?f=2");
			}
		}else{		
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: cotizacion.php?f=2");
		}


?>