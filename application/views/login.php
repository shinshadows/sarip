<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo $titulo ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('estilos/estilos.css') ?>" />
	<style>
    body{
	background: #22272b;
}
.wrapper {
	width: 500px;
	margin: 0 auto;
	background: #c21b1c;
	color: #333;
	border: 5px solid #fff;
	border-radius: 5px;
}
h2{
	color: #c21b1c;
	font-size: 22px;
}
#email, #password {
	padding: 5px 2px;
	width: 300px;
	border-radius: 6px;
	background: #25242a;
	color: #fff;
}
label {
	display: block;
}
.wrapper #formulario_login {
	padding: 40px 60px;
	background: #111111;
}
a {
	color: #fff;
	text-decoration: none;
	padding: 5px;
}
input[type=submit] {
	padding: 4px 30px;
	border-radius: 5px;
	background: #3095f1;
	color: #fff;
}

#captcha{
	margin: 10px 0px;
}
    
    </style>
    
    
    </head>
	
	<body>
	<div class="wrapper">
		<div id="formulario_login">
			<h2>Login codeigniter con nuestra librería</h2>
			
			<p id="sesion_cerrada">
				<?php echo $this->session->flashdata('cerrada') !== FALSE ? $this->session->flashdata('cerrada') : '' ?>
			</p>
			
			<div id="errores_formulario"><?php echo validation_errors(); ?></div>
			
			<p id="error_login">
				<?php echo $this->session->flashdata('noexiste') ? $this->session->flashdata('noexiste') : '' ?>	
			</p>
			
			
				<?php echo form_open(base_url('login/user_login')) ?>
				
					<?php echo form_label('Email') ?>
					<?php echo form_input($campos['input_email']) ?>
					
					<?php echo form_label('Password') ?>
					<?php echo form_password($campos['input_password']) ?><br />
					
					<?php echo form_hidden('token', $token) ?>
					
					<?php echo form_submit('submit', 'Login') ?>
				
				<?php echo form_close() ?>
		</div>
		
		<?php echo anchor('../login/registro','Registrarme') ?>
	</div>
	</body>
</html>