<?php 

//Configuracion de la conexion a base de datos
  $bd_host = "localhost"; 
  $bd_usuario = "root"; 
  $bd_password = ""; 
  $bd_base = "todotex"; 
 
	$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
	mysql_select_db($bd_base, $con); 
 	include_once("../../include/session.php"); 
	global $database, $form, $mailer; 
	
	//variables 
	$idc =$_REQUEST['idcoti'];
	$idprod =$_REQUEST['idp'];
	$producto =$_REQUEST['name'];
	$precio =$_REQUEST['prec'];
	$cantidad =$_REQUEST['can'];
 	$idtalla = $_REQUEST['idtalla'];
    $totalPRO = $cantidad * $precio;


	$sql= "INSERT INTO cotdetalle (idcotemp,idproducto,cantidad,idtalla,totalP) VALUES ('".$idc."','".$idprod."','".$cantidad."','".$idtalla ."','".$totalPRO."')";
	mysql_query($sql,$con) or die('Error. '.mysql_error());
	
		include('consultaC.php');
	?>
