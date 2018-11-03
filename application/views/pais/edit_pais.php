<?php 
 
  
if (isset ($pais)){
	foreach($pais as $value){
 
  
 
 
	// se crean arrays asociativos para pasarle al orm los atributos que tiene cada elemento del formulario
		
		
		$input_id = array(
			'name'=> 'id',
			'class'=> 'badge badge-secondary form-control',
			'id'=> 'id_pais',
			'type'=> 'text',
			'value'=>  $value->id
		);
		$input_pais = array(
			'name'=> 'pais',
			'class'=> 'form-control',
			'id'=> 'pais',
			'type'=> 'text',
			'value'=> $value->pais
		);

		$input_ciudad = array(
			'name'=> 'ciudad',
			'class'=> 'form-control',
			'id'=> 'ciudad',
			'type'=> 'text',
			'value'=> $value->ciudad
		);
		$input_moneda = array(
			'name'=> 'moneda',
			'class'=> 'form-control',
			'id'=> 'mond',
			'type'=> 'text',
			'value'=> $value->moneda 
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

	}
 

?>



 

<h2><b><?php // echo $ayuda; ?></b></h2>

<div class="container-fluid">
	<div class="row">
		<div class="col-6 mx-auto card"> 
			<div class="card-body">

				<br>
				<br>
				
			 
				<?php // echo validation_errors('<div class="  alert alert-warning">', '</div>'); ?>
				 
				<br>
				<br>
				
				<!-- se abre el formulario usanndo el metodo del orm -->
				<?php echo form_open("pais/actualizarPais/".$value->id )?>

					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text ">
								<?php echo form_label('ID:','lbl_id')?>
							</span>
						</div>
						<?php echo form_input($input_id)?><br>
						<div class="badge badge-primary form-control"> <?php echo  $value->id ?><br></div>
						<!-- se muestra el input de acuerdo  con los atributos pasados por array -->
						
					 
					</div>
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

<?php 
	}else{

		if ($mensaje==true){?>
			<div class="alert alert-<?= $class; ?> text-center col-6 float mx-auto">
				
				<?= $mensaje; 
				
				header('Refresh:3; url= '. base_url().'pais'); //se redirecciona luego de 3 segundos			 
				?>
		
			</div>
			<br>
			<br>
	<?php } 
	} 
	?><!-- si se desea mostrar algun mensaje informativo se hace por aqui  -->
 

</body>
</html>
