<?php
 include_once("../../include/session.php");
echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <link rel='stylesheet' href='../../css/bootstrap.min.css'>
";
    global $database, $form, $mailer; 

 $nombre = $_REQUEST['nom'];
 $idcli = $_GET['idcli'];
 $rif = $_REQUEST['rif'];
 $direc = $_REQUEST['direc'];
 $tlf = $_REQUEST['tlf'];
 $fecha = $_REQUEST['fecha'];
 $Norden = $_REQUEST['Norden'];
 $subt = $_REQUEST['subt'];
 $iva = $_REQUEST['iva'];
 $total = $_REQUEST['total'];
 $idpe = $_REQUEST['idpe'];
 $status= '3';
 $us =$_SESSION["usename"];
 $anul = 'no';
	if ($Norden== "") {
		$Norden = "No aplica";
	}
    $idus=$database -> getUser($us);
    $usuario= $idus[0]['iduser'];
    $Fact = $database -> getPedidobyID($idpe);

    if ($Fact){   
        $updateF = $database -> UpdPrintP($idpe,$idcli,$Norden,$fecha,$status,$subt,$iva,$total,$anul,$usuario);

            if ($updateF){
                ob_start();
                include('contenidoP.php');
                $content = ob_get_clean();
                // convert to PDF
                require_once('../../pdf/html2pdf.class.php');
                try
                {
                    $html2pdf = new HTML2PDF('P', 'letter', 'es', true, 'UTF-8', 0);
                    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
                     ob_end_clean();
                     $html2pdf->Output('exemple08.pdf');

                }
                catch(HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            }else{

                echo "error1";
            }
    }else{
        $addPed = $database->AddPedido($idpe,$idcli,$Norden,$fecha,$status,$subt,$iva,$total,$anul,$usuario);

            if ($addPed) {
                ob_start();
                include('contenidoP.php');
                $content = ob_get_clean();

                // convert to PDF
                require_once('../../pdf/html2pdf.class.php');
                try
                {
                    $html2pdf = new HTML2PDF('P', 'letter', 'es', true, 'UTF-8', 0);
                    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
                     ob_end_clean();
                     $html2pdf->Output('exemple08.pdf');

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
