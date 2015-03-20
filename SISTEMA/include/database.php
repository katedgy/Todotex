<?php
/**
 * Database.php
 * 
 * The Database class is meant to simplify the task of accessing
 * information from the website's database.
 *
 * Created by: Carlos Pinto
 * Last Updated: February 19, 2014
 */
     
class MySQLDB
{
   var $connection;         //The MySQL database connection
   var $num_active_users;   //Number of active users viewing site
   var $num_active_guests;  //Number of active guests viewing site
   var $num_members;        //Number of signed-up users
   /* Note: call getNumMembers() to access $num_members! */

   /* Class constructor */
	function MySQLDB(){
	  /* Make connection to database */
	  include('constants.php');
	  $this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
	  mysql_select_db(DB_NAME, $this->connection) or die(mysql_error());
	}
	
	function verifyLog($user,$password)
	{
		$q = "SELECT * FROM user WHERE nombre= '".$user."' AND clave= '".$password."' ";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
					    $_SESSION['usename'] = $user;

			return $array;

		     //establecermos las variables de sesión
			
		}
	}

	function getUser($user)
	{
		$q = "SELECT iduser FROM user WHERE nombre= '".$user."' ";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			$_SESSION['idus'] = $array;
			return $array;
		     //establecermos las variables de sesión
		}
	}

	function getAllUser()
	{
		$q = "SELECT * FROM user";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
					    $_SESSION['idus'] = $array;

			return $array;

		     //establecermos las variables de sesión
			
		}
	}

	function addUser($nombre,$clave,$nivel)
	{
			$q = "INSERT INTO user (nombre,clave,nivel) VALUES (UPPER('".$nombre."'),'".$clave."','".$nivel."')";
			
			$q = mysql_query($q,$this->connection);
			if($q)
			{
				return true;
			}else{
				return false;
			}	
		
	}
	function getUserbyID($id)
	{
		$q = "SELECT * FROM user WHERE iduser = '".$id."' ";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
					    $_SESSION['idus'] = $array;

			return $array;

		     //establecermos las variables de sesión
			
		}
	}

	function editUser($id,$nombre,$clave,$nivel)
	{
		$q= "UPDATE user SET nombre = UPPER('".$nombre."'), clave = '".$clave."', nivel = '".$nivel."' WHERE iduser= '".$id."'";

		$result = mysql_query($q,$this->connection);
		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}

	function getClientes()
	{
		$q = "SELECT * FROM cliente;";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}
	
	function addClient($nombre,$rif,$direccion,$telefono)
	{
			$q = "INSERT INTO cliente (nombre,rif,direc,tlf) VALUES (UPPER('".$nombre."'),'".$rif."',UPPER('".$direccion."'),'".$telefono."')";
			
			$q = mysql_query($q,$this->connection);
			if($q)
			{
				return true;
			}else{
				return false;
			}	
		
	}

	function getClientesbyRif($rif)
	{
		$q = "SELECT * FROM cliente WHERE rif= '".$rif."' ";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return 0;
	    }else{
			return 1;
		}
	}

	function getProvbyRif($rif)
	{
		$q = "SELECT * FROM proveedor WHERE rif= '".$rif."'";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			return true;
		}
	}

	function editClient($id,$nombre,$rif,$direccion,$telefono)
	{
		$q= "UPDATE cliente SET nombre = UPPER('".$nombre."'), rif = '".$rif."', direc = UPPER('".$direccion."'), tlf = '".$telefono."' WHERE idcliente= '".$id."'";

		$result = mysql_query($q,$this->connection);
		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}

	function getClientesbyId($id)
	{
		$q = "SELECT * FROM cliente WHERE idcliente= '".$id."'";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function deleteCliente($id)
	{
		$q = "DELETE FROM cliente WHERE idcliente= '".$id."'";


		$result = mysql_query($q,$this->connection);
		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}	

	function addProv($nombre,$rif,$direccion,$telefono,$producto)
	{
		$q = "INSERT INTO proveedor (nombre,rif,direc,tlf, tipo) VALUES (UPPER('".$nombre."'),'".$rif."',UPPER('".$direccion."'),'".$telefono."', UPPER('".$producto."'))";
		
		$r = mysql_query($q,$this->connection);
		if($r)
		{
			return true;
		}else{
			return false;
		}
	}
	function getProv()
	{
		$q = "SELECT * FROM proveedor;";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getProvbyId($id)
	{
		$q = "SELECT * FROM proveedor WHERE idproveedor= '".$id."'";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function editProv($id,$nombre,$rif,$direccion,$telefono,$producto)
	{
		$q= "UPDATE proveedor SET nombre = UPPER('".$nombre."'), rif = '".$rif."', direc = UPPER('".$direccion."'), tlf = '".$telefono."', tipo = UPPER('".$producto."') WHERE idproveedor= '".$id."'";

		$result = mysql_query($q,$this->connection);
		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}

	function addProd($nombre,$talla,$precio,$stock,$producto)
	{
		$q = "INSERT INTO productos (nombre,talla,precio,stock,idcategoria) VALUES (UPPER('".$nombre."'),'".$talla."','".$precio."','".$stock."',UPPER('".$producto."'))";
		
		$result = mysql_query($q,$this->connection);
		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}


	function getProductos()
	{
		$q = "SELECT * FROM productos";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}



	function getProdbyId($id)
	{
		$q = "SELECT * FROM productos WHERE idproducto= '".$id."'";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getProdbyIdPrint($id)
	{
		$q = "SELECT nombre, precio FROM productos WHERE idproducto= '".$id."'";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function changeStock($idp,$stock){
		
		$q= "UPDATE productos SET  stock = '".$stock."' WHERE idproducto= '".$idp."' ";

		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}

	function editProducto($id,$nombre,$talla,$precio,$stock,$producto)
	{
		// if($descrip == NULL){
		// 	$q= "UPDATE productos SET nombre = '".$nombre."' , precio = '".$precio."', stock = '".$stock."', producto = '".$producto."' WHERE idproducto= '".$id."' ";
		
		// }else{}
			$q= "UPDATE productos SET nombre = UPPER('".$nombre."') ,talla = '".$talla."', precio = '".$precio."', stock = '".$stock."', idcategoria = '".$producto."' WHERE idproducto= '".$id."' ";


		$result = mysql_query($q,$this->connection);
		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}

	function getCategoria($idcategoria){
		$q= "SELECT * FROM categorias WHERE idcategoria = '".$idcategoria."' ";

		$result = mysql_query($q, $this->connection);

		if(!$result || (mysql_num_rows($result) < 1)){
			return NULL;
		}else{
			for ($i=0; $i <mysql_num_rows($result); $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getAllCategorias(){
		$q= "SELECT * FROM categorias";

		$result = mysql_query($q, $this->connection);

		if(!$result || (mysql_num_rows($result) < 1)){
			return NULL;
		}else{
			for ($i=0; $i <mysql_num_rows($result); $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getStatusbyId($id)
	{
		$q = "SELECT * FROM status WHERE idstatus= '".$id."'";
		
		$result = mysql_query($q,$this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function insertprodFactura($idF,$idprod,$cantidad,$talla){
		
		$q= "INSERT INTO facturadetalle (idfactemp,idproducto,cantidad,talla) values('".$idF."','".$idprod."','".$cantidad."'.'".$talla."')";
		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}

		function DeleteAllProdFactura($idF){
		
		$q = "DELETE FROM facturadetalle WHERE idfactemp= '".$idF."'";

		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}

	function selectFactDet($idF){
		
       $q = "SELECT * FROM facturadetalle WHERE idfactemp = '".$idF."' ";
		$result = mysql_query($q, $this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function FactDet($id){
		
       $q = "SELECT * FROM facturadetalle WHERE idfacturadetalle = '".$id."' ";
		$result = mysql_query($q, $this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function cotDet($id){
       $q = "SELECT * FROM cotdetalle WHERE idcotdetalle = '".$id."' ";
		$result = mysql_query($q, $this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function AddCotizacion($idc,$idCli,$att,$fecha,$subt,$iva,$total,$usuario)
	{

		$q= "INSERT INTO cotizacion (idcot,idcliente,att,fecha,monto,iva,total,iduser) VALUES ('".$idc."','".$idCli."','".$att."','".$fecha."','".$subt."','".$iva."','".$total."','".$usuario."')";

		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return 0;
		}else{
			return 1;
		}
	}

	function DeleteAllProdCotizacion($idc){
		
		$q = "DELETE FROM cotdetalle WHERE idcotemp= '".$idc."'";

		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}
	function insertfacTemp($n,$id)
	{
		$q= "INSERT INTO factemp (idfactemp,idtipo) values('".$id."','".$n."')";
		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}

	function delFacTemp($idF)
	{
		$q = "DELETE FROM factemp WHERE idfactemp= '".$idF."'";
		$result = mysql_query($q,$this->connection);
		if(!$result)
		{
			return false;
		}else{
			return true;
		}
		
	}

	function getFactura(){
		$q= "SELECT idfactura,idcliente, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha,idstatus,total FROM factura";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getFacturabyID($id){
		$q= "SELECT idfactura,idcliente, Norden, DATE_FORMAT(fecha,'%Y-%m-%d') as fecha,idstatus,total FROM factura WHERE idfactura = '".$id."' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}
	function getFacturaStat(){
		$q= "SELECT idfactura,idcliente, Norden, DATE_FORMAT(fecha,'%Y-%m-%d') as fecha,idstatus,total FROM factura WHERE idstatus = '1' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getFacturaFecha($f1,$f2){
		$q= "SELECT idfactura,idcliente, Norden, DATE_FORMAT(fecha,'%Y-%m-%d') as fecha,idstatus,total FROM factura WHERE idstatus = '1' AND fecha >= '$f1' AND fecha <= '$f2' ";

		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}		
			return $array;

		}
	}
	function getFacturaAnul($id){
		$q= "SELECT anulada FROM factura WHERE idfactura = '".$id."' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function AddFactura($idF,$idCli,$tipo,$Norden,$fecha,$status,$subt,$iva,$total,$usuario)
	{

		$q= "INSERT INTO factura (idfactura,idcliente,idtipo,Norden,fecha,idstatus,monto,iva,total,iduser,anulada) VALUES ('".$idF."','".$idCli."','".$tipo."','".$Norden."','".$fecha."','".$status."','".$subt."','".$iva."','".$total."','".$usuario."','no')";

		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return 0;
		}else{
			return 1;
		}
	}

	function UpdFactura($idF,$idCli,$tipo,$Norden,$fecha,$status,$subt,$iva,$total,$anul,$usu)
	{

		$date = date_create($fecha);
		$d= date_format($date, 'Y-m-d');

		$q= "UPDATE factura SET idcliente = '".$idCli."', idtipo = '".$tipo."', Norden = '".$Norden."', fecha = '".$d."', idstatus = '".$status."', monto = '".$subt."', iva = '".$iva."', total = '".$total."', anulada= '".$anul."', iduser = '".$usu."' WHERE idfactura = '".$idF."' ";

		$result = mysql_query($q,$this->connection);

		if(!$result)
		{
			return 0;
		}else{

			$s= "UPDATE facturadetalle SET idfactemp = '".$idF."' WHERE idfacturadetalle = '".$idF."' ";

			$r = mysql_query($s,$this->connection);
			if (!$r) {
				return 0;
			}else{
				return 1;
			}
		}
	}

	function UpdPrint($idF,$idCli,$tipo,$Norden,$fecha,$status,$subt,$iva,$total,$anul,$us)
	{

		$date = date_create($fecha);
		$d= date_format($date, 'Y-m-d');

		$q= "UPDATE factura SET idcliente = '".$idCli."', idtipo = '".$tipo."', Norden = '".$Norden."', fecha = '".$d."', idstatus = '".$status."', monto = '".$subt."', iva = '".$iva."', total = '".$total."', anulada= '".$anul."', iduser = '".$us."' WHERE idfactura = '".$idF."' ";

		$result = mysql_query($q,$this->connection);

		if(!$result)
		{
			return 0;
		}else{
			return 1;
			
		}
	}
	function UpdPrintCot($idc,$idcli,$att,$fecha,$subt,$iva,$total,$usuario)
	{

		$date = date_create($fecha);
		$d= date_format($date, 'Y-m-d');
		$q= "UPDATE cotizacion SET idcliente = '".$idcli."',att = '".$att."',fecha = '".$d."',monto = '".$subt."',iva = '".$iva."',total = '".$total."', iduser = '".$usuario."' WHERE idcot = '".$idc."' ";

		$result = mysql_query($q,$this->connection);

		if(!$result)
		{
			return 0;
		}else{
			return 1;
			
		}
	}

	function getFacturabyIdFacturadetalle($id){
		$q= "SELECT * FROM facturadetalle WHERE idfactemp = '".$id."' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function contarFacDet($idF,$tipo){
		$q= "SELECT count(*) as total FROM facturadetalle WHERE idfactemp='".$idF."' AND idtipo = '".$tipo."' ";

		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

				$dbarray = mysql_fetch_assoc($result);
				// $array[]=$dbarray;
		// 		echo $dbarray['total'];
		// exit();
		}
		
	}

	function getLastFactura(){
		$q= "SELECT idfactura FROM factura ORDER BY idfactura DESC LIMIT 1";

		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getLastFacturaTemp(){
		$q= "SELECT idfactemp FROM factemp ORDER BY idfactemp DESC LIMIT 1";

		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}


	function getLastCotizacion(){
		$q= "SELECT idcot FROM cotizacion ORDER BY idcot DESC LIMIT 1";

		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}
	function getLastCotizacionTemp(){
		$q= "SELECT idcotemp FROM cotemp ORDER BY idcotemp DESC LIMIT 1";

		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}
	function insertcotTemp($id)
	{
		$q= "INSERT INTO cotemp (idcotemp) values('".$id."')";

		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}

	function getCotizacion(){
		$q= "SELECT idcot,idcliente, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha,total FROM cotizacion";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getCotizacionbyID($idc){
		$q= "SELECT idcot,idcliente,att, DATE_FORMAT(fecha,'%Y-%m-%d') as fecha,total FROM cotizacion WHERE idcot = '".$idc."' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function UpdCot($idc,$idCli,$att,$fecha,$subt,$iva,$total,$usuario)
	{

		$date = date_create($fecha);
		$d= date_format($date, 'Y-m-d');

		$q= "UPDATE cotizacion SET idcliente = '".$idCli."',att = '".$att."',fecha = '".$d."',monto = '".$subt."',iva = '".$iva."',total = '".$total."', iduser = '".$usuario."' WHERE idcot = '".$idc."' ";

		$result = mysql_query($q,$this->connection);

		if(!$result)
		{
			return 0;
		}else{
			return 1;
		}
	}


	//function UpdCot($idc,$idCli,$att,$fecha,$subt,$iva,$total,$usuario)
	//{

	//	$date = date_create($fecha);
	//	$d= date_format($date, 'Y-m-d');
//
	//	$q= "UPDATE cotizacion SET idcliente = '".$idCli."',att = '".$att."',fecha = '".$d."',monto = '".$subt."',iva = '".$iva."',total = '".$total."', iduser = '".$usuario."' WHERE idcot = '".$idc."' ";

	//	$result = mysql_query($q,$this->connection);

	//	if(!$result)
	//	{
	//		return 0;
	//	}else{
//
	//		$s= "UPDATE cotdetalle SET idcot = '".$idc."' WHERE idcotdetalle = '".$idc."' ";
	//		$r = mysql_query($s,$this->connection);
	//		if (!$r) {
	//			return 0;
	//		}else{
	//			return 1;
	//		}
	//	}
	//}
	function getCotizacionbyIdCotdetalle($id){
		$q= "SELECT * FROM cotdetalle WHERE idcotemp = '".$id."' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}
	function valName($id){
		$q = "SELECT * from cliente WHERE idcliente = '".$id."' ";
		
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getLastPedidoTemp(){
		$q= "SELECT idpedtemp FROM pedtemp ORDER BY idpedtemp DESC LIMIT 1";

		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getPedido(){
		$q= "SELECT idpedido,idcliente,Norden, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha,idstatus,total, anulada FROM pedido";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getPedidoStat(){
		$q= "SELECT idpedido,idcliente,Norden, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha,idstatus,total FROM pedido WHERE idstatus = '3'";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}
	function getPedidoFecha($f1,$f2){
		$q= "SELECT idpedido,idcliente,Norden, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha,idstatus,total FROM pedido WHERE idstatus = '3' AND fecha >= '$f1' AND fecha <= '$f2' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function insertpedTemp($id)
	{
		$q= "INSERT INTO pedtemp (idpedtemp) values('".$id."')";

		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return false;
		}else{

			return true;
		}
	}

	function DeleteAllProdPedido($id){
		
		$q = "DELETE FROM pedetalle WHERE idpedtemp= '".$id."'";

		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return false;
		}else{
			return true;
		}
	}

	function delPedTemp($id)
	{
		$q = "DELETE FROM pedtemp WHERE idpedtemp= '".$id."'";
		$result = mysql_query($q,$this->connection);
		if(!$result)
		{
			return false;
		}else{
			return true;
		}
		
	}
	function getPedidobyIdpedetalle($id){
		$q= "SELECT * FROM pedetalle WHERE idpedtemp = '".$id."' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}
	function getPedidobyID($id){
		$q= "SELECT idpedido,idcliente, Norden, DATE_FORMAT(fecha,'%Y-%m-%d') as fecha,idstatus,total FROM pedido WHERE idpedido = '".$id."' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function UpdPrintP($idpe,$idCli,$Norden,$fecha,$status,$subt,$iva,$total,$anul,$us)
	{

		$date = date_create($fecha);
		$d= date_format($date, 'Y-m-d');

		$q= "UPDATE pedido SET idcliente = '".$idCli."', Norden = '".$Norden."', fecha = '".$d."', idstatus = '".$status."', monto = '".$subt."', iva = '".$iva."', total = '".$total."', anulada= '".$anul."', iduser = '".$us."' WHERE idpedido = '".$idpe."' ";

		$result = mysql_query($q,$this->connection);

		if(!$result)
		{
			return 0;
		}else{
			return 1;
			
		}
	}
	function peDet($id){
       $q = "SELECT * FROM pedetalle WHERE idpedetalle = '".$id."' ";
		$result = mysql_query($q, $this->connection);

	  	if(!$result || (mysql_num_rows($result) < 1))
	    {
			return NULL;
	    }else{
			for($i=0; $i<mysql_num_rows($result);$i++)
			{
				$dbarray = mysql_fetch_assoc($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}
	function getPedidoAnul($id){
		$q= "SELECT anulada FROM pedido WHERE idpedido = '".$id."' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

		function getPedidoEdo($id){
		$q= "SELECT status FROM status WHERE idstatus = '".$id."' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}
	function AddPedido($idpe,$idCli,$Norden,$fecha,$status,$subt,$iva,$total,$anul,$usuario)
	{

		$q= "INSERT INTO pedido (idpedido,idcliente,Norden,fecha,idstatus,monto,iva,total,anulada,iduser) VALUES ('".$idpe."','".$idCli."','".$Norden."','".$fecha."','".$status."','".$subt."','".$iva."','".$total."','".$anul."','".$usuario."')";

		$result = mysql_query($q, $this->connection);

		if(!$result)
		{
			return 0;
		}else{
			return 1;
		}
	}

	function UpdPedido($id,$idCli,$Norden,$fecha,$status,$subt,$iva,$total,$anul,$usu)
	{

		$date = date_create($fecha);
		$d= date_format($date, 'Y-m-d');

		$q= "UPDATE pedido SET idcliente = '".$idCli."', Norden = '".$Norden."', fecha = '".$d."', idstatus = '".$status."', monto = '".$subt."', iva = '".$iva."', total = '".$total."', anulada= '".$anul."', iduser = '".$usu."' WHERE idpedido = '".$id."' ";

		$result = mysql_query($q,$this->connection);

		if(!$result)
		{
			return 0;
		}else{

			$s= "UPDATE facturadetalle SET idfactemp = '".$idF."' WHERE idfacturadetalle = '".$idF."' ";

			$r = mysql_query($s,$this->connection);
			if (!$r) {
				return 0;
			}else{
				return 1;
			}
		}
	}
	function getTallas(){
		$q= "SELECT * FROM tallas";

		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}

	function getTallasbyID($idt){
		$q= "SELECT * FROM tallas WHERE idtalla = '".$idt."'";

		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

			for ($i=0; $i < mysql_num_rows($result) ; $i++) { 
				$dbarray = mysql_fetch_array($result);
				$array[]=$dbarray;
			}
			return $array;
		}
	}


	function cotarinv(){
		$q= "SELECT * FROM productos WHERE stock='0' ";
		$result = mysql_query($q, $this->connection);

		if (!$result || (mysql_num_rows($result) < 1)) {
			return NULL;
		}else{

				$dbarray = mysql_num_rows($result);
				// $array[]=$dbarray;
		// 		echo $dbarray['total'];
		// exit();
		}
		
	}

};

/* Create database connection */
$database = new MySQLDB;
?>