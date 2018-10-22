 
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="table table-wrapper table-responsive col-12">
            <div class="table-title">
              <div class="row">
                <div class="col-12 mx-auto"style="text-align:center;">
                  <h2><b>Pais de implementación</b></h2>
                </div>
                <br>
                <br>
                <br>
                <br>
              </div>
            </div>
            <br>
            <div class="container-fluid">
            <img class="glyph-icon " src="<?php base_url()?>/assets/icons/ "/>
            
				<div class="row">
					 
					<div class="col-12">
						<a class="btn btn-primary float-right" href="<?php echo base_url()?>pais/nuevoPais/">Registrar Pais</a>
					</div> 
				</div> 
			</div>
            <br>

             <?php  if($paises !== False) {  ?>
              <table class="table table-striped table-hover table-bordered" style="align-text:center;">
                    <thead class="text-center"> 
                      <tr>
                        <th>
                    Total= <?php echo $cant_pais; ?>                    
                        </th>
                        
                        <th>Pais</th>
                        <th>Ciudad-Capital</th>
                        <th>Moneda Local</th>
                        <th>Acciones</th>
                                      
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php 
                        foreach($paises as $value){
                      ?>
                        <tr>
                          <td>
                            <span class="custom-checkbox">
                              <!-- <input type="checkbox" id="checkbox1" name="options['<?php// echo $value->id ?>']" value="1"> -->
                              <!-- <label for="checkbox1"></label> -->
                            </span>
                            <?php echo $value->id; ?>
                          </td>
                          
                          <td>
                            <?php echo $value->pais; ?>
                          </td>
                          <td>
                            <?php echo $value->ciudad; ?>
                          </td>
                          <td>
                            <?php echo $value->moneda; ?>
                          </td>
                          <td>
                                            
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              Acciones
                            </button>
                            
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url()?>pais/editarPais/<?php echo $id= $value->id; ?>">  Editar  </a>
                                <a class="dropdown-item" href="<?php echo base_url()?>pais/borrarPais/<?php echo $id= $value->id; ?>">Eliminar</a>
                                <a class="dropdown-item" href="#">PDF</a>
                              </div>
                            
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
            <?php }else{ ?> 
              <div class="alert alert-warning  alert-dismissible fade show">
                <strong>Alerta!</strong>  <?php echo $alerta; ?>.
              </div>
            <?php 
              } 
            ?>
            <div class="row">
              <div class="col-3 float-center mx-auto ">
                <?php echo  $paginacion; ?>
              </div>
            </div> 
           
          </div>
        </div>
      </div>
    </div>

 