<?php
/**
 * Process.php
 * 
 * The Process class is meant to simplify the task of processing
 * user submitted forms, redirecting the user to the correct
 * pages if errors are found, or if form is successful, either
 * way. Also handles the logout procedure.
 *
 * Created by: Carlos Pinto
 * Last Updated: February 19, 2014
 */

include ("include/session.php");

class Process
{
  /* Class constructor */

	function Process()
	{
		global $session;

		/* Process Contact Form */
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="add"))
		{
			$this->add();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="edit"))
		{
			$this->edit();
		}

		if ( (isset($_POST ['action'])) && ($_POST ['action']=="addContact"))
		{
			$this->addContact();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="login"))
		{
			$this->login();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="newf"))
		{
			$this->newf();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="insertFT"))
		{
			$this->insertFT();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="insertFTEST"))
		{
			$this->insertFTEST();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="facturar"))
		{
			$this->facturar();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="modifac"))
		{
			$this->modifac();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="cotizar"))
		{
			$this->cotizar();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="modifCot"))
		{
			$this->modifCot();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="insertCotemp"))
		{
			$this->insertCotemp();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="insertPedtemp"))
		{
			$this->insertPedtemp();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="pedido"))
		{
			$this->pedido();
		}
		if ( (isset($_POST ['action'])) && ($_POST ['action']=="modifPed"))
		{
			$this->modifPed();
		}

	}


	function login()
	{
		global $session, $form;

		$user 		= $_POST['user'];
		$password 	= $_POST['password'];
		

		$retval = $session->validateLogin($user,$password);


		/* Added successful */
		if ($retval==TRUE)
		{
			// print_r($_SESSION['username']);
			// exit();
			header( "Location: index.php");
		}else{
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: login.php");

		}
	}

	function insertFT()
	{
		global $session, $form;

		$n 			= $_POST['n'];
		$id 		= $_POST['id'];

		$retval = $session->validateInsert($n,$id);


		/* Added successful */
		if ($retval==TRUE)
		{
			header( "Location: documentos/newf.php?n=".$n."&id=".$id);
		}else{
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: documentos/factura.php");

		}
	}

	function insertFTEST()
	{
		global $session, $form;

		$n 			= $_POST['n'];
		$id 		= $_POST['idf'];

		$retval = $session->validateInsert($n,$id);


		/* Added successful */
		if ($retval==TRUE)
		{
			header( "Location: documentos/facturar/newf.php?n=".$n."&idf=".$id);
		}else{
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: documentos/factura.php");

		}
	}

	function facturar()
	{
		global $session, $form, $database;

		$idF =$_POST['idF'];
		$tipo =$_POST['tipo'];
		// $cou =$_REQUEST['cou'];


		if ($_POST['guardar']) {
			$btn = '1';
			$nombre =$_POST['nombre'];
			$rif =$_POST['rif'];
			$direc =$_POST['direc'];
			$tlf =$_POST['tlf'];

			$idCli =$_POST['idcliente'];
			$fecha =$_POST['fecha'];
			$Norden =$_POST['Norden'];
			$status = '2';
			$subt = $_POST['subt'];
			$iva = $_POST['iva'];
			$total = $_POST['total'];
			$us =$_SESSION["usename"];
			if ($Norden== "") {
				$Norden = "No aplica";
			}
			// $url="";
			$retval=$session->valAddFac($idF,$nombre,$rif,$direc,$tlf,$tipo,$idCli,$fecha,$Norden,$status,$subt,$iva,$total,$us);
		}elseif($_POST['cancel']){
			$btn = '2';
			header( "Location: documentos/factura.php");
			$retval=TRUE;
			// $retval=$session->valIdFac($idF,$tipo);
		}

		// $retval = $session->validateInsert($n,$id);

		/* Added successful */

		if($retval)
		{
			header( "Location: documentos/factura.php");
			// echo $url;
		}elseif(!$retval){
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: documentos/facturar/newf.php?n=".$tipo."&idf=".$idF);

		}
	}

	function insertPedtemp()
	{
		global $session, $form;


		$id 	= $_POST['idpt'];

		$retval = $session->validateInsertPedTemp($id);


		/* Added successful */
		if ($retval==TRUE)
		{
			header( "Location: documentos/pedidos/newP.php?idp=".$id);
		}else{
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: documentos/pedidos/pedidos.php");

		}
	}
	function pedido()
	{
		global $session, $form, $database;

		$idpe =$_POST['idpe'];

		if (isset($_POST['guardar'])) {
			$nombre =$_POST['nombre'];
			$rif =$_POST['rif'];
			$direc =$_POST['direc'];
			$tlf =$_POST['tlf'];
			$idCli =$_POST['idcliente'];
			$fecha =$_POST['fecha'];
			$Norden =$_POST['Norden'];
			$status = '3';
			$subt = $_POST['subt'];
			$iva = $_POST['iva'];
			$total = $_POST['total'];
			$us =$_SESSION["usename"];


			if ($Norden== "") {
				$Norden = "No aplica";
			}
			// $url="";
			$retval=$session->valAddPed($idpe,$nombre,$rif,$direc,$tlf,$idCli,$fecha,$Norden,$status,$subt,$iva,$total,$us);
		}elseif(isset($_POST['cancel'])){
			$btn = '2';
			$url=header( "Location: documentos/pedidos/pedidos.php");

			$retval=TRUE;

		}

		// $retval = $session->validateInsert($n,$id);

		/* Added successful */

		if($retval)
		{
			header( "Location: documentos/pedidos/pedidos.php");
			// echo $url;
		}elseif(!$retval){
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: documentos/pedidos/newP.php?idp=".$idpe);

		}
	}

	function modifPed()
	{
		global $session, $form, $databse;

		$idpe =$_REQUEST['idpe'];

		if ($_POST['guardar']) {
			$nombre =$_POST['nombre'];
			$rif =$_POST['rif'];
			$direc =$_POST['direc'];
			$tlf =$_POST['tlf'];
			$idCli =$_POST['idcliente'];
			$fecha =$_POST['fecha'];
			$Norden =$_POST['Norden'];
			$status = '3';
			$subt = $_POST['subt'];
			$iva = $_POST['iva'];
			$total = $_POST['total'];
			$url = "";


			if ($Norden== "") {
				$Norden = "No aplica";
			}
			$retval=$session->valUpdPed($url,$nombre,$rif,$direc,$tlf,$idpe,$idCli,$fecha,$Norden,$status,$subt,$iva,$total);
		}elseif($_POST['cancel']){
			$btn = '2';
			$url=header( "Location: documentos/pedidos/pedidos.php");

			$retval=$session->cancelEditPed($idpe);

		}

		/* Added successful */
		if($retval)
		{
			echo $url;
		}elseif(!$retval){
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: documentos/pedidos/editP.php?idpe=".$idpe);

		}
	}
	function insertCotemp()
	{
		global $session, $form;

		$id 	= $_POST['idct'];

		$retval = $session->validateInsertTemp($id);


		/* Added successful */
		if ($retval==TRUE)
		{
			header( "Location: documentos/cotizar/newC.php?idc=".$id);
		}else{
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: documentos/cotizar/cotizacion.php");

		}
	}
	function cotizar()
	{
		global $session, $form, $database;

		$idc =$_POST['idc'];

		if ($_POST['guardar']) {
			$btn = '1';
			$att =$_POST['att'];
			$nombre =$_POST['nombre'];
			$rif =$_POST['rif'];
			$direc =$_POST['direc'];
			$tlf =$_POST['tlf'];
			$idCli =$_POST['idcliente'];
			$fecha =$_POST['fecha'];
			$subt = $_POST['subt'];
			$iva = $_POST['iva'];
			$total = $_POST['total'];
			$us =$_SESSION["usename"];

			if ($att== "") {
		 		$att = "";
		 	}

			$retval=$session->valAddCot($idc,$att,$nombre,$rif,$direc,$tlf,$idCli,$fecha,$subt,$iva,$total,$us);
		}elseif($_POST['cancel']){
			$btn = '2';
			header( "Location: documentos/cotizar/cotizacion.php");
			$retval=TRUE;
		}

		if($retval)
		{
			header( "Location: documentos/cotizar/cotizacion.php");
			// echo $url;
		}elseif(!$retval){
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: documentos/cotizar/newC.php?idc=".$idc);

		}

		// 		/* Added successful */
		// if($retval1)
		// {
	 //      		header( "Location: documentos/facturar/imprimir.php?nom=".$nombre."&rif=".$rif."&direc=".$direc."&tlf=".$tlf."&fecha=".$fecha."&Norden=".$Norden."&subt=".$subt."&iva=".$iva."&total=".$total);
		// }elseif(!$retval1){
		// 		$_SESSION['error_array'] = $form->getErrorArray();
		// 		$_SESSION['value_array'] = $_POST;
		// 		header( "Location: documentos/facturar/newf.php?n=".$tipo."&idf=".$idF);
		// }
	}

	function modifCot()
	{
		global $session, $form, $databse;

		$idc =$_REQUEST['idc'];
			
		if ($_POST['guardar']) {
			$btn = '1';
			$nombre =$_REQUEST['nombre'];
			$rif =$_REQUEST['rif'];
			$direc =$_REQUEST['direc'];
			$tlf =$_REQUEST['tlf'];

			$idCli =$_REQUEST['idcliente'];
			$fecha =$_REQUEST['fecha'];
			$subt = $_REQUEST['subt'];
			$iva = $_REQUEST['iva'];
			$total = $_REQUEST['total'];
			$url="";
			$att =$_POST['att'];

			if ($att== "") {
		 		$att = "";
		 	}
			$retval=$session->valUpdCot($url,$att,$nombre,$rif,$direc,$tlf,$idc,$idCli,$fecha,$subt,$iva,$total);

		}elseif($_POST['cancel']){
			$btn = '2';
			$url=header( "Location: documentos/cotizar/cotizacion.php");

			$retval=$session->cancelEdit($idc);
		}
		if($retval)
		{
			echo $url;
		}elseif(!$retval){
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: documentos/cotizar/editC.php?idc=".$idc);

		}
	}


	function modifac()
	{
		global $session, $form, $databse;

		$idF =$_REQUEST['idF'];
		$tipo =$_REQUEST['tipo'];


		if ($_POST['agregar']) {
			$btn = '1';
			$nombre =$_REQUEST['nombre'];
			$rif =$_REQUEST['rif'];
			$direc =$_REQUEST['direc'];
			$tlf =$_REQUEST['tlf'];

			$idCli =$_REQUEST['idcliente'];
			$fecha =$_REQUEST['fecha'];
			$Norden =$_REQUEST['Norden'];
			$status = '2';
			$subt = $_REQUEST['subt'];
			$iva = $_REQUEST['iva'];
			$total = $_REQUEST['total'];


			if ($Norden== "") {
				$Norden = "No aplica";
			}
			$url="";

			$retval=$session->valUpdFac($url,$nombre,$rif,$direc,$tlf,$idF,$tipo,$idCli,$fecha,$Norden,$status,$subt,$iva,$total);
		}elseif($_POST['cancel']){
			$btn = '2';
			$url=header( "Location: documentos/factura.php");

			$retval=$session->valIdFacEdit($idF,$tipo);
		}

		/* Added successful */
		if($retval)
		{

			echo $url;
		}elseif(!$retval){
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: documentos/facturar/editF.php?n=".$tipo."&idf=".$idF);

		}
	}

	function add()
	{
		global $session, $form;

		$tipo 			= $_POST['tipo'];

		if($tipo == '1' || $tipo == '2')
		{
		$nombre 		= $_POST['nombre'];
		$rif			= $_POST['rif'];
		$direccion		= $_POST['direccion'];
		$telefono 		= $_POST['telefono'];
		$producto 		= $_POST['producto'];

		$retval = $session->validateAddForm($tipo,$nombre,$rif,$direccion,$telefono,$producto);
	}elseif($tipo == '3'){
		$talla 		= $_POST['talla'];
		$nombre 		= $_POST['nombre'];
		$precio 		= $_POST['precio'];
		$stock 			= $_POST['stock'];
		$producto 		= $_POST['producto'];

		$retval = $session->validateAddProd($tipo,$nombre,$talla,$precio,$stock,$producto);
	}elseif($tipo == '4'){

		$nombre 		= $_POST['nombre'];
		$clave 			= $_POST['clave'];
		$nivel 			= $_POST['nivel'];

		$retval = $session->validateAddUser($tipo,$nombre,$clave,$nivel);
	}


		/* Added successful */
		if ($retval==TRUE && $tipo == '1')
		{
			header( "Location: registros/cliente.php?a=1");
		}elseif ($retval==FALSE && $tipo == '1')
		{
			header( "Location: registros/cliente.php?x=1");
		}elseif ($retval==TRUE && $tipo == '2') {
			header( "Location: registros/prov.php?a=1");
		}elseif ($retval==false && $tipo == '2') {
			header( "Location: registros/prov.php?x=1");
		}elseif ($retval==TRUE && $tipo == '3') {
			header( "Location: registros/prod.php?a=1");
		}elseif ($retval==TRUE && $tipo == '4') {
			header( "Location: registros/cuentas.php?a=1");
		}else{
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: registros/add.php?n=".$tipo);

		}
	}

	function newf()
	{
		global $session, $form;

		$tipo 		= $_POST['tipo'];
		$id 		= $_POST['nombre'];


		$retval = $session->validateName($tipo,$id);

		/* Added successful */
		if ($retval==TRUE && $tipo == '1')
		{
			header( "Location: documentos/newf.php?n=".$id);
		}elseif ($retval==TRUE && $tipo == '2') {
			header( "Location: registros/prov.php?a=1");
		}elseif ($retval==TRUE && $tipo == '3') {
			header( "Location: registros/prod.php?a=1");
		}else{
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: registros/new.php?n=".$tipo);

		}
	}

	function edit()
	{
		global $session, $form;


		$id 			= $_REQUEST['id'];
		$tipo 			= $_REQUEST['tipo'];
		$nombre 		= $_REQUEST['nombre'];

		if($tipo == '1' || $tipo == '2'){
			$rif			= $_REQUEST['rif'];
			$direccion		= $_REQUEST['direccion'];
			$telefono 		= $_REQUEST['telefono'];
		}elseif ($tipo == '3'){

			$talla 		= $_REQUEST['talla'];
			$precio 		= $_REQUEST['precio'];
			$stock 			= $_POST['stock'];
			$producto 		= $_POST['producto'];
		}elseif ($tipo == '4') {
			$clave		= $_REQUEST['clave'];
			$nivel	= $_REQUEST['nivel'];

		}


		if ($tipo == '2') {
			$producto 		= $_REQUEST['producto'];
			$retval = $session->validateEditFormPro($id,$tipo,$nombre,$rif,$direccion,$telefono,$producto);
		}elseif ($tipo == '1') {
			
			$retval = $session->validateEditFormCli($id,$tipo,$nombre,$rif,$direccion,$telefono);

		}elseif ($tipo == '3') {

			$retval = $session->validateEditProducto($id,$tipo,$nombre,$talla,$precio,$stock,$producto);
		}elseif ($tipo == '4') {
			$retval = $session->validateEditUser($id,$tipo,$nombre,$clave,$nivel);
		}

		

		/* Added successful */
		if ($retval && $tipo == '1')
		{
			header( "Location: registros/cliente.php?m=1");
		}elseif ($retval && $tipo == '2') {
			header( "Location: registros/prov.php?m=1");
		}elseif ($retval && $tipo == '3') {
			header( "Location: registros/prod.php?m=1");
		}elseif ($retval && $tipo == '4') {
			header( "Location: registros/cuentas.php?m=1");
		}else{
			$_SESSION['error_array'] = $form->getErrorArray();
			$_SESSION['value_array'] = $_POST;
			header( "Location: registros/edit.php?id=".$id."&n=".$tipo);

		}
	}
	

	function addNewsLetter()
	{
		global $session, $form;

		$email 			= $_REQUEST['mailnewsletter'];
		$urlfrom 		= $_REQUEST['urlfrom'];
		$retval = $session->validateNewsLetterForm($email);

		/* Added successful */
		if ($retval==1)
		{
			header ( "Location: ".$urlfrom."?nl=1");
		}else{
			$_SESSION ['value_array'] = $_POST;
			$_SESSION ['error_array'] = $form->getErrorArray ();
			if($retval==2){
				header ( "Location: ".$urlfrom."?nl=2");
			}else{
				if($retval==3){
					header ( "Location: ".$urlfrom."?nl=3");
				}else{
					header ( "Location: ".$urlfrom."");
				}
			}
		}
	}
};

/* Initialize process */

$process = new Process ( );
?>