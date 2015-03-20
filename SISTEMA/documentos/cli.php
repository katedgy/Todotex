<?php
	
	$conexion = new mysqli('localhost','root','','todotex',3306);
	$conexion->set_charset('utf8');
	$nombre = $_POST['nombre'];
	$consulta = "SELECT idcliente,rif,direc, tlf FROM cliente WHERE nombre = '$nombre'";

	$result = $conexion->query($consulta);
	
	$respuesta = new stdClass();
	if($result->num_rows > 0){
		$fila = $result->fetch_array();
		$respuesta->idcliente = $fila['idcliente'];
		$respuesta->rif = $fila['rif'];
		$respuesta->direc = $fila['direc'];
		$respuesta->tlf = $fila['tlf'];		
	}
	
	echo json_encode($respuesta);
?>