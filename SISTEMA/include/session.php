<?php
/**
 * Session.php
 * 
 * The Session class is meant to simplify the task of keeping
 * track of logged in users and also guests.
 *
 * Created by: Edgylin Rodriguez
 * Last Updated: June, 2014.
 */

include_once("database.php");
include_once("mailer.php");
require_once("form.php"); 

class Session
{
   var $username;     //Username given on sign-up
   var $userid;       //Random value generated on current login
   var $time;         //Time user was last active (page loaded)
   var $logged_in;    //True if user is logged in, false otherwise
   var $userinfo = array();  //The array holding all user info
   var $url;          //The page url current being viewed
   var $referrer;     //Last recorded site page viewed

   /**
    * Note: referrer should really only be considered the actual
    * page referrer in process.php, any other time it may be
    * inaccurate.
    */
   /* Class constructor */

	function Session(){

		session_start();
	}
	
	
   /**
    * startSession - Performs all the actions necessary to 
    * initialize this session object. Tries to determine if the
    * the user has logged in already, and sets the variables 
    * accordingly. 
    */

  function validateLogin($user,$password)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "user";
    if(!$user || strlen($user = trim($user)) == 0)
    {
      $form->setError($field, "*Debe ingresar su nombre de usuario");
    }

    /* Email (Contact) error checking */
    $field = "password";  //Use field name for email
    if(!$password || strlen($password = trim($password)) == 0)
    {
      $form->setError($field, "*Debe ingresar su contrase&ntilde;a");
    }
  


    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

        $loged = $database->verifyLog($user,$password);

        if($loged)
        {
          return true;
        }else{
          $form->setError($field, "*Usuario y/o contrase&ntilde;a incorrecta");
          header( "Location: login.php");
        }
    }
  }

  function validateInsertTemp($id)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "id"; 
    if(!$id || strlen($id = trim($id)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

        $in = $database->insertcotTemp($id);

        if($in)
        {
          return true;
        }else{
          $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
          header( "Location: documentos/cotizar/cotizacion.php");
        }
    }
  }

  function validateInsertPedTemp($id)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "id"; 
    if(!$id || strlen($id = trim($id)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

        $in = $database->insertpedTemp($id);

        if($in)
        {
          return true;
        }else{
          return false;
        }
    }
  }

    function valAddPed($idpe,$nombre,$rif,$direc,$tlf,$idCli,$fecha,$Norden,$status,$subt,$iva,$total,$us)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "idpe";
    if(!$idpe || strlen($idpe = trim($idpe)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del cliente");
    }
    $field = "rif";
    if(!$rif || strlen($rif = trim($rif)) == 0)
    {
      $form->setError($field, "*Debe ingresar el rif del cliente");
    }
    $field = "direc";
    if(!$direc || strlen($direc = trim($direc)) == 0)
    {
      $form->setError($field, "*Debe ingresar la direccion del cliente");
    }
    $field = "tlf";
    if(!$tlf || strlen($tlf = trim($tlf)) == 0)
    {
      $form->setError($field, "*Debe ingresar el numero del telefono del cliente");
    }
    $field = "idCli";
    if(!$idCli || strlen($idCli = trim($idCli)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "fecha";
    if(!$fecha || strlen($fecha = trim($fecha)) == 0)
    {
      $form->setError($field, "*Debe ingresar una fecha valida");
    }
    $field = "Norden";
    if(!$Norden || strlen($Norden = trim($Norden)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    } 
    $field = "status";
    if(!$status || strlen($status = trim($status)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "subt";
    if(!$subt || strlen($subt = trim($subt)) == 0)
    {
    $form->setError($field, "*Ha ocurrido un error. Debe agregar al menos un producto");
    }    
    $field = "iva";
    if(!$iva || strlen($iva = trim($iva)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }    
    $field = "total";
    if(!$total || strlen($total = trim($total)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }

    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

          $idus=$database -> getUser($us);
          $usuario= $idus[0]['iduser'];
          $anul = 'no';


          $getPe = $database ->getPedidobyID($idpe);
          if ($getPe) {
            return true;
          }else{
          $addPed = $database->AddPedido($idpe,$idCli,$Norden,$fecha,$status,$subt,$iva,$total,$anul,$usuario);
            #print_r($addCot);
            #exit();
            if($addPed)
            {
              return true;
            }else{
              return false;
            }
          }



          if($addPed)
          {
            return true;
          }else{
            return false;
          }
        
    }
  }
  function cancelEditPed($idp)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "idp";
    if(!$idp || strlen($idp = trim($idp)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {
      return true;
    }
  }
  function valIdPed($idpe)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "idpe";
    if(!$idpe || strlen($idpe = trim($idpe)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

      $getexist = $database -> getPedidobyIdpedetalle($idpe);

      if (sizeof($getexist) != 0) {

        $delProdpe = $database -> DeleteAllProdPedido($idpe);

        if($delProdpe)
        {
          $in = $database->delPedTemp($idpe);

            if($in)
            {
              return true;
            }else{
              return false;
            }
        }else{
          return false;
        }

      }else{
          $in = $database->delPedTemp($idpe);
          if($in)
          {
            return true;
          }else{
            return false;
          }
      }
       


    }
  }


function valUpdPed($url,$nombre,$rif,$direc,$tlf,$idpe,$idCli,$fecha,$Norden,$status,$subt,$iva,$total)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del cliente");
    }
    $field = "rif";
    if(!$rif || strlen($rif = trim($rif)) == 0)
    {
      $form->setError($field, "*Debe ingresar el rif del cliente");
    }
    $field = "direc";
    if(!$direc || strlen($direc = trim($direc)) == 0)
    {
      $form->setError($field, "*Debe ingresar la direccion del cliente");
    }
    $field = "tlf";
    if(!$tlf || strlen($tlf = trim($tlf)) == 0)
    {
      $form->setError($field, "*Debe ingresar el numero del telefono del cliente");
    }
    $field = "idpe";
    if(!$idpe || strlen($idpe = trim($idpe)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "idCli";
    if(!$idCli || strlen($idCli = trim($idCli)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "fecha";
    if(!$fecha || strlen($fecha = trim($fecha)) == 0)
    {
      $form->setError($field, "*Debe ingresar una fecha valida");
    }
    $field = "Norden";
    if(!$Norden || strlen($Norden = trim($Norden)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    } 
    $field = "status";
    if(!$status || strlen($status = trim($status)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
   
    $field = "subt";
    if(!$subt || strlen($subt = trim($subt)) == 0)
    {
    $form->setError($field, "*Ha ocurrido un error. Debe agregar al menos un producto");
    }      
    $field = "iva";
    if(!$iva || strlen($iva = trim($iva)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }    
    $field = "total";
    if(!$total || strlen($total = trim($total)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }

  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

      $us =$_SESSION["usename"];
      $idus=$database -> getUser($us);
      $usuario= $idus[0]['iduser'];
      $anul = 'no';
      $Pedupdated = $database->UpdPedido($idpe,$idCli,$Norden,$fecha,$status,$subt,$iva,$total,$anul,$usuario);

      if($Pedupdated)
      {
        $url1=header( "Location: documentos/pedidos/pedidos.php");
        return true;
      }else{
        return false;
      }
    }
  }
  function valAddCot($idc,$att,$nombre,$rif,$direc,$tlf,$idCli,$fecha,$subt,$iva,$total,$us)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "idc";
    if(!$idc || strlen($idc = trim($idc)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del cliente");
    }
    $field = "rif";
    if(!$rif || strlen($rif = trim($rif)) == 0)
    {
      $form->setError($field, "*Debe ingresar el rif del cliente");
    }
    $field = "direc";
    if(!$direc || strlen($direc = trim($direc)) == 0)
    {
      $form->setError($field, "*Debe ingresar la direccion del cliente");
    }
    $field = "tlf";
    if(!$tlf || strlen($tlf = trim($tlf)) == 0)
    {
      $form->setError($field, "*Debe ingresar el numero del telefono del cliente");
    }
    $field = "idCli";
    if(!$idCli || strlen($idCli = trim($idCli)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "fecha";
    if(!$fecha || strlen($fecha = trim($fecha)) == 0)
    {
      $form->setError($field, "*Debe ingresar una fecha valida");
    }
    $field = "subt";
    if(!$subt || strlen($subt = trim($subt)) == 0)
    {
    $form->setError($field, "*Ha ocurrido un error. Debe agregar al menos un producto");
    }    
    $field = "iva";
    if(!$iva || strlen($iva = trim($iva)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }    
    $field = "total";
    if(!$total || strlen($total = trim($total)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }

    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {
          $idus=$database -> getUser($us);
          $usuario= $idus[0]['iduser'];

          $getCot = $database ->getCotizacionbyID($idc);
          if ($getCot) {
            return true;
          }else{
            $addCot = $database->AddCotizacion($idc,$idCli,$att,$fecha,$subt,$iva,$total,$usuario);
            #print_r($addCot);
            #exit();
            if($addCot)
            {
              return true;
            }else{
              $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
              $_SESSION ['error_array'] = $form->getErrorArray();
              header( "Location: ../documentos/cotizar/newC.php?idc=".$idc);
            }
          }
        
    }
  }

 function valUpdCot($url,$att,$nombre,$rif,$direc,$tlf,$idc,$idCli,$fecha,$subt,$iva,$total)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del cliente");
    }
    $field = "rif";
    if(!$rif || strlen($rif = trim($rif)) == 0)
    {
      $form->setError($field, "*Debe ingresar el rif del cliente");
    }
    $field = "direc";
    if(!$direc || strlen($direc = trim($direc)) == 0)
    {
      $form->setError($field, "*Debe ingresar la direccion del cliente");
    }
    $field = "tlf";
    if(!$tlf || strlen($tlf = trim($tlf)) == 0)
    {
      $form->setError($field, "*Debe ingresar el numero del telefono del cliente");
    }
    $field = "idc";
    if(!$idc || strlen($idc = trim($idc)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "idCli";
    if(!$idCli || strlen($idCli = trim($idCli)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "fecha";
    if(!$fecha || strlen($fecha = trim($fecha)) == 0)
    {
      $form->setError($field, "*Debe ingresar una fecha valida");
    }
    $field = "subt";
    if(!$subt || strlen($subt = trim($subt)) == 0)
    {
    $form->setError($field, "*Ha ocurrido un error. Debe agregar al menos un producto");
    }      
    $field = "iva";
    if(!$iva || strlen($iva = trim($iva)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }    
    $field = "total";
    if(!$total || strlen($total = trim($total)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }

    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {
      $us =$_SESSION["usename"];
      $idus=$database -> getUser($us);
      $usuario= $idus[0]['iduser'];
      $Facupdated = $database->UpdCot($idc,$idCli,$att,$fecha,$subt,$iva,$total,$usuario);
      
      if($Facupdated)
      {
        $url1=header( "Location: documentos/cotizar/cotizacion.php");
        return true;
      }else{
        $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
        $_SESSION ['error_array'] = $form->getErrorArray();
        header( "Location: ../documentos/editC.php?idc=".$idc);
      }
    }
  }

  function cancelEdit($idc)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "idc";
    if(!$idc || strlen($idc = trim($idc)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {
      return true;
    }
  }

  function valIdC($idc)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "idc";
    if(!$idc || strlen($idc = trim($idc)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

        $delProd = $database->DeleteAllProdCotizacion($idc);

        if($delProd)
        {
            return true;
        }else{
            $form->setError($field, "*Ha ocurrido un error.");
            header( "Location: ../documentos/newC.php?idc=".$idc);
        }
    }
  }

  function valAddFac($idF,$nombre,$rif,$direc,$tlf,$tipo,$idCli,$fecha,$Norden,$status,$subt,$iva,$total,$us)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "idF";
    if(!$idF || strlen($idF = trim($idF)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del cliente");
    }
    $field = "rif";
    if(!$rif || strlen($rif = trim($rif)) == 0)
    {
      $form->setError($field, "*Debe ingresar el rif del cliente");
    }
    $field = "direc";
    if(!$direc || strlen($direc = trim($direc)) == 0)
    {
      $form->setError($field, "*Debe ingresar la direccion del cliente");
    }
    $field = "tlf";
    if(!$tlf || strlen($tlf = trim($tlf)) == 0)
    {
      $form->setError($field, "*Debe ingresar el numero del telefono del cliente");
    }
    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "idCli";
    if(!$idCli || strlen($idCli = trim($idCli)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "fecha";
    if(!$fecha || strlen($fecha = trim($fecha)) == 0)
    {
      $form->setError($field, "*Debe ingresar una fecha valida");
    }
    $field = "Norden";
    if(!$Norden || strlen($Norden = trim($Norden)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    } 
    $field = "status";
    if(!$status || strlen($status = trim($status)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "subt";
    if(!$subt || strlen($subt = trim($subt)) == 0)
    {
    $form->setError($field, "*Ha ocurrido un error. Debe agregar al menos un producto");
    }    
    $field = "iva";
    if(!$iva || strlen($iva = trim($iva)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }    
    $field = "total";
    if(!$total || strlen($total = trim($total)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }

    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

      $idus=$database -> getUser($us);
      $usuario= $idus[0]['iduser'];

      $getFac = $database ->getFacturabyID($idF);

      if ($getFac) {
        return true;
      }else{
        $addFac = $database->AddFactura($idF,$idCli,$tipo,$Norden,$fecha,$status,$subt,$iva,$total,$usuario);
        if($addFac)
        {
          return true;
        }else{
          return false;
        }
      }
        
    }
  }

  function valPrintFac($url,$nombre,$rif,$direc,$tlf,$idF,$tipo,$idCli,$fecha,$Norden,$status,$subt,$iva,$total)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del cliente");
    }
    $field = "rif";
    if(!$rif || strlen($rif = trim($rif)) == 0)
    {
      $form->setError($field, "*Debe ingresar el rif del cliente");
    }
    $field = "direc";
    if(!$direc || strlen($direc = trim($direc)) == 0)
    {
      $form->setError($field, "*Debe ingresar la direccion del cliente");
    }
    $field = "tlf";
    if(!$tlf || strlen($tlf = trim($tlf)) == 0)
    {
      $form->setError($field, "*Debe ingresar el numero del telefono del cliente");
    }
    $field = "idF";
    if(!$idF || strlen($idF = trim($idF)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }

    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }

    $field = "idCli";
    if(!$idCli || strlen($idCli = trim($idCli)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }

    $field = "fecha";
    if(!$fecha || strlen($fecha = trim($fecha)) == 0)
    {
      $form->setError($field, "*Debe ingresar una fecha valida");
    }
    $field = "Norden";
    if(!$Norden || strlen($Norden = trim($Norden)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    } 
    $field = "status";
    if(!$status || strlen($status = trim($status)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
   
    $field = "subt";
    if(!$subt || strlen($subt = trim($subt)) == 0)
    {
      
    $form->setError($field, "*Ha ocurrido un error. Debe agregar al menos un producto");
    }       
    $field = "iva";
    if(!$iva || strlen($iva = trim($iva)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }    
    $field = "total";
    if(!$total || strlen($total = trim($total)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }

  
    if($form->num_errors > 0)
    {
      return false;
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
      $_SESSION ['error_array'] = $form->getErrorArray();

      header( "Location: documentos/newf.php?n=".$tipo."&idf=".$id);
    }
    else
    {
      '<script type="text/javascript"> window.open("documentos/facturar/imprimir.php"); </script>';
      // $url= header( "Location: documentos/facturar/imprimir.php?nom=".$nombre."&rif=".$rif."&direc=".$direc."&tlf=".$tlf."&idF=".$idF."&tipo=".$tipo."&fecha=".$fecha."&Norden=".$Norden."&subt=".$subt."&iva=".$iva."&total=".$total);
      return true;
    }
  }

  function valIdFac($idF,$tipo)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "idF";
    if(!$idF || strlen($idF = trim($idF)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }

    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }

  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

        $getP = $database ->  selectFactDet($idF);
        if(sizeof($getP)>0)
        {
          for($j=0; $j<sizeof($getP); $j++)
          {
            $idp = $getP[$j]['idproducto'];
            $getP[$j]['cantidad'];

            $canP= $database ->getProdbyId($idp);
            $canP[$j]['stock'];
            $total = $getP[$j]['cantidad'] + $canP[$j]['stock'];
            $chan = $database -> changeStock($idp,$total);
          }
        }
        $delProd = $database->DeleteAllProdFactura($idF);

        if($delProd)
        {
          $in = $database->delFacTemp($idF);
          if($in)
          {
            return true;
          }else{
            $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
            header( "Location: ../documentos/newf.php?n=".$tipo."&id=".$id);
          }
        }else{
            $form->setError($field, "*Ha ocurrido un error.");
            header( "Location: ../documentos/newf.php?n=".$tipo."&id=".$id);
        }
    }
  }

  function valIdFacEdit($idF,$tipo)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "idF";
    if(!$idF || strlen($idF = trim($idF)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }

    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }

  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {
      $url= header( "Location: documentos/factura.php");
      return true;
    }
  }

 function valUpdFac($url1,$nombre,$rif,$direc,$tlf,$idF,$tipo,$idCli,$fecha,$Norden,$status,$subt,$iva,$total)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del cliente");
    }
    $field = "rif";
    if(!$rif || strlen($rif = trim($rif)) == 0)
    {
      $form->setError($field, "*Debe ingresar el rif del cliente");
    }
    $field = "direc";
    if(!$direc || strlen($direc = trim($direc)) == 0)
    {
      $form->setError($field, "*Debe ingresar la direccion del cliente");
    }
    $field = "tlf";
    if(!$tlf || strlen($tlf = trim($tlf)) == 0)
    {
      $form->setError($field, "*Debe ingresar el numero del telefono del cliente");
    }
    $field = "idF";
    if(!$idF || strlen($idF = trim($idF)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "idCli";
    if(!$idCli || strlen($idCli = trim($idCli)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "fecha";
    if(!$fecha || strlen($fecha = trim($fecha)) == 0)
    {
      $form->setError($field, "*Debe ingresar una fecha valida");
    }
    $field = "Norden";
    if(!$Norden || strlen($Norden = trim($Norden)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    } 
    $field = "status";
    if(!$status || strlen($status = trim($status)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
    $field = "subt";
    if(!$subt || strlen($subt = trim($subt)) == 0)
    {
    $form->setError($field, "*Ha ocurrido un error. Debe agregar al menos un producto");
    }      
    $field = "iva";
    if(!$iva || strlen($iva = trim($iva)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }    
    $field = "total";
    if(!$total || strlen($total = trim($total)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error.");
    }

  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {
      $us =$_SESSION["usename"];
      $idus=$database -> getUser($us);
      $usuario= $idus[0]['iduser'];
      $anul = 'no';
      $Facupdated = $database->UpdFactura($idF,$idCli,$tipo,$Norden,$fecha,$status,$subt,$iva,$total,$anul,$usuario);

      if($Facupdated)
      {
        $url1=header( "Location: documentos/factura.php");
        return true;
      }else{
        $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
        $_SESSION ['error_array'] = $form->getErrorArray();
        header( "Location: ../documentos/editF.php?n=".$tipo."&idf=".$id);
      }
    }
  }
  function validateInsert($n,$id)
  {
    global $database, $form, $mailer;  //The database and form object


    $field = "n";
    if(!$n || strlen($n = trim($n)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }


    $field = "id"; 
    if(!$id || strlen($id = trim($id)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
    }
  
    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

        $in = $database->insertfacTemp($n,$id);

        if($in)
        {
          return true;
        }else{
          $form->setError($field, "*Ha ocurrido un error. Intentelo de nuevo");
          header( "Location: ../documentos/factura.php");
        }
    }
  }

  function validateAddForm($tipo,$nombre,$rif,$direccion,$telefono,$producto)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }
    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre de la empresa");
    }

    /* Email (Contact) error checking */
    $field = "rif";  //Use field name for email
    if(!$rif || strlen($rif = trim($rif)) == 0)
    {
      $form->setError($field, "*Debe ingresar el rif de la empresa");
    }
  
    $field = 'direccion';
    if(!$direccion || strlen($direccion = trim($direccion)) == 0)
    {
      $form->setError($field, "*Debe ingresar la direccion fiscal de la empresa");
    }   

    $field = 'telefono';
    if(!$telefono || strlen($telefono = trim($telefono)) == 0)
    {
      $form->setError($field, "*Debe ingresar el telefono de la empresa");
    }
    
    if ($tipo == '2') {
      $field = 'producto';
      if(!$producto || strlen($producto = trim($producto)) == FALSE)
      {
        $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
      }
    }


    if($form->num_errors > 0)
    {     

      return false;
    }
    else
    {

        if ($tipo == '1')
        {
          $verify=$database->getClientesbyRif($rif);
          if ($verify) {
              $added=false;
          }else{
              $added = $database->addClient($nombre,$rif,$direccion,$telefono);
          }

        }elseif ($tipo == '2')
        {
          $verifyP=$database->getProvbyRif($rif);
          if ($verifyP){
            $added = false;
          }else{
            $added = $database->addProv($nombre,$rif,$direccion,$telefono,$producto);
          }
        }

          if($added == true)
          {
            return true;
          }else{
            return false;
          }
    }
  }

  function validateAddProd($tipo,$nombre,$talla,$precio,$stock,$producto)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del producto");
    }

    $field = "talla";
    if(!$talla || strlen($talla = trim($talla)) == 0)
    {
      $form->setError($field, "*Debe ingresar la talla del producto");
    }


    $field = "precio";
    if(!$precio || strlen($precio = trim($precio)) == 0)
    {
      $form->setError($field, "*Debe ingresar el precio del producto");
    }

    $field = "stock";
    if(!$stock || strlen($stock = trim($stock)) == 0)
    {
      $form->setError($field, "*Debe ingresar el stock del producto");
    }

    $field = "producto";
    if(!$producto || strlen($producto = trim($producto)) == 0)
    {
      $form->setError($field, "*Debe ingresar la categoria del producto");
    }

    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

        $added = $database->addProd($nombre,$talla,$precio,$stock,$producto);

        if($added)
        {
          return true;
        }else{
          return false;
        }
    }
  }

   function validateAddUser($tipo,$nombre,$clave,$nivel)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del usuario");
    }

    $field = "clave";
    if(!$clave || strlen($clave = trim($clave)) == 0)
    {
      $form->setError($field, "*Debe ingresar la clave del usuario");
    }


    $field = "nivel";
    if(!$nivel || strlen($nivel = trim($nivel)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nivel del usuario");
    }



    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {

        $added = $database->addUser($nombre,$clave,$nivel);

        if($added)
        {
          return true;
        }else{
          return false;
        }
    }
  }

  function validateEditFormCli($id,$tipo,$nombre,$rif,$direccion,$telefono)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "id";
    if(!$id || strlen($id = trim($id)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre de la empresa");
    }

    /* Email (Contact) error checking */
    $field = "rif";  //Use field name for email
    if(!$rif || strlen($rif = trim($rif)) == 0)
    {
      $form->setError($field, "*Debe ingresar el rif de la empresa");
    }
  
    $field = 'direccion';
    if(!$direccion || strlen($direccion = trim($direccion)) == 0)
    {
      $form->setError($field, "*Debe ingresar la direccion fiscal de la empresa");
    }   

    $field = 'telefono';
    if(!$telefono || strlen($telefono = trim($telefono)) == 0)
    {
      $form->setError($field, "*Debe ingresar el telefono de la empresa");
    }


    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {
      
      if ($tipo == '1')
      {
        $edit = $database->editClient($id,$nombre,$rif,$direccion,$telefono);
      }elseif ($tipo == '2') {
        $edit = $database->editProv($id,$nombre,$rif,$direccion,$telefono,$producto);
      }
    

        if($edit)
        {
          return true;
        }else{
          return false;
        }
    }
  }

  function validateEditFormPro($id,$tipo,$nombre,$rif,$direccion,$telefono,$producto)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "id";
    if(!$id || strlen($id = trim($id)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre de la empresa");
    }

    /* Email (Contact) error checking */
    $field = "rif";  //Use field name for email
    if(!$rif || strlen($rif = trim($rif)) == 0)
    {
      $form->setError($field, "*Debe ingresar el rif de la empresa");
    }
  
    $field = 'direccion';
    if(!$direccion || strlen($direccion = trim($direccion)) == 0)
    {
      $form->setError($field, "*Debe ingresar la direccion fiscal de la empresa");
    }   

    $field = 'telefono';
    if(!$telefono || strlen($telefono = trim($telefono)) == 0)
    {
      $form->setError($field, "*Debe ingresar el telefono de la empresa");
    }

    $field = 'producto';
    if(!$producto || strlen($producto = trim($producto)) == 0)
    {
      $form->setError($field, "*Debe ingresar el producto");
    }


    if($form->num_errors > 0)
    {
      return false;
    }
    else
    {
      
      if ($tipo == '1')
      {
        $edit = $database->editClient($id,$nombre,$rif,$direccion,$telefono);
      }elseif ($tipo == '2') {
        $edit = $database->editProv($id,$nombre,$rif,$direccion,$telefono,$producto);
      }
    

        if($edit)
        {
          return true;
        }else{
          return false;
        }
    }
  }

  function validateEditProducto($id,$tipo,$nombre,$talla,$precio,$stock,$producto)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "id";
    if(!$id || strlen($id = trim($id)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del producto");
    }
    $field = "talla";
    if(!$talla || strlen($talla = trim($talla)) == 0)
    {
      $form->setError($field, "*Debe ingresar la talla del producto");
    }

    $field = "precio";
    if(!$precio || strlen($precio = trim($precio)) == 0)
    {
      $form->setError($field, "*Debe ingresar el precio del producto");
    }
    
    $field = "stock";
    if(!$stock || strlen($stock = trim($stock)) == null)
    {
      if ($stock== '0') {
        $stock == '0';
      }else{
        $form->setError($field, "*Debe ingresar el stock del producto");
      }
    }

    $field = "producto";
    if(!$producto || strlen($producto = trim($producto)) == 0)
    {
      $form->setError($field, "*Debe ingresar la categoria del producto");
    }

    if($form->num_errors > 0)
    {

      return false;
    }
    else
    {

      $edit = $database->editProducto($id,$nombre,$talla,$precio,$stock,$producto);

        if($edit)
        {

          return true;
        }else{

          return false;
        }
    }
  }


 function validateEditUser($id,$tipo,$nombre,$clave,$nivel)
  {
    global $database, $form, $mailer;  //The database and form object

    $field = "id";
    if(!$id || strlen($id = trim($id)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "nombre";
    if(!$nombre || strlen($nombre = trim($nombre)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nombre del producto");
    }
    $field = "clave";
    if(!$clave || strlen($clave = trim($clave)) == 0)
    {
      $form->setError($field, "*Debe ingresar la clave del usuario");
    }

    $field = "nivel";
    if(!$nivel || strlen($nivel = trim($nivel)) == 0)
    {
      $form->setError($field, "*Debe ingresar el nivel del usuario");
    }
    

    if($form->num_errors > 0)
    {

      return false;
    }
    else
    {
      
      $edit = $database->editUser($id,$nombre,$clave,$nivel);
      
        if($edit)
        {
          return true;
        }else{
          return false;
        }
    }
  }

    function validateName($tipo,$id)
    {
    global $database, $form, $mailer;  //The database and form object


    $field = "tipo";
    if(!$tipo || strlen($tipo = trim($tipo)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }

    $field = "nombre";
    if(!$id || strlen($id = trim($id)) == 0)
    {
      $form->setError($field, "*Ha ocurrido un error, vuelva a intentarlo");
    }



    if($form->num_errors > 0)
    {

      return false;
    }
    else
    {
      
      $val = $database->valName($id);
      
        if($val)
        {
          return true;
        }else{
          return false;
        }
    }
  }

  function checkValueVar($varSecc, $varArray)
  {
    if( (trim($varSecc)!="") )
    {
      $var = $varSecc;
      }else{
      $var = $varArray;
    }
    return $var;
  }

  function getIpAddress(){
    return $_SERVER['REMOTE_ADDR'];
  }

};


/**
 * Initialize session object - This must be initialized before
 * the form object because the form uses session variables,
 * which cannot be accessed unless the session has started.
 */

 $session = new Session;

/* Initialize form object */
$form = new Form;

?>