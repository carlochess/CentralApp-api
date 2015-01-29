<!--- Modal --->
<div class="modal fade  bs-example-modal-lg separar" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Agregar Pago</h4>
            </div>
            <div class="modal-body">
                <div id="agregar">
                    <form action="<?php echo URL . 'admin/pagar' ?>" method="POST" id="formulario" role="form">
                    <div class="form-group">
                        <label for="idTaxista" class="control-label">Taxista</label>
                        <select id="taxistas" name="idTaxista" multiple class="form-control">
                            <!--<option value="id">Nombre 1</option>-->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idRecorrido">Recorrido</label>
                        <select id="recorrido" name="idRecorrido" multiple class="form-control">
                            <!--<option value="id">Nombre 1</option>-->
                        </select>
                    </div>
                    <button type="button" id="hallar" class="btn btn-default" id="boton">Encontrar Recorrido</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">

    </div>
</div> 
<!--- Fin Modal -->
<div class="container-fluid separar">
    <div class="main">
        <h1 class="page-header">Cuentas</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body" id="Texto">
                        Mensualidades
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary btn-lg" id="add">
                    Agregar Pago
                </button>
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
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Reputación</th>
                        <th>Fecha de inscripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($cuentas as $cuenta) { ?>
                            <tr>
                                <td class="img-responsive"><img class="img-miniatura" src="<?php echo URL . "public/imagenes/" . $cuenta->id . ".jpg"; ?>" /></td>
                                <td class="idConvocatoria"><?php echo $cuenta->id ?></td>
                                <td class="titulo"><?php echo $cuenta->nombre ?></td>
                                <td class="descripcion"><?php echo $cuenta->correo ?></td>
                                <td class="fechaInicio"><?php echo $cuenta->reputacion ?></td>
                                <td class="fechaFinalizacion"><?php echo $cuenta->fechaInscripcion ?></td>
                                <td>
                                    <a href="<?php echo URL . "admin/eliminarUsuario/" . $cuenta->id ?>">
                                        <img src="<?php echo URL; ?>public/imagenes/aaserver/cruz_roja.png" />
                                    </a>
                                    <a href="<?php echo URL . "admin/convertirEnAdministrador/" . $cuenta->id?>">
                                        <button class="btn btn-default">Asignar como admin</button>
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
    function getExpertos(convocatoria) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                $("#listaExpertos").empty();
                var expertos = JSON.parse(xmlhttp.responseText);
                expertos.forEach(function (e) {
                    $("#listaExpertos").append('<li id="' + e.idUsuario + '">' + e.nombre + '</li>');
                });
            }
        }
        xmlhttp.open("GET", "<?php echo URL; ?>experto/getExpertos/" + convocatoria, true);
        xmlhttp.send();
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
            getExpertos($id);
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
            $('#idConvocatoria').val($id);
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