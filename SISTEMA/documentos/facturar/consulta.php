<?php 
//Configuracion de la conexion a base de datos
 //  $bd_host = "localhost"; 
 //  $bd_usuario = "root"; 
 //  $bd_password = ""; 
 //  $bd_base = "todotex"; 
 //  $na = " "; //sin talla, no aplica
	// $con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
	// mysql_select_db($bd_base, $con); 
  include_once("../../include/session.php"); 
if (isset($_REQUEST['idF'])) {
  $idF = $_REQUEST['idF'];
}

//consulta todos los empleados
global $database, $form, $mailer; 
$item = $database->getFacturabyIdFacturadetalle($idF);

$na="Seleccione una opcion";
$t='0';
$porc='0.12';
?>
<table id="table" class="table table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <td class='text-center'><strong>Cantidad</strong></td>
      <td class='text-center'><strong>Nombre</strong></td>
      <td class='text-center'><strong>Talla</strong></td>
      <td class='text-center'><strong>Precio Un.</strong></td>
      <td class='text-center'><strong>Total</strong></td>
      <td class='text-center'><strong>Eliminar</strong></td>
    </tr>
  </thead>
  <tbody>
    <?php
      if (sizeof($item)>0) {
        for ($i=0; $i <sizeof($item) ; $i++) { 
        $talla=$database->getTallasbyID($item[$i]['idtalla']);
                    
          $producto =$database-> getProdbyId($item[$i]['idproducto']);
          $can = $item[$i]['cantidad'];
          $precio = $producto[0]["precio"];

          echo "<tr>";
          echo "<td class='text-center'>".$can."</td>";
          // echo "<td>".$item[$i]['idproducto']."</td>";
          // echo "<td>".$producto[0]["nombre"].". ".$item[$i]['talla']."</td> ";
          echo "<td class='text-center'>".$producto[0]["nombre"]."</td> ";
          echo "<td class='text-center'>".$talla[0]['talla']."</td> ";
          echo "<td class='text-center'> Bs. ".$producto[0]["precio"]."</td>";
          $total = $can * $precio;
          echo "<td class='text-center'> Bs. ".$total."</td>";
          $t=$t+$total;
          echo '<td class="text-center">
          <button id="myButton" value="'.$item[$i]["idfacturadetalle"].'" class="a btn btn-default"><img src="../../images/pdel.png"/></button>

          </tr>';
          // editar <button data-pid="'.$item[$i]["idfacturadetalle"].'" value="'.$item[$i]["idfacturadetalle"].'" class="b btn btn-default"><img src="../../images/edit.png"/></button>

          echo "</tr>"; 

        }
        echo "<tr><td colspan='5'>&nbsp;</td></tr>";
      echo "<div class='refresh' id='ref'>";
        echo "<tr>
                <td colspan='4'>
                  <p class='text-right'><strong>Sub-Total</strong></p>
                </td>
                <td>
                  <p class='text-center' name='subt'>Bs. ".number_format($t, 2, ',', '.')."</p>
                </td>
              </tr>";
        $iva=$t*$porc;
        echo "<tr>
                <td colspan='4'>
                  <p class='text-right'><strong>I.V.A. (12%): </strong></p>
                </td>
                <td>
                  <p class='text-center' name='iva'>Bs. ".number_format($iva, 2, ',', '.')."</p>
                </td>
              </tr>";
        $all=$t+$iva;
        echo "<tr>
                <td colspan='4'>
                  <p class='text-right'><strong>Total</strong></p>
                </td>
                <td>
                  <p class='text-center' name='total'>Bs. ".number_format($all, 2, ',', '.')."</p>
                </td>
              </tr>";
        echo "</div>";
     }
    ?>
                <input type="hidden" size="1" readonly="yes" name="iva" id="iva" value="<?php echo $iva; ?>"/>
            <input type="hidden" size="1" readonly="yes" name="subt" id="subt" value="<?php echo $t; ?>"/>
            <input type="hidden" size="1" readonly="yes" name="total" id="total" value="<?php echo $all; ?>"/>
  </tbody>
</table >

