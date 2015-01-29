<!-- Modal -->
<div class="modal fade  bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Agregar</h4>
            </div>
            <div class="modal-body">
                <div id="agregar">
                    <div class="thumbnail">
                        <img  id="imag" src="<?php echo URL; ?>public/img/icon.png">
                    </div>

                    <form enctype="multipart/form-data" action="<?php echo URL . 'convocatoria/agregarConvocatoria' ?>" method="POST" id="formulario" data-toggle="validator" role="form">
                        <div class="form-group">
                            <label for="exampleInputFile">Foto</label>
                            <input type="file" name="file">
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="control-label">Titulo</label>
                            <input type="text" class="form-control" data-minlength="2" id="titulo"placeholder="Ingresa un titulo" name="titulo" maxlength="30" value="Hola" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha de inicio</label>
                            <input class="form-control" id="fechaInicial" placeholder="Ingresa la fecha de inicio" name="fechaInicial" value="2014-05-10" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Fecha de Finalizacion</label>
                            <input  class="form-control" id="fechaFinalizacion" placeholder="Ingresa la fecha de finalización" name="fechaFinalizacion" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Descripcion</label>
                            <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Ingresa una descripcion" value="Nada que ver"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default" id="boton">Agregar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">

    </div>
</div> <!--Fin Modal-->

<!--Modal para agregar expertos-->
<div class="modal fade  bs-example-modal-lg" id="modalExpertos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Agregar Experto</h4>
            </div>
            <div class="modal-body">

                <ul class="nav nav-tabs" id="tabContent">
                    <li class="active"><a href="#agregarform" data-toggle="tab">Agregar</a></li>
                    <li><a href="#crear" data-toggle="tab">Crear y Agregar</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="agregarform">
                        <form method="post" action="<?php echo URL ?>experto/agregarExperto">
                            <div>
                                <br/>
                                Escribe el nombre de un usuario existente (solo uno):
                                <input type="text" name="expertos" onkeyup="showHint(this.value)">
                                <input type="text" id="idS" name="idConvocatoria" hidden>
                                <p>Sugerencias: <span id="txtHint"></span></p>
                                <input type="submit" value="Enviar">
                            </div>
                        </form> 
                    </div>
                    <div class="tab-pane" id="crear">

                        <div class="containerForm">

                            <form enctype="multipart/form-data"  class="form-horizontal" role="form" action="<?php echo URL . 'users/registrarse/experto' ?>" id="form_registrarme" method="POST">
                                <fieldset>
                                    <legend>Datos de usuario</legend>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="nombre">Nombre</label>  
                                        <div class="col-md-4">
                                            <input name="nombre" id="nombre" maxlength="20"  type="text" placeholder="Nombre" class="form-control input-md">
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
                                        <label class="col-md-4 control-label" for="fechaNacimiento">Fecha de Registro</label>
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
                                            <input id="pass" name="password" type="password">
                                        </div>
                                    </div>

                                    <!-- Button (Double) -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="button1id"></label>
                                        <div class="col-md-8">
                                            <a id="button1id" href="<?php echo URL . 'admin/convocatorias'; ?>" name="button1id" class="btn btn-danger">Cancelar</a>
                                            <button id="button2id"  name="button2id" class="btn btn-success" type="submit">Enviar</button>
                                        </div>
                                    </div>

                                </fieldset>
                            </form>

                        </div>
                    </div> 



                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">

    </div>
</div> <!--Fin Modal-->

<div class="container-fluid">
    <div class="main">
        <h1 class="page-header">Detalles de la convocatoria número: </h1>

        <div class="panel panel-default">
            <div class="panel-body" id="Texto">
                Toda la información
            </div>
        </div>
        <?php
        if (isset($error)) {
            if (count($error) > 0) {
                ?>
                <div class="alert alert-danger">
                    <?php
                    for ($i = 0; $i < count($error); $i++) {
                        echo "<p>" . $error[$i] . "</p>";
                    }
                    ?>
                </div>    
            <?php } else { ?>
                <div class="alert alert-success">Agregado con éxito</div>
                <?php
            }
        }
        ?>
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class=".col-md-3 .col-md-offset-3">
                <button class="btn btn-primary btn-lg" id="add">
                    Agregar Convocatoria
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>ID convocatoria</th>
                        <th>Titulo</th>
                        <th>Descripción</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de finalizacion</th>
                        <th>Agregar Experto</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($convocatorias as $producto) { ?>
                        <tr>
                            <td class="img-responsive"><img class="img-miniatura" src="<?php echo URL . "public/imagenes/convocatorias/" . $producto->idConvocatoria . "x200.jpg"; ?>" /></td>
                            <td class="idConvocatoria"><?php echo $producto->idConvocatoria ?></td>
                            <td class="titulo"><?php echo $producto->titulo ?></td>
                            <td class="descripcion"><?php echo $producto->descripcion ?></td>
                            <td class="fechaInicio"><?php echo $producto->fechaInicio ?></td>
                            <td class="fechaFinalizacion"><?php echo $producto->fechaFinalizacion ?></td>
                            <td>
                                <button type="button" class="expertos">Expertos</button>
                            </td>
                            <td>
                                <a href="<?php echo URL . "convocatoria/eliminarConvocatoria/" . $producto->idConvocatoria ?>">
                                    <img src="<?php echo URL; ?>public/imagenes/aaserver/cruz_roja.png" />
                                </a>
                                <a>
                                    <img class="boton" src="<?php echo URL; ?>public/imagenes/aaserver/edit.png" />
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div><!-- Fin de la tabla -->



    </div>

</div>
<script>
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "<?php echo URL; ?>experto/sugerirExperto/" + str, true);
            xmlhttp.send();
        }
    }
</script>
<script type="text/javascript">

    $.validator.setDefaults({
        submitHandler: function (form)
        {
            form.submit();
        }
    });

    $('#formulario').validate(
            {
                rules:
                        {
                            titulo:
                                    {
                                        required: true,
                                        minlength: 10//,
                                                //email:true
                                    },
                            fechaInicial:
                                    {
                                        required: true,
                                    },
                            fechaFinalizacion:
                                    {
                                        required: true,
                                    },
                            descripcion:
                                    {
                                        required: true,
                                        minlength: 50
                                    }
                        },
                messages:
                        {
                            titulo:
                                    {
                                        required: "Ingrese un título para la convocatoria"
                                    },
                            fechaInicial:
                                    {
                                        required: "Ingrese la fecha de inicio de la convocatoria"
                                    },
                            fechaFinalizacion:
                                    {
                                        required: "Ingrese la fecha de finalización de la convocatoria"
                                    },
                            descripcion:
                                    {
                                        required: "Ingrese una descripción",
                                        minlength: "Trate de explicar la convocatoria en mas de 50 caracteres"
                                    }
                        }
            });

    $(function () {

        $("#fechaInicial").datetimepicker({format: 'Y/m/d H:i:s'});
        $("#fechaFinalizacion").datetimepicker({format: 'Y/m/d H:i:s'});
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
        $("#add").click(function () {
            $('#myModalLabel').text('Agregar');
            $('#boton').text('Agregar');
            $('#formulario').attr('action', '<?php echo URL . 'convocatoria/agregarConvocatoria' ?>');
            $('#myModal').modal();
            $('#titulo').val('');
            $('#fechaInicial').val('');
            $('#fechaFinalizacion').val('');
            $('#descripcion').val('');
        });

        $(".expertos").click(function () {
            var $linea = $(this).closest('tr');
            var $id = $linea.find(".idConvocatoria").text();
            $("#idS").val($id);
            $('#modalExpertos').modal();
        });

        $(".boton").click(function () {
            var $linea = $(this).closest('tr');
            var $id = $linea.find(".idConvocatoria").text();
            var $nombre = $linea.find(".titulo").text();
            var $descripcion = $linea.find(".descripcion").text();
            var $empresa_fab = $linea.find(".fechaInicio").text();
            var $unidades = $linea.find(".fechaFinalizacion").text();
            $('#formulario').attr('action', '<?php echo URL . 'convocatoria/actualizarConvocatoria' ?>');
            $('#myModalLabel').text('Editar');
            $('#boton').text('Editar');
            $('#titulo').val($nombre);
            $('#fechaInicio').val($empresa_fab);
            $('#fechaFinalizacion').val($unidades);
            $('#descripcion').val($descripcion);
            $('#myModal').modal();
        });
    });

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