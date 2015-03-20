<?php

$conexion = new mysqli('localhost','root','','todotex');
$product = $_GET['term'];
$consulta = "SELECT nombre FROM productos WHERE nombre LIKE '%$product%'";

$result = $conexion->query($consulta);

if($result->num_rows > 0){
	while($fila = $result->fetch_array()){
		$products[] = $fila['nombre'];		
	}
	echo json_encode($products);
}

?>