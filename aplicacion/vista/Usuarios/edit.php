<div class="container separar">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Editar
            </h1>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

            <form enctype="multipart/form-data" id="formularioEditar" method="post" action="<?php echo URL . 'users/guardar'?>" >
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-transform: uppercase;">
                            <?php echo $this->getNombre(); ?>
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> 
                                <img id="fotoPerfil" alt="User Pic" src="<?php echo URL . "public/imagenes/usuarios/" . $usuario->idUsuario . "x200.jpg"; ?>" class="img-circle img-miniatura"> 
                                <input type="file" name="file" id="boton" class="form-control">
                            </div>
                            <div class=" col-md-9 col-lg-9 "> 
                                <table class="table table-user-information">
                                    <tbody>
                                        <input name="id" value="<?php echo $usuario->idUsuario ?>" hidden>
                                        <tr>
                                            <td>Nombre:</td>
                                            <td> 
                                                <input id="nombre" name="nombre" class="form-control" type="text" value="<?php echo $usuario->nombre; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Correo Electr&oacute;nico:</td>
                                            <td>
                                                <input id="email" name="email" class="form-control" type="text" value="<?php echo $usuario->correo; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Contrase&ntilde;a:</td>
                                            <td><input id="pass"  name="pass" class="form-control" type="password" value="<?php echo $usuario->contrasena; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Sexo:</td>
                                            <td>
                                                <div class="ui-select">
                                                    <select id="sexo" name="sexo" class="form-control">
                                                        <option value="M">Masculino</option>
                                                        <option value="F">Femenino</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php if (!empty($usuario->rol)) { ?>
                                            <tr>
                                                <td>Rol:</td>
                                                <td><?php echo $usuario->rol; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <a id="descartar-cambios" data-original-title="Guardar Cambios" title="Guardar Cambios" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>
                        <span class="pull-right">
                            <a onclick="document.getElementById('formularioEditar').submit();" id="guardar-cambios" data-original-title="Cancelar" title="Cancelar" data-toggle="tooltip" type="button" class="btn btn-sm btn-success">
                                <i class="glyphicon glyphicon-ok"></i>
                            </a>
                        </span>
                    </div>

                </div>
        </div></form>
    </div>
</div>

<script type="text/javascript" >

    /*$('#guardar-cambios').click(function ()
     {
     var form = document.createElement("form");
     form.setAttribute("method", "post");
     form.setAttribute("action", "<?php echo URL; ?>users/guardar");
     var params = {nombre: $('#nombre').val(), email: $('#email').val(), pass: $('#pass').val(), sexo: $('#sexo').val()};
     for (var key in params) {
     if (params.hasOwnProperty(key)) {
     var hiddenField = document.createElement("input");
     hiddenField.setAttribute("type", "hidden");
     hiddenField.setAttribute("name", key);
     hiddenField.setAttribute("value", params[key]);
     
     form.appendChild(hiddenField);
     }
     }
     
     document.body.appendChild(form);
     form.submit();
     });*/

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#fotoPerfil').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#boton").change(function () {
        readURL(this);
    });

    $('#descartar-cambios').click(function ()
    {
        window.history.back()
    });
</script>