<!DOCTYPE html>
<html lang="es">
<head>
        <!-- BOOTSTRAP 4 -->
        <!-- BOOTSTRAP 4 -->

        <!-- archivos externas y personalizados -->
        <!-- CSS -->
        <!-- se usa el base_url() para llegar a la raiz del sistema y acceder a las carpetas que se encuentran en ella -->
         
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <!--header para cada pagina-->
    <div id="header">
        <?php // echo $title ?>
    </div>
    <!--footer para cada pagina-->
    <img src="/assets/img/alien.jpg"style="width:45px;height:45px;">

    <h2>Provincias españolas con html2pdf.</h2>
    <table class="table  table-responsive table-hovered table-bordered">
        <thead style="background:red; width:100%;border 1px solid black; border-radius:15ps;">
            <tr>
                <th width="">Id</th>
                <th width="">PAis</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach($datos as $valores) { ?>
            <tr>
                <td width=""><?php echo $valores->id ?></td>
                <td width=""><?php echo $valores->pais ?></td>
             
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>