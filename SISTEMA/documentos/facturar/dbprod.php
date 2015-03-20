<?php 
 include_once("../../include/session.php");
?><style type="text/css">


.tableProd
{
    border: solid 1 black;

}
.divt
{
      position:absolute;
    bottom:0;
    margin-left:570px;
}


.tabletd
{
    margin-left: 50px;
    width: 100px;
    text-align: center;
}
#page-wrap{
            position:relative;

width: 960px;
height: 950px;
}
 
#footer{
    position:relative;
width: 960px;
height: 10px;
}
</style>
 <page>
 <div id="page-wrap">
     <table class="tableCAB tabletd">
        <tr>
            <td rowspan="4"><img src='../../images/cabeceraFacJ.jpg' style='width:510px; height:210px;'></td>
            <td style='width:50px; '></td>
            <td style='font-size: 10pt;vertical-align: top;padding-top: 23px;color: rgb(0, 16, 128);'><?php echo $rif; ?></td>        </tr>
        <tr>
            <td style='width:50px;'></td>
            <td colspan="2" style="font-size: 11pt;color: rgb(0, 16, 128);padding-top: 0px;">FORMA LIBRE</td>
        </tr>
        <tr>
            <td style='width:50px; '></td>
            <td colspan="2" style="font-size: 12pt;color: rgb(0, 16, 128);padding-top: 0px;font-weight: bold;"><?php echo 'Nº DE CONTROL'; ?></td>
        </tr>
        <tr>
            <td style='width:50px; '></td>
            <td  colspan="2" style="font-size: 12pt;color: rgb(236, 18, 18);font-weight: bold;"><?php echo '00 - 00';echo $idF; ?></td>
        </tr>
    </table>
    <!-- DATOS CLIENTES -->
    <table style="margin-left:70px;">
        <tr>
            <td><span style='font-weight: bold; '>FECHA: </span><span><?php echo $fecha; ?></span></td>
         <!--   <td><span style='margin-left:-120px;font-weight: bold; '>FACTURA Nº: 000</span><span><?php #echo $idF; ?></span></td>-->
        </tr>
        <tr>
            <td><span style=' font-weight: bold;'>CLIENTE:</span><span> <?php echo $nombre; ?></span></td>
        </tr>
        <tr>
            <td><span style=' font-weight: bold;'>RIF:</span><span> <?php echo $rif; ?></span></td>
        </tr>
        <tr>
            <td><span style='font-weight: bold; '>DIRECCION </span></td>
        </tr>
        <tr>
            <td><span style='font-weight: bold; '>FISCAL: </span><span> <?php echo $direc; ?></span></td>
        </tr>
        <tr>
            <td><span style='font-weight: bold; '>TEL&Eacute;FONOS: </span><span><?php echo $tlf; ?></span></td>
        </tr>
        <tr>
            <td><span style='font-weight: bold; '>ORDEN DE COMPRA Nº : </span><span><?php echo $Norden; ?></span></td>
        </tr>

        <tr>
            <td><span style='font-weight: bold; '>CONDICIONES DE PAGO:  CONTADO</span></td>
        </tr>
    </table>
<!-- tabla productos -->
    <table style="margin-left:70px;margin-top:20px">
    <thead>
        <tr style="border-bottom: 1px solid black;">
            <th style="border-bottom: 1px solid black;width:100px;"><span style='font-weight: bold;'>CANTIDAD</span></th>
            <th style="border-bottom: 1px solid black;width:400px;"><span style='font-weight: bold;'>DESCRIPCI&Oacute;N</span></th>
            <th style="border-bottom: 1px solid black;width:100px;"><span style='font-weight: bold;'>P.U.</span></th>
            <th style="border-bottom: 1px solid black;width:100px;"><span style='font-weight: bold;'>TOTAL</span></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $facdet = $database->selectFactDet($idF);

            if (sizeof($facdet) > 0) {
                for ($i=0; $i < sizeof($facdet); $i++){ 
                    $producto = $database -> getProdbyIdPrint($facdet[$i]['idproducto']);
                    $talla = $database -> getTallasbyID($facdet[$i]['idtalla']);

                   if ($talla[0]['talla'] == "" || $talla[0]['talla'] == "No aplica") {
                    	echo "<tr>
                            <td>".$facdet[$i]['cantidad']."</td>
                            <td>".$producto[0]['nombre']."</td>
                            <td>".number_format($producto[0]['precio'], 2, ',', '.')."</td>
                            <td>".number_format($facdet[$i]['totalP'], 2, ',', '.')."</td>
                        </tr>";
                    }else{
                    	echo "<tr>
                            <td>".$facdet[$i]['cantidad']."</td>
                            <td>".$producto[0]['nombre'].". TALLA ".$talla[0]['talla']."</td>
                            <td>".number_format($producto[0]['precio'], 2, ',', '.')."</td>
                            <td>".number_format($facdet[$i]['totalP'], 2, ',', '.')."</td>
                        </tr>";
                    }
                }
            }
    ?>
        </tbody>
    </table>
    <!-- totalFACTURA -->
    <div class="divt">
    <table>
        <tr>
            <td><span style='font-weight: bold; '>SUB-TOTAL: </span></td>
            <td><?php echo number_format($subt, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td><span style=' font-weight: bold;'>I.V.A. 12%:</span></td>
            <td><?php echo number_format($iva, 2, ',', '.'); ?></td>

        </tr>
        <tr>
            <td><span style=' font-weight: bold;'>TOTAL: </span></td>
            <td><?php echo number_format($total, 2, ',', '.'); ?></td>

        </tr>

    </table>
    </div>
</div>
    <div id="footer">
    </div>
    </page>