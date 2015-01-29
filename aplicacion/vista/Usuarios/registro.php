
<div class="container">
    
    <form enctype="multipart/form-data"  class="form-horizontal" role="form" action="<?php echo URL . 'users/registrarse' ?>" id="form_registrarme" method="POST">
        <fieldset>
            <div class="form-group">
                <?php if (isset($error)) { ?>
                    <label class="col-md-4 " for="closer"></label>
                    <div class="col-md-4">
                        <div class="alert alert-danger">
                            <a href="#" id="closer" class="close" data-dismiss="alert">&times;</a>
                            <strong>Mensaje: </strong> <?php echo $error; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="exampleInputFile">Foto</label>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img  id="imag" src="<?php echo URL; ?>public/img/icon.png">
                    </div>
                    <input type="file" id="exampleInputFile" name="file" >
                </div>
            </div>
            
            
            <legend>Datos de usuario</legend>

            <div class="form-group">
                <label class="col-md-4 control-label" for="nombre">Nombre</label>  
                <div class="col-md-4">
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        $nombre = $_SESSION['user_name'];
                        echo '<input name="nombre" id="nombre" maxlength="20"  type="text" class="form-control input-md"  value="' . $nombre . '" readonly>';
                    } else {
                        echo '<input name="nombre" id="nombre" maxlength="20"  type="text" placeholder="Nombre" class="form-control input-md">';
                    }
                    ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="nombreUsuario">Nombre Usuario</label>  
                <div class="col-md-4">
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        $nombre = $_SESSION['user_name'];
                        echo '<input name="nombreUsuario" id="nombreUsuario" maxlength="25"  type="text" class="form-control input-md"  value="' . $nombre . '" readonly>';
                    } else {
                        echo '<input name="nombreUsuario" id="nombreUsuario" maxlength="25"  type="text" placeholder="Nombre" class="form-control input-md">';
                    }
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="fechaNacimiento">Fecha Nacimiento</label>
                <div class="col-md-4">
                    <input  class="form-control input-md" id="fechaNacimiento"  name="fechaNacimiento"  type="text" autocomplete="off">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="correo">Correo</label>  
                <div class="col-md-4">
                    <input  name="correoUsuario" id="correo" maxlength="50" name="textinput" type="email" placeholder="" class="form-control input-md">
                </div>
            </div>




            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Sexo</label>  
                <div class="col-md-4">
                    <select name='sexo' class='dropdown'>
                        <option  value="F">F</option>
                        <option value="M">M</option>
                    </select>
                    <!--input id="textinput" name="sexo" type="text" maxlength="20" placeholder="" class="form-control input-md">-->
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-4 control-label" for="pass">Password:</label>
                <div class="col-md-4">
                    <?php
                    echo '<input id="pass" name="password" type="password">';
                    ?>

                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="button1id"></label>
                <div class="col-md-8">
                    <a id="button1id" href="<?php echo URL; ?>" name="button1id" class="btn btn-danger">Cancelar</a>
                    <button id="button2id"  name="button2id" class="btn btn-success" type="submit">Enviar</button>
                </div>
            </div>

        </fieldset>
    </form>

</div>

<script>
    $.validator.setDefaults({
        submitHandler: function (form)
        {
            form.submit();
        }
    });

    $('#form_registrarme').validate(
            {
                rules:
                        {
                            fechaNacimiento:
                                    {
                                        required:true
                                    },
                            nombreUsuario:
                                    {
                                        required: true,
                                        minlength: 3//,
                                                //email:true
                                    },
                            correoUsuario:
                                    {
                                        required: true,
                                        minlength: 6,
                                        email: true
                                    },
                            password:
                                    {
                                        required: true,
                                        minlength: 6
                                    }
                        },
                messages:
                        {
                            fechaNacimiento:
                                    {
                                        required: "Ingrese una fecha valida"
                                    },
                            nombreUsuario:
                                    {
                                        required: "Ingrese su nombre de usuario",
                                        minlength: "Su nombre de usuario debe tener al menos 3 caracteres",
                                        email: "Ingrese un email válido"
                                    },
                            correoUsuario:
                                    {
                                        required: "Ingrese su correo de usuario",
                                        minlength: "Su nombre de usuario debe tener al menos 6 caracteres",
                                        email: "Ingrese un email válido"
                                    },
                            password:
                                    {
                                        required: "<br>Ingrese una contraseña válida",
                                        minlength: "Su contraseña debe tener al menos 2 caracteres"
                                    }
                        }
            });

    $(function () {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#exampleInputFile").change(function () {
            readURL(this);
        });
        $("#fechaNacimiento").datepicker({
            yearRange: "1960:2020",
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true});
    });
</script>