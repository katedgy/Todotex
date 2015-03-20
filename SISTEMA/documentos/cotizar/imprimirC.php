
<?php
 include_once("../../include/session.php");
echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <link rel='stylesheet' href='../../css/bootstrap.min.css'>";
    global $database, $form, $mailer; 

 $nombre = $_REQUEST['nom'];
 $idcli = $_GET['idcli'];
 $att = $_GET['att'];
 $rif = $_REQUEST['rif'];
 $direc = $_REQUEST['direc'];
 $tlf = $_REQUEST['tlf'];
 $fecha = $_REQUEST['fecha'];
 $subt = $_REQUEST['subt'];
 $iva = $_REQUEST['iva'];
 $total = $_REQUEST['total'];
 $idc = $_REQUEST['idc'];
 $us =$_SESSION["usename"];

	if ($Norden== "") {
		$Norden = "No aplica";
	}
    $idus=$database -> getUser($us);
    $usuario= $idus[0]['iduser'];
    $cot = $database -> getCotizacionbyID($idc);

    if ($cot){   
        $updatec = $database -> UpdPrintCot($idc,$idcli,$att,$fecha,$subt,$iva,$total,$usuario);

            if ($updatec){
                ob_start();
                include('content.php');
                $content = ob_get_clean();
                // convert to PDF
                require_once('../../pdf/html2pdf.class.php');
                try
                {
                    $html2pdf = new HTML2PDF('P', 'letter', 'es', true, 'UTF-8', 0);
                    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
                     ob_end_clean();
                     $html2pdf->Output('Cotizacion.pdf');

                }
                catch(HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            }else{

                echo "error1";
            }
    }else{
        $addC = $database->AddCotizacion($idc,$idcli,$att,$fecha,$subt,$iva,$total,$usuario);

            if ($addC) {
                ob_start();
                include('content.php');
                $content = ob_get_clean();

                // convert to PDF
                require_once('../../pdf/html2pdf.class.php');
                try
                {
                    $html2pdf = new HTML2PDF('P', 'letter', 'es', true, 'UTF-8', 0);
                    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
                     ob_end_clean();
                     $html2pdf->Output('Cotizacion.pdf');

                }
                catch(HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            }else{

                echo "error2";
            }
    }
?>
