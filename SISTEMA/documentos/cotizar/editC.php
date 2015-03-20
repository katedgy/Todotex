<?
  session_start();  
?>
<?php 
	$idc = $_REQUEST['idc'];
	include_once("../../include/session.php"); 
?>
	<!doctype html5>
	<html>
		<head>
		    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<title>Cotizar</title>
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
		$getInfoCot = $database->getCotizacionbyID($idc);
		$getInfoCli = $database->getClientesbyId($getInfoCot[0]['idcliente']);
		?>
		<div class="container">
			<div class="row ">
			<!-- Form emergente agregar producto -->
				<?php 
				include('addProdC.php'); 
				?>
			<!-- DATOS CLIENTE-->
			<br/>
	        <form name="cotizar" id="cotizar" action="../../process.php" method="post" >
        		<input type="hidden" size="1" readonly name="action" id="action" value="modifCot"/>
        		<input type="hidden" size="1" readonly name="idc" id="idc" value="<?php echo $idc; ?>"/>
				<?php
					$validcli = $session->checkValueVar($form->value('idcliente'),$getInfoCot[0]['idcliente']);
					$valnombre = $session->checkValueVar($form->value('nombre'),$getInfoCli[0]['nombre']);
					$valrif = $session->checkValueVar($form->value('rif'),$getInfoCli[0]['rif']);
					$valdirec = $session->checkValueVar($form->value('direc'),$getInfoCli[0]['direc']);
					$valtlf = $session->checkValueVar($form->value('tlf'),$getInfoCli[0]['tlf']);
					$valfecha= $session->checkValueVar($form->value('fecha'),$getInfoCot[0]['fecha']);
					$validatt = $session->checkValueVar($form->value('att'),$getInfoCot[0]['att']);
				?>
        		<input type="hidden" size="1" readonly name="idcliente" id="idcliente" value="<?php echo $validcli;?>"/>
            	<div class="panel panel-default">
					<div class="panel-heading"><h3>Cotizacion N°:000<?php echo $idc;?></h3></div>
						<br/>
						<div>
							<div class="col-md-4">
								<input class="form-control" placeholder="Nombre" type="text" name="nombre" id="nombre" value="<?php echo $valnombre;?>"/>
								<?php
									$errname = $form->error("nombre");
									if($errname!="")
									{
									echo '<span class="text-error-field">&nbsp;'.$errname.'&nbsp;&nbsp;&nbsp;</span>';
									}
				                 ?>
							</div>
					  		<div class="col-md-4">
								<input class="form-control" placeholder="RIF" type="text" name="rif" id="rif" value="<?php echo $valrif;?>"/>
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
									<input class="form-control" data-provide="datepicker" id="date" name="fecha" placeholder="Fecha" value="<?php echo $valfecha;?>"></input>
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
								<textarea class="form-control" placeholder="Direccion" name="direc" id="direc" rows="3" ><?php echo $valdirec; ?></textarea>
								<?php
									$errdirec = $form->error("direc");
									if($errdirec!="")
									{
									echo '<span class="text-error-field">&nbsp;'.$errdirec.'&nbsp;&nbsp;&nbsp;</span>';
									}
				                ?>
							</div>
							<div class="col-md-4">
								<input class="form-control" placeholder="telefono" type="text" name="tlf" id="tlf" value="<?php echo $valtlf;?>"/>
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
								<input class="form-control" placeholder="Att" type="text" name="att" id="att" value="<?php echo $validatt;?>"/>
								<?php
									$erratt = $form->error("att");
									if($erratt!="")
									{
									echo '<span class="text-error-field">&nbsp;'.$erratt.'&nbsp;&nbsp;&nbsp;</span>';
									}

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
				<div id="recargado" class="recargado"><?php include('consultaC.php');?></div>
				<br/>
				<div class="col-md-5 col-md-offset-7" >
				    <button id="imprimir" onclick="fnc2()" name="imprimir" class="im btn btn-default btn-lg" value="imprimir"><img src="../../images/print.png"/> Imprimir</button>
<!-- 				 <button id="mensaje" type="submit" name="imprimir" class="btn btn-default btn-lg" value="imprimir"><img src="../../images/print.png"/> Imprimir</button>
-->				    <button id="guardar" type="submit" name="guardar" class="ag btn btn-primary btn-lg" value="guardar"><img src="../../images/save.png"/> Guardar</button>
	                <button id="cancelar" type="submit" name="cancel" class="btn btn-warning btn-lg" value="cancel"><img src="../../images/cancel.png"/> Salir</button>

				</div>

			   <script type="text/javascript">

					function fnc2()
					{

						var idc = document.cotizar.idc.value;
					 	var idcli = document.cotizar.idcliente.value;
						var att = document.cotizar.att.value;
					 	var nombre = document.cotizar.nombre.value;
					 	var rif = document.cotizar.rif.value;
					 	var direc = document.cotizar.direc.value;
					 	var tlf = document.cotizar.tlf.value;
					 	var date = document.cotizar.fecha.value;
					 	var subt = document.cotizar.subt.value;
					 	var iva = document.cotizar.iva.value;
					 	var total = document.cotizar.total.value;

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

						window.open('imprimirC.php?nom='+ nombre+'&att='+ att+'&idcli='+ idcli+'&rif='+ rif+'&direc='+ direc+'&tlf='+ tlf+'&idc='+ idc+'&fecha='+ date+'&subt='+ subt+'&iva='+ iva+'&total='+ total);
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
		$item = $database->getCotizacionbyIdCotdetalle($idc);
			if (sizeof($item) == 0) {
				$it = 0;
			}
	?>
	<script>
		$(document).ready(function(){
			var it ='<?php echo $it; ?>';
			if (it == 0) {
				document.getElementById('imprimir').disabled=true;
				document.getElementById('guardar').disabled=true;
			};
		});
	</script>

		<script language="javascript">
			$(function(){
			  //CONFIGURAMOS EL FORM TIPO DIALOG
			  $('#div-frmc').dialog({
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
		    $('#div-frmc').dialog('open');//ABRIMOS EL FORMULARIO COMO TIPO DIALOG
		    $('#frm_userc input[type=text]').val('');//BORRAMOS TODOS LOS CAMPOS TIPO TEXT EN EL FORM
		    $('#talla option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT

		  });

		  $('#loader').hide();//OCULTAMOS EL LOADER

			function recargar(){		 	
				var tt = document.getElementById('talla');
			 	var talla = tt.options[tt.selectedIndex].text;
				idc=document.frm_userc.idc.value;
				idprod=document.frm_userc.idprod.value;
				producto=document.frm_userc.producto.value;
				pre=document.frm_userc.precio.value;
				cant=document.frm_userc.cantidad.value;
			 	idta=document.frm_userc.talla.value;
			 	
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
			 		var sinidtalla = document.frm_userc.talla.value; //valor de la talla -> .text
			 	};
			 	 
			    $.post("registroCot.php", {idcoti:idc,idp:idprod,name:producto,prec:pre,can:cant,idtalla:sinidtalla}, function(data){
			    /// Ponemos la respuesta de nuestro script en el DIV recargado
			    	$("#recargado").html(data);
    				$('#frm_userc input[type=text]').val('');//BORRAMOS TODOS LOS CAMPOS TIPO TEXT EN EL FORM
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
						idc='<?php echo $idc;?>';
						var x = this.value;//id factura detalle
					  	var p = $(this).parent();//parent de button eliminar (td)
					  	var q = $(p).parent();//parent de td (tr)
					  	var ur= "consultaC.php";
					  	var dataString = 'idd=' + x + '&idc=' + idc;
						if (x == '') {
							alert("Please Fill All Fields");
						}else {
							// AJAX code to submit form.
							$.ajax({
								type: "POST",
								url: "deleteProdC.php",
								data: dataString,
								cache: false,
								success: function(){
							        $(q).fadeOut("fast", function(){
									$(q).remove();//remover tr
									 $("#recargado").load("consultaC.php?idc=" + idc);   
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