<div id="divSesion" class="row">
    <div class="containerLogin col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2" >
        <div class="col-md-8 col-md-offset-2" id="form-container">
            <form role="form" action="<?php echo URL . 'users/entrarWeb' ?>" id="form_login" method="post">
                <h2 style="text-align: center; margin-bottom: 20px;">Iniciar Sesión</h2>
                <div class="form-group">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                            <label for="nameu" class="sr-only">Email</label>
                            <input id="nameu" name="login" class="form-control" type="text" placeholder="Ingrese su nombre de usuario">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <label for="pass" class="sr-only">Password</label>
                        <input id="pass" name="password" class="form-control" type="password" placeholder="Ingrese su contraseña">
                    </div>
                </div>

                <button type="submit" class="btn btn-block btn-primary">Entrar</button>
                <br>
                <p style="text-align: center;"><a  href="<?php echo URL; ?>users/recuperarContrasenaForm">¿Has olvidado tu contraseña?</a></p>
                <p style="text-align: center;">¿No tienes una cuenta? <a href="<?php echo URL; ?>users/registrarse">¡Regístrate!</a></p>
                
                <strong class="line-thru">O</strong>
                </br>
                <?php
                if (isset($errorLogin) && $errorLogin == "uno") {
                    echo '<div class="row" align="center">';
                    echo '<div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            Contraseña Incorrecta</div>';
                    echo '</div>';
                } elseif (isset($errorLogin) && $errorLogin == "dos") {
                    echo '<div class="row" align="center">';
                    echo '<div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            Usuario No Encotrado</div>';
                    echo '</div>';
                }
                ?>
            </form>
        </div>


    </div>
</div>
<div id="status">

</div>


</div> <!-- /container --> 
<script>
    $.validator.setDefaults({
        submitHandler: function (form)
        {
            form.submit();
        }
    });

    $('#form_login').validate(
            {
                rules:
                        {
                            nameu:
                                    {
                                        required: true,
                                        minlength: 3//,
                                                //email:true
                                    },
                            pass:
                                    {
                                        required: true,
                                        minlength: 2
                                    }
                        },
                messages:
                        {
                            nameu:
                                    {
                                        required: "Ingrese su nombre de usuario",
                                        minlength: "Su nombre de usuario debe tener al menos 3 caracteres"
                                    },
                            pass:
                                    {
                                        required: "Ingrese su contraseña",
                                        minlength: "Su contraseña debe tener al menos 6 caracteres"
                                    }
                        }
            });


</script>