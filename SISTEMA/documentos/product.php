<?php
	
	$conexion = new mysqli('localhost','root','','todotex',3306);
	$product = $_POST['producto'];
	$consulta = "SELECT idproducto,precio FROM productos WHERE nombre = '$product'";

	$result = $conexion->query($consulta);
	
	$respuesta = new stdClass();
	if($result->num_rows > 0){
		$fila = $result->fetch_array();
		$respuesta->idproducto = $fila['idproducto'];
		$respuesta->precio = $fila['precio'];		
	}
	
	echo json_encode($respuesta);
?>