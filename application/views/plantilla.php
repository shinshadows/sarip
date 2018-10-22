<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SARIP</title>
        <meta charset="utf-8">

        <!-- BOOTSTRAP 4 -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <!-- BOOTSTRAP 4 -->

        <!-- archivos externas y personalizados -->
          <!-- CSS -->
            <!-- se usa el base_url() para llegar a la raiz del sistema y acceder a las carpetas que se encuentran en ella -->
            <link rel="stylesheet" href="<?php base_url()?>/assets/css/components/main.css">
            <link rel="stylesheet" href="<?php base_url()?>/assets/css/components/navbar.css">
            <link rel="stylesheet" href="<?php base_url()?>/assets/css/components/topbar.css">
            <link rel="stylesheet" href="<?php base_url()?>/assets/css/components/header.css">
            <link rel="stylesheet" href="<?php base_url()?>/assets/css/components/sidebar-left.css">
            <link rel="stylesheet" href="<?php base_url()?>/assets/css/components/sidebar-right.css">
            <link rel="stylesheet" href="<?php base_url()?>/assets/css/components/footer.css">

            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

          <!-- CSS -->

        <!-- archivos externas y personalizados -->
      
    <style>

    .glyph-icon {
width:16px;
height:16px;
}
      
    </style>
    </head>
    <body class="">
        <?php 
            $this->load->view("components/topbar"); // muestro el contenido del topbar
            $this->load->view("components/navbar"); // muestro el contenido del navbar
        ?>
        <header class="  float-center text-center">
        <?php 
            $this->load->view("components/header"); //  se muestra el contenido del header
            $this->load->view("components/breadcrumbs"); // muestro el contenido del breadcrumbs
        ?>
        </header>
        <br>
        <div class="container-fluid ">
          <div class="row">
            <div class="col-12 ">
            
              <?php 
                // $this->load->view("components/sidebar-left"); //  se muestra el contenido del sidebar de la izquierda
                // $this->load->view("components/sidebar-right"); //  se muestra el contenido del sidebar de la derecha
                $this->load->view($content); //  se muestra el contenido de las vistas  //
              ?>

            </div>
          </div>
        </div>
        <br>
        <footer class="" style="bottom:0px;"> 
          <?php 
            $this->load->view("components/footer"); //  se muestra el contenido del footer
          ?>  
        </footer>
        
        <!--JAVASCRIPTS JQUERYS -->
          <script src="<?php base_url()?>/assets/js/components/sidebar-left.js" ></script>
        <!--JAVASCRIPTS JQUERYS -->
    </body>
</html>
