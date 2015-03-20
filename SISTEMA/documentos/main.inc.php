<?php 

	$statusConexion=true;
	function consultaUsuarios($idF){
		global $database, $form, $mailer; 
		$salida='';

		$arrayName = $database->getFacturabyIdFacturadetalle($idF);
	        	
				if(sizeof($arrayName)>0)
				{
					for($j=0; $j<sizeof($arrayName); $j++)
		        		{
		        			$salida.='
		        				<tr>
		        					<td>'.$arrayName[$j]['idproducto'].'</td>
		        					<td>'.$arrayName[$j]['cantidad'].'</td>';
		        					$pro =$database->getProdbyId($arrayName[$j]['idproducto']);
				        			'<td>'.$pro[0]['nombre'].'</td>
				        			 <td>'.$arrayName[$j]['talla'].'</td>
				        			 <td>'.$pro[0]['precio'].'</td>
				        			 <td>AQUI EL TOTAL</td>
				        			 <td>eliminar y modificar</td>
		        			    </tr>';
	        		}
				}else{
					$salida='<tr>
					<td colspan="7">No ha elegido un producto a&uacute;n</td>
					</tr>';
				}

				return $salida;

	}


?>