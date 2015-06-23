<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title> <?= $title ?> </title>

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	
        <link rel="stylesheet" href="/taquillas/assets/css/normalize.min.css">
        <link rel="stylesheet" href="/taquillas/assets/css/main.css">
        <script src="/taquillas/assets/js/vendor/prefixfree.min.js"></script>
        <script src="/taquillas/assets/js/vendor/modernizr-2.6.2.min.js"></script>
        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <header>
            <div class="wrapper clear">

                <div id="user">
                    <?php
			         if($user) { ?>
                        <span>Hola, <?= $user->cn; ?> </span>
                        <a class="logout" href="/taquillas/inicio/logout">Salir</a>
                    <?php } else { ?>
                        <a id='entrar' href="/taquillas/inicio/login">Entrar</a>
                    <?php } ?>
                </div>
                <a href="/taquillas/taquilla/panel"> <h1>Taquillas</h1> </a>
                <a href="http://delegacion.uc3m.es" target="_blank"> <img src="/taquillas/assets/img/delegacion.png"> </a>

            </div>
        </header>

        <div class="main <?php echo isset($section) ? $section : '' ?> ">
