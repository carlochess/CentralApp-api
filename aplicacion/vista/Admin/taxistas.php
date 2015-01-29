<div class="container-fluid separar">
    <div class="main">
        <h1 class="page-header">Taxistas</h1>
        
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body" id="Texto">
                        Taxistas
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Foto Cedula</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Reputacion</th>
                        <th>Cedula</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) { ?>
                        <tr>
                            <td class="codigo"><img style="max-width: 100px;max-height: 100px;" class="img-responsive" src="<?php echo URL; ?>public/imagenes/cedulas/<?php echo $cliente->id; ?>.jpg" /></td>
                            <td class="codigo"><?php echo $cliente->id; ?></td>
                            <td class="codigo"><?php echo $cliente->nombre; ?></td>
                            <td class="codigo"><?php echo $cliente->correo; ?></td>
                            <td class="nombre"><?php echo $cliente->reputacion; ?></td>
                            <td class="empresa_fab"><?php echo $cliente->cedula; ?></td>
                            <td>
                                <a href="<?php echo URL . "users/eliminar/" . $cliente->idUsuario ?>">
                                    <img src="<?php echo URL; ?>public/imagenes/aaserver/cruz_roja.png" />
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- -->

<!--Modal para agregar expertos-->
<div class="modal fade  bs-example-modal-lg" id="modalAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Agregar administrativo</h4>
            </div>
            <div class="modal-body">
                <div class="tab-pane active" id="agregarform">
                    <form method="post" action="<?php echo URL ?>administrativo/agregarAdministrativo">
                        <div>
                            <br/>
                            Escribe el nombre de un usuario existente (solo uno):
                            <input type="text" name="administrativo" onkeyup="showHint(this.value)">
                            <p>Sugerencias: <span id="txtHint"></span></p>
                            <input type="submit" value="Enviar">
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
    </div>
</div> <!--Fin Modal-->

<!-- -->
<script>
    $(function () {
        $("#administrativos").click(function () {
            $('#modalAdmin').modal();
        });
    });

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
            xmlhttp.open("GET", "<?php echo URL; ?>administrativo/sugerirAdministrativo/" + str, true);
            xmlhttp.send();
        }
    }
</script>