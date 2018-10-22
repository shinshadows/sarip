<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="margin:24px 0;">
  <a class="navbar-brand" href="<?php echo base_url();?>">Logo</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navb">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>.pais">Paises</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">Compañia</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">Empleados</a>
      </li>
      
    </ul>

    <li class="form-inline my-2 my-lg-0 nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light" href="#" id="navbardrop" data-toggle="dropdown">
            Iniciar Sesión
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">
            <form action="">
                <p>
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd">
                </div>
                </p>

                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>    

            </a>
            <br>
            <br>
            
            <a class="dropdown-item  text-center" href="#">Registrarme</a>
            <a class="dropdown-item  text-center" href="#">Ayuda</a>
        </div>
    </li>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="button">Search</button>
    </form>
     
    
     
  </div>
</nav>