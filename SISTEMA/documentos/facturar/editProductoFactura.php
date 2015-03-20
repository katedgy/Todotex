<script type="text/javascript">
	

	
</script>

<?php
  include_once("../../include/session.php");
  global $database;
   		$id = $_REQUEST['idf'];


  	 	 if (isset($_REQUEST['link'])) {
  	 	 $d = $_REQUEST['link'];
  	 	 echo $d;
  	 	 }



		// include('../include/constants.php');

			$q = $database->getFacturabyIdFacturadetalle($id);
			$r = $database->getProdbyId($q[0]['idproducto']);
   			$talla=$database->getTallas();
		$validfd = $session->checkValueVar($form->value('idfd'),$q[0]['idfacturadetalle']);
		$validp = $session->checkValueVar($form->value('idprod'),$q[0]['idproducto']);
		$valnom = $session->checkValueVar($form->value('producto'),$r[0]['nombre']);
		$valpre = $session->checkValueVar($form->value('precio'),$r[0]['precio']);
		$valcan = $session->checkValueVar($form->value('cantidad'),$q[0]['cantidad']);
		$valtalla = $session->checkValueVar($form->value('talla'),$q[0]['talla']);

		if(sizeof($q)>0){
?>

				<div id="div-edit"> 
	        		<form name="frm_edit" id="frm_edit" class="frm_edit" action="" method="post">
<!-- 		                <input type="hidden" size="1" readonly="yes" name="idfd" id="idfd" value="<?php #echo $validfd;?>">
 -->		                <input type="hidden" size="1" readonly="yes" name="idprod" id="idproducto2" value="<?php echo $validp;?>">
		                <input type="hidden" size="1" readonly="yes" name="idf" id="idf" value="<?php echo $idF;?>">
		                <input type="hidden" size="1" readonly="yes" name="n" id="n" value="<?php echo $tipo;?>">

		                <h2 class="titulo">Editar Producto</h2>
						<br />
						<input class="form-control" placeholder="Producto" type="text" name="producto" id="producto2" value="<?php echo $valnom;?>"/>
		        		<input class="form-control" placeholder="Precio" type="text" name="precio" id="precio2" value="<?php echo $valpre;?>"/>
		        		<input class="form-control" placeholder="Cantidad" type="text" name="cantidad" id="cantidad" value="<?php echo $valcan;?>"/>
<!-- 		        		<input class="form-control" placeholder="Cantidad" type="text" name="talla" id="talla"/>
 -->
	 	        		<select class="form-control" name="talla" id="talla">
	 	        			<option id="talla" name="talla" value="<?php echo $valcan;?>"><?php echo $valcan;?></option>
			        		<?php
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
						    <fieldset id="loader1">
								<span>Espere un momento</span>
								<img src="../../images/loader.gif" style="margin-left: 10px;margin-top: 13px;width: 47px;">
							</fieldset>
					</form>
				</div>
<?php 
}
?>