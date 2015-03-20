<?php 
 include_once("../include/session.php");
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
            <td rowspan="4"><img src='../images/cab.jpg' style='width:680px; height:130px;margin-top:35px;'></td>
            <td style='width:50px; '></td>
        </tr>
</table>
    <?php
    date("Y");
	date("m");
	date("d");
    ?>
 <span style='margin-left:575px;margin-top:15px;'>Fecha: <?php echo date("d - m - Y"); ?></span>



    <h2><span style='font-weight: bold; margin-left:350px;margin-top:5px;'>Reporte</span></h2>
    <h3><span style='font-weight: bold; margin-left:300;'>Facturas por cobrar</span></h3>


<!-- tabla productos -->
    <table style="margin-left:85px;margin-top:20px">
    <?php
    $getfac = $database ->getFacturaFecha($f1,$f2);
            if (sizeof($getfac)>0) {
    ?>
    <thead>

        <tr style="border-bottom: 1px solid black;">
            <th style="border-bottom: 1px solid black;width:60;"><span style='font-weight: bold;'>ID</span></th>
            <th style="border-bottom: 1px solid black;width:340px;"><span style='font-weight: bold;'>CLIENTE</span></th>
            <th style="border-bottom: 1px solid black;width:90px;"><span style='font-weight: bold;'><?php echo 'N° Orden'?></span></th>
            <th style="border-bottom: 1px solid black;width:90;"><span style='font-weight: bold;'>FECHA</span></th>
            <th style="border-bottom: 1px solid black;width:90;"><span style='font-weight: bold;'>TOTAL</span></th>
        </tr>
    </thead>
    <tbody>
    <?php	
		for ($i=0; $i < sizeof($getfac) ; $i++) { 
			$getcli = $database -> getClientesbyId($getfac[$i]['idcliente']);
				echo "<tr>
                    <td>".$getfac[$i]['idfactura']."</td>
                    <td>".$getcli[0]['nombre']."</td>
                    <td>".$getfac[$i]['Norden']."</td>
                    <td>".$getfac[$i]['fecha']."</td>
                    <td>".number_format($getfac[$i]['total'], 2, ',', '.')."</td>
              </tr>";
		}
    ?>
    </tbody>
        <?php
            }else
            {
                echo "<tr><td><h4>No existen registros para esa fecha. Elija otra fecha y vuelva a intentarlo</h4></td></tr>";
            }
        ?>
    </table>
    <!-- totalFACTURA -->

    <div class="divt">
    <table>
        <tr>
        </tr>

    </table>
    </div>
</div>
    </page>