
<?php
 include_once("../include/session.php");
echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <link rel='stylesheet' href='../css/bootstrap.min.css'>";
    global $database, $form, $mailer; 
	
    $rep = $_GET['r'];
    if (isset($_GET['f1'])) {
        $f1 = $_GET['f1'];
    }

    if (isset($_GET['f2'])) {
        $f2 = $_GET['f2'];
    }


                ob_start();
				if ($rep == '1') {
					include('contentAllProd.php');
				}elseif ($rep == '2') {
					include('contentPP.php');
				}elseif ($rep == '3') {
					include('contentPedidos.php');
				}
              $content = ob_get_clean();
                // convert to PDF
                require_once('../pdf/html2pdf.class.php');
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

  
?>
