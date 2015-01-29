<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Un sitio web para votar propuestas a proyectos">
        <meta name="author" content="Ma0, Carlos Ro, Juan Diego Garcia, Cristian Ballesteros, Cristian Mejía, Larva">
        <title>Ya Voy</title>

        <!-- Favincon -->
        <link rel="shortcut icon" href="<?php echo URL; ?>public/imagenes/aaserver/logo.png" />

        <!--Bootstrap-->
        <link href="<?php echo URL; ?>public/css/bootstrap.min.css" rel="stylesheet">
        <!-- Awesome -->
        <link href= "<?php echo URL; ?>public/libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
        <!-- para notificaciones -->
        <link href= "<?php echo URL; ?>public/css/notificaciones.css" rel="stylesheet"/>
        <!-- Custom CSS -->
        <link href= "<?php echo URL ?>public/css/2-col-portfolio.css" rel="stylesheet">
        <link href="<?php echo URL ?>public/css/style.css" rel="stylesheet">
        <link href= "<?php echo URL ?>public/css/login.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/component.css" />

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://www.google.com/jsapi"></script>
        <link href="<?php echo URL; ?>public/css/jquery-ui.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/social-buttons.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/carousel.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/alertify.core.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/alertify.bootstrap.css" rel="stylesheet">
        <!--<link href="<?php echo URL; ?>public/css/timesheet.css" rel="stylesheet">-->

        <!--Scripts -->
        <script src= "<?php echo URL; ?>public/js/jquery-1.11.0.js"></script>
        <script src= "<?php echo URL; ?>public/js/jquery-ui.min.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.validate.min.js"></script>
        <script src="<?php echo URL; ?>public/js/util.js"></script>
        <script src="<?php echo URL; ?>public/js/alertify.min.js"></script>
        <script src="<?php echo URL; ?>public/js/notificaciones.js"></script>
        <!--<script src="<?php echo URL; ?>public/js/timesheet.js" type="text/javascript" />-->
        <!--Bootstrap-->
        <script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>

    </head>
    <!-- NAVBAR ================================================== navbar-fixed-top-->
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>	
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo URL; ?>">
                        <img id="logo-header" src="<?php echo URL; ?>public/imagenes/aaserver/logo.png" alt="Logo"
                             style="max-height:60px;">
                    </a>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right collapse navbar-collapse navbar-responsive-collapse">
                        <!-- SESION -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <?php
                                if ($this->estaConectado()) {
                                    echo $this->getNombre() . "  ";
                                    //echo '<img alt="User Pic" src="" class="img-circle ">';
                                } else {
                                    echo "Sesión";
                                }
                                ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if ($this->estaConectado()) { ?>
                                    <li class="liHeader">
                                        <a href="<?php echo URL; ?>cuenta/index">Cuenta</a>
                                    </li>
                                    <li class="liHeader">
                                        <a href="<?php echo URL; ?>cuenta/perfil">Perfil</a>
                                    </li>
                                    <?php if ($this->esAdmin()) { ?>
                                        <li class="liHeader"><a href="<?php echo URL ?>admin">Administrar</a></li>
                                        <?php
                                    }
                                }
                                ?>
                                <?php if (!$this->estaConectado()) { ?>
                                    <li class="liHeader">
                                        <a  href="<?php echo URL ?>users/login" >Entrar </a>
                                    </li>
                                    <li class="divider"></li>
                                    <!--<li class="liHeader">
                                        <a href="<?php echo URL; ?>users/registrarse">Registrarse</a>
                                    </li>-->
                                <?php } else { ?>
                                    <li class="divider"></li>
                                    <li class="liHeader"> <a href="<?php echo URL; ?>users/salir">Salir</a></li>
                                    <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
