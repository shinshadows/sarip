<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo $titulo ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('estilos/estilos.css') ?>" />
	</head>
	
	<body>
		<div class="wrapper">
		<div id="formulario_login">
		<h2>Regístrate con nuestra librería</h2>
			
		<?php echo validation_errors(); ?>
		
		<?php echo $this->session->flashdata('existe') ? $this->session->flashdata('existe') : '' ?>	
		
		<?php echo form_open(base_url('login/registro_nuevo')) ?>
		
			<?php echo form_label('Email') ?>
			<?php echo form_input($campos['input_email']) ?>
			
			<?php echo form_label('Password') ?>
			<?php echo form_password($campos['input_password']) ?>
			
			<p id="captcha"><?php echo recaptcha_get_html($key) ?></p>
			
			<?php echo form_hidden('token', $token) ?>
			
			<?php echo form_submit('submit_registro', 'Registro') ?>
		
		<?php echo form_close() ?>
		</div>
		<?php echo anchor('../login','Login') ?>
	</div>
	</body>
</html>