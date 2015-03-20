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

.divti
{
    position:absolute;
    margin-left:50;
    top:880px;
    width:50px;

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
	height: 810px;
}
 
#footer{
    position:absolute;
    margin-left:340;
    top:880px;
    width:50px;
}
</style>
 <page>
 <div id="page-wrap">
     <table class="tableCAB tabletd">
        <tr>
            <td rowspan="4"><img src='../../images/cab.jpg' style='width:650px; height:130px;margin-top:35px;'></td>
            <td style='width:50px; '></td>
        </tr>


    </table>
    <!-- DATOS CLIENTES -->
    <table style="margin-left:70px;">
        <tr>
            <td colspan="1"><span style='font-weight: bold; margin-left:470px;margin-top:35px;'>FECHA: </span><span style='margin-top:35px;'><?php echo $fecha; ?></span></td>
        </tr>
        <tr>
            <td><span style=' font-weight: bold;'>Cliente:</span></td>
        </tr>
        <tr>
            <td><span><?php echo $nombre; ?></span></td>
        </tr>

        <tr>
            <td><p style='font-weight: bold; '>CONDICIONES DE PAGO:  CONTADO</p></td>
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
        $Pedet = $database->getPedidobyIdpedetalle($idpe);

            if (sizeof($Pedet) > 0) {
                for ($i=0; $i < sizeof($Pedet); $i++){ 
                    $producto = $database -> getProdbyIdPrint($Pedet[$i]['idproducto']);

                    $talla = $database -> getTallasbyID($Pedet[$i]['idtalla']);

                    if ($talla[0]['talla'] == "" || $talla[0]['talla'] == "No aplica") {
                    	echo "<tr>
                            <td>".$Pedet[$i]['cantidad']."</td>
                            <td>".$producto[0]['nombre']."</td>
                            <td>".number_format($producto[0]['precio'], 2, ',', '.')."</td>
                            <td>".number_format($Pedet[$i]['totalP'], 2, ',', '.')."</td>
                        </tr>";
                    }else{
                    	echo "<tr>
                            <td>".$Pedet[$i]['cantidad']."</td>
                            <td>".$producto[0]['nombre'].". TALLA ".$talla[0]['talla']."</td>
                            <td>".number_format($producto[0]['precio'], 2, ',', '.')."</td>
                            <td>".number_format($Pedet[$i]['totalP'], 2, ',', '.')."</td>
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
    <div class="divti">
    <table>
        <tr style="width:255px;">
            <td><span style="font-size:12px;">CONDICIONES:</span>
	            <ul>
		            <li>
						<span style="font-size:11px;">Tiempo de entrega: 21 d&iacute;as h&aacute;biles, a partir de la colocación de la orden.</span>
		            </li>
					<li>
						<span style="font-size:11px;">Oferta v&aacute;lida: 8  días.</span>
		            </li>
	            </ul>
            </td>
        </tr>
    </table>

    </div>
</div>
    <div id="footer">
    </div>
    </page>