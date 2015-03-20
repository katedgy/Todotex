<?php

$conexion = new mysqli('localhost','root','','todotex');
$conexion->set_charset('utf8');
$nombre = $_GET['term'];
$consulta = "SELECT nombre FROM cliente WHERE nombre LIKE '%$nombre%'";
$result = $conexion->query($consulta);

if($result->num_rows > 0){
	while($fila = $result->fetch_array()){
		$nombres[] = $fila['nombre'];		
	}
	echo json_encode($nombres);
}

?>