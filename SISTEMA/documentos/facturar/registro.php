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
	$idF =$_REQUEST['idfac'];
	$tipo =$_REQUEST['ti'];
	$idprod =$_REQUEST['idp'];
	$producto =$_REQUEST['name'];
	$precio =$_REQUEST['prec'];
	$cantidad =$_REQUEST['can'];
	$talla =$_REQUEST['tal'];
 	$idtalla = $_REQUEST['idtalla'];
    $totalPRO = $cantidad * $precio;
	$verif = $database -> getProdbyId($idprod);

	if ($cantidad > ($verif[0]['stock'])) { 
		echo "<h5 style='color: rgb(255, 87, 0);'>Aviso: Stock insuficiente para facturar el producto</h5>";
    }else{
		$prod = $verif[0]['stock'];
		$restaStock = $prod - $cantidad;
		$updStock = $database -> changeStock($idprod,$restaStock);
		
		if ($updStock) {
			$sql= "INSERT INTO facturadetalle (idfactemp,idproducto,cantidad,talla,idtalla,totalP) VALUES ('".$idF."','".$idprod."','".$cantidad."','".$talla."','".$idtalla ."','".$totalPRO."')";
			mysql_query($sql,$con) or die('Error. '.mysql_error());
		}else{
			$men = 'Ha ocurrido un error, vuelva a intentarlo';
		}
	}
		include('consulta.php');
	?>
