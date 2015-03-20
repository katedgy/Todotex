

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cambiar status</h4>
      </div>
    <div class="modal-body">
    <form>
    <input type="text" name="DNI" id="DNI" value=""/>
		<select>
			<option name="seleccione">Seleccione la forma de pago</option>
			<option name="trans">Tranferencia</option>
			<option name="depo">Deposito</option>
			<option name="che">Cheque</option>
			<option name="efe">Efectivo</option>
		</select>
		<br>
		<br>
		<div class="input-append date">
			<input class="form-control datepicker" data-provide="datepicker" id="date" name="fecha" placeholder="Fecha de pago" value="<?php echo $form->value("fecha"); ?>"></input>
		</div>
	</form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
		<script type="text/javascript" charset="utf8" src="../js/bootstrap-datepicker.js"></script>
		<script src="../js/bootstrap-datepicker.es.js" charset="UTF-8"></script>
		<script type="text/javascript">
				$(document).ready(function(){
					$('#date').datepicker({
	                    format: "yyyy/mm/dd",
	                    languaje:"es"
	                })}).on(
					  'show', function() {			
						// Obtener valores actuales z-index de cada elemento
						var zIndexModal = $('#myModal').css('z-index');
						var zIndexFecha = $('#date').css('z-index');
					 
					        alert(zIndexModal + zIndexFEcha);
					});; 
				});
		</script>