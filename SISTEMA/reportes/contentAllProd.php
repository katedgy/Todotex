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
    <h3><span style='font-weight: bold; margin-left:300;'>Productos en inventario</span></h3>


<!-- tabla productos -->
    <table style="margin-left:85px;margin-top:20px">
    <thead>
        <tr style="border-bottom: 1px solid black;">
            <th style="border-bottom: 1px solid black;width:90;"><span style='font-weight: bold;'>ID</span></th>
            <th style="border-bottom: 1px solid black;width:350px;"><span style='font-weight: bold;'>PRODUCTO</span></th>
            <th style="border-bottom: 1px solid black;width:90;"><span style='font-weight: bold;'>P.U.</span></th>
            <th style="border-bottom: 1px solid black;width:90;"><span style='font-weight: bold;'>STOCK</span></th>
        </tr>
    </thead>
    <tbody>
    <?php

			$getinv = $database ->getProductos();
			if (sizeof($getinv)>0) {
				for ($i=0; $i < sizeof($getinv) ; $i++) { 
					if ($getinv[$i]['stock'] == "0") {
						echo "<tr>
		                    <td>".$getinv[$i]['idproducto']."</td>
		                    <td>".$getinv[$i]['nombre']."</td>
		                    <td>".number_format($getinv[$i]['precio'], 2, ',', '.')."</td>
		                    <td style='background:rgb(239, 192, 159);'>".$getinv[$i]['stock']."</td>
		                </tr>";
	  				}else{
		  				echo "<tr>
		                    <td>".$getinv[$i]['idproducto']."</td>
		                    <td>".$getinv[$i]['nombre']."</td>
		                    <td>".number_format($getinv[$i]['precio'], 2, ',', '.')."</td>
		                    <td style='background:rgb(153, 224, 153);'>".$getinv[$i]['stock']."</td>
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
        </tr>

    </table>
    </div>
</div>
    </page>