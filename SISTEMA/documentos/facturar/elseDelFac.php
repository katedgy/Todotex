<?php
			if ($tipo == "1"){
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: ../factura.php");
			}elseif ($tipo == "2"){
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: prov.php?f=2");
			}elseif ($tipo == "3"){
				$_SESSION ['error_array'] = $form->getErrorArray ();
				header( "Location: prod.php?f=2");
			}
			?>