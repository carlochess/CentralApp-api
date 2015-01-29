<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Un sitio web para votar propuestas a proyectos">

        <title>Administrador</title>
        <!-- Favincon -->
        <link rel="shortcut icon" href="<?php echo URL; ?>public/imagenes/aaserver/logo.png" />

        <!--Bootstrap-->
        <link href="<?php echo URL; ?>public/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href= "<?php echo URL ?>public/css/2-col-portfolio.css" rel="stylesheet">
        <link href="<?php echo URL ?>public/css/style.css" rel="stylesheet">

        <!-- Awesome -->
        <link href= "<?php echo URL; ?>public/libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet"/>

        <link href="<?php echo URL; ?>public/css/simple-sidebar.css" rel="stylesheet"/>
        <link href="<?php echo URL; ?>public/css/jquery-ui.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/jquery.datetimepicker.css" rel="stylesheet">

        <script src= "<?php echo URL; ?>public/js/jquery-1.11.0.js"></script>
        <script src= "<?php echo URL; ?>public/js/jquery-ui.min.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.validate.min.js"></script>
        <script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.datetimepicker.js"></script>
        <link href="<?php echo URL; ?>public/css/tiempoReal.css" rel="stylesheet">
    </head>

    <body> 
        <!-- Barra de navegación -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>	
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo URL; ?>admin/index">
                        <img id="logo-header" src="<?php echo URL; ?>public/imagenes/aaserver/logo.png" alt="Logo"
                             style="max-height:60px;">
                    </a>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right collapse navbar-collapse navbar-responsive-collapse">
                        <!-- <li class="active"><a href="<?php echo URL; ?>">Inicio</a></li> -->
                        <li>
                            <form id="formBuscar" class="form-inline" role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="nombre" placeholder="">
                                </div>
                                <button type="submit" class="btn btn-default">Buscar</button>
                            </form>
                        </li>

                        <li class="liHeader"><a href="<?php echo URL; ?>admin/agregarTaxista">Agregar Taxista</a></li>
                        <li class="liHeader"><a href="<?php echo URL; ?>admin/saldo">Saldo</a></li>
                        <li class="liHeader"><a href="<?php echo URL; ?>admin/tiempoReal">Tiempo Real</a></li>
                        <li class="liHeader"><a href="<?php echo URL; ?>admin/taxistas">Taxistas</a></li>
                        <li class="liHeader"><a href="<?php echo URL; ?>admin/cuenta">Usuarios</a></li>
                        <?php if ($this->estaConectado()) { ?>

                            <!-- SESION -->
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <?php
                                    if ($this->estaConectado()) {
                                        echo 'Administrar';
                                    } else {
                                        echo "Sesión";
                                    }
                                    ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li id="productos"><a href="<?php echo URL . 'admin/perfil'; ?>">Perfil</a></li>
                                    <li class="divider"></li>
                                    <li class="liHeader"> <a href="<?php echo URL; ?>users/salir">Salir</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>