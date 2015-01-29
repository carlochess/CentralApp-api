
<div class="container">

    <form enctype="multipart/form-data"  class="form-horizontal" role="form" action="<?php echo URL . 'taxista/agregarTaxistaAlSistema' ?>" id="form_registrarme" method="POST">
        <div class="form-group">
            <label class="col-md-4 control-label" for="exampleInputFile">Foto</label>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img  id="imag" src="<?php echo URL; ?>public/imagenes/aaserver/logo.png">
                </div>
                <input type="file" id="exampleInputFile" name="file" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <legend>Fotos Usuario</legend>

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
                <?php
                $titulos = array("Foto Cedula", "Foto licencia condución",
                    "Fotos de tarjeta de propiedad", "Fotos de Carta autorización", "Foto pendón amarillo");
                $idGaleria = array("fotoCedula", "fotolicConducion", "fotoTPropiedad", "fotoCartaAutorizacion", "fotoPendon");
                ?>

                <?php for ($i = 0; $i < count($idGaleria); $i++) { ?>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="exampleInputFile"><?php echo $titulos[$i]; ?></label>
                        <div class="col-md-4">
                            <div id="galeria_<?php echo $idGaleria[$i]; ?>">
                                <div  class="thumbnail">
                                    <img  src="<?php echo URL; ?>public/imagenes/aaserver/logo.png">
                                </div>
                            </div>
                            <input type="file" id="boton_<?php echo $idGaleria[$i]; ?>" name="<?php echo $idGaleria[$i]; ?>[]" multiple />
                        </div>
                    </div>
                <?php } ?>                
            </div>
            <div class="col-md-8">

                <legend>Datos de usuario</legend>
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nombre">Nombre</label>  
                        <div class="col-md-4">
                            <input name="nombre" id="nombre" maxlength="20"  type="text" placeholder="Nombre" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nombre">Apellidos</label>  
                        <div class="col-md-4">
                            <input name="apellidos" id="apellidos" maxlength="40"  type="text" placeholder="Apellidos" class="form-control input-md">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nombreUsuario">Nombre Usuario</label>  
                        <div class="col-md-4">
                            <input name="nombreUsuario" id="nombreUsuario" maxlength="25"  type="text" placeholder="Nombre" class="form-control input-md">
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
                        <label class="col-md-4 control-label" for="correo">Cedula</label>  
                        <div class="col-md-4">
                            <input  name="cedula" id="cedula" maxlength="50" name="textinput" type="text" placeholder="" class="form-control input-md">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="correo">Telefono</label>  
                        <div class="col-md-4">
                            <input  name="telefono" id="telefono" maxlength="50" name="textinput" type="text" placeholder="" class="form-control input-md">
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
                            <input id="pass" name="password" type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pass">Repetir password:</label>
                        <div class="col-md-4">
                            <input id="passRep" type="password">
                        </div>
                    </div>

                    <!-- Button (Double) -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="button1id"></label>
                        <div class="col-md-8">
                            <button id="button2id"  name="button2id" class="btn btn-success" type="submit">Registrar</button>
                        </div>
                    </div>

                </fieldset>
            </div>
    </form>

</div>

<script>
    $.validator.setDefaults({
        submitHandler: function (form)
        {
            form.submit();
        }
    });
    /*
     $('#form_registrarme').validate(
     {
     rules:
     {
     fechaNacimiento:
     {
     required: true
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
     */
    $(function () {
        function readURL(input, idP) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(idP).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#exampleInputFile").change(function () {
            readURL(this, "#imag");
        });

<?php for ($i = 0; $i < count($idGaleria); $i++) { ?>
            $("#boton_<?php echo $idGaleria[$i]; ?>").change(function () {
                for (var i = 0; i < this.files.length; i++) {
                    $('#galeria_<?php echo $idGaleria[$i]; ?>').empty();
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#galeria_<?php echo $idGaleria[$i]; ?>').append('<div class="thumbnail"><img class="imag" src="' + e.target.result + '" /></div>');
                        console.log(e.target.result);
                    }
                    reader.readAsDataURL(this.files[i]);
                }
            });
<?php } ?>
        $("#fechaNacimiento").datepicker({
            yearRange: "1960:2020",
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true});
    });
</script>
<!--