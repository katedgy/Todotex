<?php
	 include_once("../../include/session.php"); 
  $idfac = $_REQUEST['idfac'];
  $ti = $_REQUEST['ti'];
  $idc = $_REQUEST['idc'];
  $name = $_REQUEST['name'];
  $rif = $_REQUEST['rif'];
  $direc = $_REQUEST['direc'];
  $tlf = $_REQUEST['tlf'];
  $date = $_REQUEST['date'];
  $Norden = $_REQUEST['Norden'];
  $subt = $_REQUEST['subt'];
  $iva = $_REQUEST['iva'];
  $total = $_REQUEST['total'];
  $status = '2';
  $us =$_SESSION["usename"];


	//consulta todos los empleados
	global $database, $form, $mailer,$session;
	// $retval=$session->valAddFac($idfac,$name,$rif,$direc,$tlf,$ti,$idc,$date,$Norden,$status,$subt,$iva,$total,$us);
	$idus=$database -> getUser($us);
    $usuario= $idus[0]['iduser'];
    $addFac = $database->AddFactura($idfac,$idc,$ti,$Norden,$date,$status,$subt,$iva,$total,$usuario);
    
?>
