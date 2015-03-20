<?
  session_start();  

?>
<?php 
	$idpe = $_REQUEST['idp'];
	include_once("../../include/session.php"); 
?>

	<!doctype html5>
	<html>

		<head>
		    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

			<title>Pedido</title>
			<link rel="stylesheet" type="text/css" href="../../css/main.css">
			<link rel="stylesheet" href="../../css/log.css">

			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="../../css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="../../css/datatables.css">

			<link href="../../css/jquery-ui.css" type="text/css" rel="stylesheet"/>
			<link href="../../css/datepicker.css" type="text/css" rel="stylesheet"/>

		</head>
	<body>
	 	
	 	<?php include("header.php"); 

		?>


		<div class="container">

			<div class="row ">
			<!-- Form emergente agregar producto -->
				<?php 
				include('addProdP.php'); 
				?>
<!-- 				<?php #include('editProductoFactura.php'); ?>
 -->
						<!-- DATOS CLIENTE-->
				<br/>
				       
	        <form name="pedido" id="pedido" action="../../process.php" method="post" >
        		<input type="hidden" size="1" readonly name="action" id="action" value="pedido"/>
        		<input type="hidden" size="1" readonly name="idpe" id="idpe" value="<?php echo $idpe; ?>"/>

        		<input type="hidden" size="1" readonly name="idcliente" id="idcliente" value="<?php echo $form->value("idcliente"); ?>"/>
            	<div class="panel panel-default">
					<div class="panel-heading"><h3>Pedido</h3></div>
						<br/>
						<div>
							<div class="col-md-4">
								<input class="form-control" placeholder="Nombre" type="text" name="nombre" id="nombre" value="<?php echo $form->value("nombre"); ?>"/>
								<?php
									$errname = $form->error("nombre");
									if($errname!="")
									{
									echo '<span class="text-error-field">&nbsp;'.$errname.'&nbsp;&nbsp;&nbsp;</span>';
									}
				                 ?>
							</div>
					  		<div class="col-md-4">
								<input class="form-control" placeholder="RIF" type="text" name="rif" id="rif" value="<?php echo $form->value("rif"); ?>"/>
								<?php
									$errrif = $form->error("rif");
									if($errrif!="")
									{
									echo '<span class="text-error-field">&nbsp;'.$errrif.'&nbsp;&nbsp;&nbsp;</span>';
									}
				                ?>
							</div>
							<div class="col-md-4">
								<div class="input-append date">
									<input class="form-control" data-provide="datepicker" id="date" name="fecha" placeholder="Fecha" value="<?php echo $form->value("fecha"); ?>"></input>
								</div>
								<?php
									$errfecha = $form->error("fecha");
									if($errfecha!="")
									{
									echo '<span class="text-error-field">&nbsp;'.$errfecha.'&nbsp;&nbsp;&nbsp;</span>';
									}
				                ?>
							</div>
						</div>
						<div class="row2">
							<div class="col-md-4">
								<textarea class="form-control" placeholder="Direccion" name="direc" id="direc" rows="3" ><?php echo $form->value("direc"); ?></textarea>
								<?php
									$errdirec = $form->error("direc");
									if($errdirec!="")
									{
									echo '<span class="text-error-field">&nbsp;'.$errdirec.'&nbsp;&nbsp;&nbsp;</span>';
									}
				                ?>
							</div>
							<div class="col-md-4">
								<input class="form-control" placeholder="telefono" type="text" name="tlf" id="tlf" value="<?php echo $form->value("tlf"); ?>"/>
								<?php
									$errtlf = $form->error("tlf");
									if($errtlf!="")
									{
									echo '<span class="text-error-field">&nbsp;'.$errtlf.'&nbsp;&nbsp;&nbsp;</span>';
									}
				                ?>
							</div>
							<br/><br/>
							<div class="col-md-4">
								<input class="form-control" placeholder="N° de orden de compra" type="text" name="Norden" id="Norden" value="<?php echo $form->value("Norden"); ?>"/>
								<?php
									$errNorden = $form->error("Norden");
									if($errNorden!="")
									{
									echo '<span class="text-error-field">&nbsp;'.$errNorden.'&nbsp;&nbsp;&nbsp;</span>';
									}
				                ?>
								<?php
									$errcou = $form->error("subt");
									if($errcou!="")
									{
									echo '<span class="text-error-field">&nbsp;'.$errcou.'&nbsp;&nbsp;&nbsp;</span>';
									}
				                ?>
							</div>
						</div>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
				</div>

				<!-- FIN DATOS DEL CLIENTE -->
				<!-- BOTON AGREGAR PRODUCTOS -->
			 	<div id="div-agregar" class="col-md-2 col-md-offset-10">
					<button id="agregar" type="button" name="agregar" class="btn btn-default" style="margin-top: 10px;margin-bottom: 10px;">
	 	  			<img src="../../images/addpro.png">Agregar producto</button>
		 	  	</div>
				<!-- FIN BOTON AGREGAR PRODUCTOS -->
				<br/>
				<br/>
				<br/>
                <br/>
				<br/>
		 	  	<!-- Tabla productos -->
				<div id="recargado" class="recargado"><?php include('consultaP.php');?></div>

<!--         		<input type="hidden" size="1" readonly="yes" name="iva" id="action" value="<?php //echo $iva; ?>"/>
        		<input type="hidden" size="1" readonly="yes" name="subt" id="action" value="<?php //echo $t; ?>"/>
        		<input type="hidden" size="1" readonly="yes" name="total" id="action" value="<?php //echo $all; ?>"/> -->

				<!-- FIN tabla productos -->

<!-- 			<button type="button" id="target" class="add" onClick="clickMe();">Add</button>
				<div id="output">1</div> -->
						<br/>
			
				<div class="col-md-5 col-md-offset-7" >
				    <button id="imprimir" onclick="fnc1()" name="imprimir" class="im btn btn-default btn-lg" value="imprimir"><img src="../../images/print.png"/> Imprimir</button>
<!-- 				 <button id="mensaje" type="submit" name="imprimir" class="btn btn-default btn-lg" value="imprimir"><img src="../../images/print.png"/> Imprimir</button>
-->				    <button id="guardar" type="submit" name="guardar" class="ag btn btn-primary btn-lg" value="guardar"><img src="../../images/save.png"/> Guardar</button>
	                <button id="cancelar" type="submit" name="cancel" class="btn btn-warning btn-lg" value="cancel"><img src="../../images/cancel.png"/> Salir </button>
				</div>


			   <script type="text/javascript">
					function fnc1()
					{
					    var a=window.location.href;
					 	var idcli = document.pedido.idcliente.value;
					 	var nombre = document.pedido.nombre.value;
					 	var rif = document.pedido.rif.value;
					 	var direc = document.pedido.direc.value;
					 	var tlf = document.pedido.tlf.value;
					 	var idpe = document.pedido.idpe.value;
					 	var date = document.pedido.fecha.value;
					 	var subt = document.pedido.subt.value;
					 	var iva = document.pedido.iva.value;
					 	var total = document.pedido.total.value;
					 	var Norden = document.pedido.Norden.value;

					 	if (nombre == "") {
					 		alert("Debe escribir el nombre del cliente");
					 		return false;
					 	};

					 	if (rif == "") {
					 		alert("Debe escribir el rif del cliente");
					 		return false;
					 	};

					 	if (direc == "") {
					 		alert("Debe escribir la direccion del cliente");
					 		return false;
					 	};

					 	if (tlf == "") {
					 		alert("Debe escribir el telefono del cliente");
					 		return false;
					 	};
					 	if (date == "") {
					 		alert("Debe elegir la fecha de la factura");
					 		return false;
					 	};

						window.open('imprimirP.php?nom='+ nombre+'&idcli='+ idcli+'&rif='+ rif+'&direc='+ direc+'&tlf='+ tlf+'&idpe='+ idpe+'&fecha='+ date+'&subt='+ subt+'&iva='+ iva+'&total='+ total+'&Norden='+ Norden);
						
					}

				</script>
			</form>
			</div>
		</div>
	<br/>
	<br/>
			<!-- jQuery -->
			<!--<script type="text/javascript" src="../js/jquery.js"></script>-->
			<script type="text/javascript" src="../../js/jquery.min.js"></script>
			<script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
			<script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>
			<script type="text/javascript" src="../../js/jquery-1.11.0.min.js"></script>
			<script type="text/javascript" src="../../jquery-ui-1.10.3.custom/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
			<!-- bootstrap -->
			<script type="text/javascript" charset="utf8" src="../../js/bootstrap.min.js"></script>
			<script type="text/javascript" charset="utf8" src="../../js/bootstrap-datepicker.js"></script>
			<script src="../../js/bootstrap-datepicker.es.js" charset="UTF-8"></script>
			<!-- DataTables -->
			<script src="../../js/dataTables.bootstrap.js"></script>
	<?php
		$item = $database->getPedidobyIdpedetalle($idpe);
			if (sizeof($item) == 0) {
				$it = 0;
			}
	?>
	<script>
		$(document).ready(function(){
			var it ='<?php echo $it; ?>'
			if (it == 0) {
				document.getElementById('imprimir').disabled=true;
				document.getElementById('guardar').disabled=true;
			};
		});
	</script>

		<script language="javascript">
			$(function(){
			  //CONFIGURAMOS EL FORM TIPO DIALOG
			  $('#div-frmp').dialog({
			    autoOpen:false,//ESTABLECEMOS PARA QUE NO SE ABRA SOLO CUANDO SE CARGUE LA PAGINA
			    modal:true,//BLOQUEAMOS OTRA ACCION MIENTRAS EL FORM ESTE ABIERTO
			    title:'Producto',//TITULO EN EL FORM
			    width:300,//TAMAÑO DEL FORM
			    height:400,
			    show:{
			      effect:"clip",
			      duration:800
			      },
			    hide:{
			      effect:"clip",
			      duration:800
			      }
			  });
			});

		  //CUANDO PRESIONAMOS EL BOTON AGREGAR MOSTRAMOS EL FORMULARIO producto
		  $('#agregar').on('click',function(){
		    $('#div-frmp').dialog('open');//ABRIMOS EL FORMULARIO COMO TIPO DIALOG
		    $('#frm_userp input[type=text]').val('');//BORRAMOS TODOS LOS CAMPOS TIPO TEXT EN EL FORM
		    $('#talla option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT

		  });

		  $('#loader').hide();//OCULTAMOS EL LOADER

			function recargar(){		 	
				var tt = document.getElementById('talla');
			 	var talla = tt.options[tt.selectedIndex].text;
				idpe=document.frm_userp.idpe.value;
				idprod=document.frm_userp.idprod.value;
				producto=document.frm_userp.producto.value;
				pre=document.frm_userp.precio.value;
				cant=document.frm_userp.cantidad.value;
			 	idta=document.frm_userp.talla.value;
			 	
			 	if (producto == "") {
			 		alert("Debe escribir el nombre del producto");
			 		return false;
			 	};
			 	if (pre == "") {
			 		alert("Debe escribir el precio del producto");
			 		return false;
			 	};

			 	if (cant == "") {
			 		alert("Debe escribir la cantidad");
			 		return false;
			 	};

			 	if (idta == "" || talla== "" || talla== "Selecione una opcion") {
			 		alert("Debe elegir la talla. De no poseer elija 'No aplica'");
			 		return false;
			 	}else{
			 		var sintalla = tt.options[tt.selectedIndex].text; //valor de la talla -> .text
			 		var sinidtalla = document.frm_userp.talla.value; //valor de la talla -> .text
			 	};
			 	 
			    $.post("registroPed.php", {idpe:idpe,idp:idprod,name:producto,prec:pre,can:cant,idtalla:sinidtalla}, function(data){
			    /// Ponemos la respuesta de nuestro script en el DIV recargado
			    	$("#recargado").html(data);
    				$('#frm_userp input[type=text]').val('');//BORRAMOS TODOS LOS CAMPOS TIPO TEXT EN EL FORM
    				$('#talla option').each(function(i, tt)
					{
					   tt.selected = false
					});
          			$('#loader').hide();//OCULTAMOS EL LOADER
					document.getElementById('imprimir').disabled=false;
					document.getElementById('guardar').disabled=false;
			    });         
			}

				$(document).ready(function(){
					$('#date').datepicker({
	                    format: "yyyy/mm/dd",
	                    languaje:"es"
	                }); 
				});
				
				$(function(){
					$(document).on("click",".a",function(){
						idpe='<?php echo $idpe;?>';
						var x = this.value;//id factura detalle
					  	var p = $(this).parent();//parent de button eliminar (td)
					  	var q = $(p).parent();//parent de td (tr)
					  	var ur= "consultaP.php";
					  	var dataString = 'idd=' + x + '&idpe=' + idpe;
						if (x == '') {
							alert("Please Fill All Fields");
						}else {
							// AJAX code to submit form.
							$.ajax({
								type: "POST",
								url: "deleteProdP.php",
								data: dataString,
								cache: false,
								success: function(){
							        $(q).fadeOut("fast", function(){
									$(q).remove();//remover tr
									 $("#recargado").load("consultaP.php?idpe=" + idpe);   
						        })
								}
							});
						}
						return false;
					});
				});
		</script>
		<script type="text/javascript">
			$(document).ready(function ($){
				$('#target').click(function() {
			    $('#output').html(function(i, val) { return val*1+1 });
				});

				// autcompletar
				    $("#nombre").autocomplete({
				        source: "../buscarcli.php",
				        minLength: 1
				    });
				 
				    $("#nombre").focusout(function(){
				        $.ajax({
				            url:'../cli.php',
				            type:'POST',
				            dataType:'json',
				            data:{nombre:$('#nombre').val()}
				        }).done(function(respuesta){
				            $("#idcliente").val(respuesta.idcliente);
				            $("#rif").val(respuesta.rif);
				            $("#direc").val(respuesta.direc);
				            $("#tlf").val(respuesta.tlf);
					    });
					});
				    
					$("#producto1").autocomplete({
				        source: "../buscarprod.php",
				        minLength: 1
				    });
				 
				    $("#producto1").focusout(function(){
				        $.ajax({
				            url:'../product.php',
				            type:'POST',
				            dataType:'json',
				            data:{producto:$('#producto1').val()}
				        }).done(function(respuesta){
				            $("#idproducto1").val(respuesta.idproducto);
				            $("#precio1").val(respuesta.precio);
					    });
					});

					$("#producto1").autocomplete({
				        source: "../buscarprod.php",
				        minLength: 1
				    });
				 
				    $("#producto1").focusout(function(){
				        $.ajax({
				            url:'../product.php',
				            type:'POST',
				            dataType:'json',
				            data:{producto:$('#producto1').val()}
				        }).done(function(respuesta){
				            $("#idproducto1").val(respuesta.idproducto);
				            $("#precio1").val(respuesta.precio);
					    });
					});

					$("#producto2").autocomplete({
				        source: "../buscarprod.php",
				        minLength: 1
				    });
				 
				    $("#producto2").focusout(function(){
				        $.ajax({
				            url:'../product.php',
				            type:'POST',
				            dataType:'json',
				            data:{producto:$('#producto2').val()}
				        }).done(function(respuesta){
				            $("#idproducto2").val(respuesta.idproducto);
				            $("#precio2").val(respuesta.precio);
					    });
					});
				
				// autcompletar  

			});

	    </script>
	</body>
</html>