				<div id="div-frmp"> 
	        		<form name="frm_userp" id="frm_user" action="" method="post">
		                <input type="hidden" size="1" readonly="yes" name="idprod" id="idproducto1">
		                <input type="hidden" size="1" readonly="yes" name="idpe" id="idpe" value="<?php echo $idpe;?>">

		                <h2 class="titulo">Agregar Producto</h2>
						<br />
						<input class="form-control" placeholder="Producto" type="text" name="producto" id="producto1" />
		        		<input class="form-control" disabled placeholder="Precio" type="text" name="precio" id="precio1" />
		        		<input class="form-control" placeholder="Cantidad" type="text" name="cantidad" id="cantidad" />

	 	        		<select class="form-control" name="talla" id="talla">
	 	        			<option id="talla" name="talla" value="Selecione una opcion">Selecione una opcion</option>
			        		<?php
			        			$talla=$database->getTallas();
			        			if (sizeof($talla)>0) {
			        				for ($i=0; $i < sizeof($talla); $i++) 
			        				{ ?>
			        					<option id="talla" name="talla" value="<?php echo $talla[$i]['idtalla']; ?>"><?php echo $talla[$i]['talla'];?></option>
			        			<?php }
			        			}
			        		?>
			        	</select>
						<br/>
					    <button type="button" id="myButton" class="btn btn-primary" onclick="javascript:recargar();">Agregar</button>
						    <fieldset id="loader">
								<span>Espere un momento</span>
								<img src="../../images/loader.gif" style="margin-left: 10px;margin-top: 13px;width: 47px;">
							</fieldset>
					</form>
				</div>