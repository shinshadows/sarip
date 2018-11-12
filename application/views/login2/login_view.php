<?php
 $username = array('name' => 'username', 'placeholder' => 'nombre de usuario');
 $password = array('name' => 'password', 'placeholder' => 'introduce tu password');
 $submit = array('name' => 'submit', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión');
 ?>
 <div class="container_12">
 <h1>Formulario de login con varios perfiles de usuario</h1>
 <div class="grid_12" id="login">
    <div class="grid_8 push_2" id="formulario_login">
        <div class="grid_6 push_1" id="campos_login">
            <?=form_open(base_url().'login/new_user')?>
                <label for="username">Nombre de usuario:</label>
            <?=form_input($username)?><p><?=form_error('username')?></p>
                <label for="password">Introduce tu password:</label>
            <?=form_password($password)?><p><?=form_error('password')?></p>
            <?=form_hidden('token',$token)?>
            <?=form_submit($submit)?>
            <?=form_close()?>
            <?php 
                if($this->session->flashdata('usuario_incorrecto')){
            ?>
                    <p><?=$this->session->flashdata('usuario_incorrecto')?></p>
            <?php
                }
            ?>
        </div>
        </div>
    </div>
 </div>