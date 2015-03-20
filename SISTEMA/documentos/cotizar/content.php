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
    top:780px;
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
	height: 770px;
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
            <td rowspan="4"><img src='../../images/cab.jpg' style='width:680px; height:130px;margin-top:35px;'></td>
            <td style='width:50px; '></td>
        </tr>


    </table>
    <!-- DATOS CLIENTES -->
    <table style="margin-left:70px;">
        <tr>
            <td colspan="1"><span style='font-weight: bold; margin-left:475px;margin-top:35px;'><?php echo $fecha; ?></span></td>
        </tr>
        <tr>
            <td><span style=' font-weight: bold;'>Senores:</span></td>
        </tr>
        <tr>
            <td><span><?php echo $nombre; ?></span></td>
        </tr>
        <tr>
            <td><span style=' font-weight: bold;'>Presente.-</span></td>
        </tr>
        <?php
        	if ($att != "") { ?>
	        <tr>
	            <td colspan="1"><span style='font-weight: bold; margin-left:475px;'>Att: </span><span><?php echo $att; ?></span></td>
	        </tr>
        <?php
           	}
        ?>
        <tr>
            <td><span style='margin-top:35px;'>Nos es grato someter a su consideración, nuestra cotización de Uniformes, cuyas características y precios</span></td>
        </tr>
        <tr>
            <td><span>detallamos a continuación:</span></td>
        </tr>
    </table>
<!-- tabla productos -->
    <table style="margin-left:70px;margin-top:20px">
    <thead>
        <tr style="border-bottom: 1px solid black;">
            <th style="border-bottom: 1px solid black;width:90;"><span style='font-weight: bold;'>CANTIDAD</span></th>
            <th style="border-bottom: 1px solid black;width:350px;"><span style='font-weight: bold;'>DESCRIPCI&Oacute;N</span></th>
            <th style="border-bottom: 1px solid black;width:90;"><span style='font-weight: bold;'>P.U.</span></th>
            <th style="border-bottom: 1px solid black;width:90;"><span style='font-weight: bold;'>TOTAL</span></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $Cotdet = $database->getCotizacionbyIdCotdetalle($idc);

            if (sizeof($Cotdet) > 0) {
                for ($i=0; $i < sizeof($Cotdet); $i++){ 
                    $producto = $database -> getProdbyIdPrint($Cotdet[$i]['idproducto']);
                    $talla = $database -> getTallasbyID($Cotdet[$i]['idtalla']);

                    if ($talla[0]['talla'] == "" || $talla[0]['talla'] == "No aplica") {
                    	echo "<tr>
                            <td>".$Cotdet[$i]['cantidad']."</td>
                            <td>".$producto[0]['nombre']."</td>
                            <td>".number_format($producto[0]['precio'], 2, ',', '.')."</td>
                            <td>".number_format($Cotdet[$i]['totalP'], 2, ',', '.')."</td>
                        </tr>";
                    }else{
                    	echo "<tr>
                            <td>".$Cotdet[$i]['cantidad']."</td>
                            <td>".$producto[0]['nombre'].". TALLA ".$talla[0]['talla']."</td>
                            <td>".number_format($producto[0]['precio'], 2, ',', '.')."</td>
                            <td>".number_format($Cotdet[$i]['totalP'], 2, ',', '.')."</td>
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
	    <table>

		    <tr>
			    	    <td><span style="font-size:12px;margin-left:11px;">Atentamente</span></td>
			</tr>
			<tr>
			    <td><span style="font-size:12px;margin-top:38px;'">Jos&eacute; A. Rodr&iacute;guez</span></td>
			</tr>
		
		</table>
    </div>
    </page>