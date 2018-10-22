<?php 
// se crean arrays asociativos para pasarle al orm los atributos que tiene cada elemento del formulario
	$input_pais = array(
		'name'=> 'pais',
		'class'=> 'form-control',
		'id'=> 'pais',
		'type'=> 'text',
		'placeholder'=> 'ingrese el pais...'
	);

	$input_ciudad = array(
		'name'=> 'ciudad',
		'class'=> 'form-control',
		'id'=> 'ciudad',
		'type'=> 'text',
		'placeholder'=> 'ingrese la ciudad...'
	);
	$input_moneda = array(
		'name'=> 'moneda',
		'class'=> 'form-control',
		'id'=> 'mond',
		'type'=> 'text',
		'placeholder'=> 'ingrese la moneda...'
	);

	$btn_send = array(
		'name'=> 'submit',
		'class'=> 'btn btn-success',
		'id'=> 'submit',
		'type'=> 'submit',
		'value'=> 'Enviar'
	);

	

	$btn_reset = array(
		'name'=> 'reset',
		'class'=> 'btn btn-danger',
		'id'=> 'reset',
		'type'=> 'reset',
		'value'=> 'Cancelar'
	);

?>



<h1>llegando al formulario con helper</h1>

<h2><b><?php  echo $ayuda; ?></b></h2>

<div class="container-fluid">
	<div class="row">
		<div class="col-6 mx-auto card"> 
			<div class="card-body">

				<br>
				<br>
				 <!-- se muestra los errores generados  -->
				<?php  echo validation_errors('<div class="  alert alert-warning">', '</div>'); ?>
				 
				<br>
				<br>
				
				<!-- se abre el formulario usanndo el metodo del orm -->
				<?php echo form_open("pais/recibirDatos")?>

					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text ">
								<?php echo form_label('Pais:','lbl_pais')?>
							</span>
						</div>
						<!-- se muestra el input de acuerdo  con los atributos pasados por array -->
						<?php echo form_input($input_pais)?><br>
												
					</div>
				 
					
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text  ">
								<?php echo form_label('Ciudad:','lbl_ciudad')?> 
							</span>
						</div>
						<?php echo form_input($input_ciudad)?><br>
						
					</div>
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text  ">
								<?php echo form_label('Moneda:','lbl_moneda')?> 
							</span>
						</div>
						<?php echo form_input($input_moneda)?><br>
						
					</div>
					 

				
					<div class="form-group float-right">
						<label class="col-md-12 control-label" for="submit"></label>
						<div class="col-md-12">
							<?php echo form_submit($btn_send)?> 
							<?php echo form_submit($btn_reset)?> 
						</div>
					</div> 
				<?php echo form_close()?>

			</div>
		</div>
	</div>
</div>

</body>
</html>
