<div class="container apartar">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Recuperación de Contraseña
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

            <form class="form-horizontal" role="form" method="post" action="<?php echo URL . 'users/recuperarContrasena' ?>">
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                        <input id="email" name="email" type="text" class="form-control" placeholder="Ingresa tu E-mail">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button id="enviar" name="enviar" type="submit" class="btn btn-default">Enviar</button>
                    </div>
                </div>
            </form>
            
            <!--
            <form method="post" action="<?php echo URL . 'users/recuperarContrasena' ?>" >
                <div class="row">
                    <div class=" col-md-9 col-lg-9 "> 
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td>E-mail:</td>
                                    <td> 
                                        <input id="email" name="email" class="form-control" type="text" placeholder="Ingresa tu E-mail">
                                    </td>
                                </tr>
                                <tr>
                                    <td><input id="enviar" name="enviar" class="form-control" type="submit" placeholder="Enviar"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            -->
        </div>
    </div>
    <div class="panel-footer">

    </div>

</div>