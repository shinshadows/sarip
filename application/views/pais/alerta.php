<?php  if ($this->session->flashdata('success')){?>
    <div class="col-12   mx-auto text-center alert alert-success  alert-dismissible  fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Info!</strong> <?= $this->session->flashdata('success');?>.
    </div>

<?php }
if ($this->session->flashdata('danger')){ ?>
    <div class="col-12   mx-auto text-center alert alert-danger  alert-dismissible  fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Alert!</strong> <?= $this->session->flashdata('danger');?>.

        
    </div>
        
     
<?php }  ?>