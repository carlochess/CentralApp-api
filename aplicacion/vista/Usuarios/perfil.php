<div class="container separar">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Perfil
            </h1>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
            

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-transform: uppercase;">
                        <?php 
                        if(!$pPublico)
                            echo $this->getNombre(); 
                        else
                            echo $usuario->nombre;
                        ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            <?php if(!$pPublico)
                                        echo '<img alt="User Pic" src="'.$this->getUserImage(200).'" class="img-circle img-miniatura">';
                                    else 
                                        echo '<img alt="User Pic" src="'.file_get_contents(URL."imagen/getUserImage/".$usuario->idUsuario."/200").'" class="img-circle img-miniatura">';
                            ?>
                        </div>
                        <div class="col-xs-9 col-md-9 col-lg-9 table-responsive"> 
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td><?php echo $usuario->nombreReal; ?></td>
                                    </tr>
                                    <tr>
                                        <td>E-mail:</td>
                                        <td><?php echo $usuario->correo; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Sexo:</td>
                                        <td><?php echo $usuario->sexo; ?></td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>Rol:</td>
                                        <td><?php echo $usuario->rol; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <?php if(!$pPublico){ ?>
                    <a href="<?php echo URL ?>users/edit" data-original-title="Editar" title="Editar" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    <span class="pull-right">
                        <a href="<?php echo URL ?>users/remove.html" data-original-title="Eliminar" title="Eliminar" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>
                    </span>
                    <?php $pPublico=false; } ?>
                </div>

            </div>
        </div>
    </div>
</div>