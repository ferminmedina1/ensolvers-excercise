<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ensolvers - Exercise</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/folders.css">
    <link rel="stylesheet" href="./css/log.css">
    <!--<script type="text/javascript" src="./js/nav.js"></script>-->
    <base href="{$base_url}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

 <!-- header -->
 
    {include file="header.tpl"}


 <!-- CUERPO DE LA PAGINA -->
    
    <article class="content">
        <div class="container">
        <section class="formularioSection">
            <form class="formulario" action="verifyUser" method="post">
                <h1 class="subtitulo">Log!</h1>
                
                <label class="itemformulario"> Usuario: </label> <input type="text" name="input_user" required>
                <label class="itemformulario"> Contraseña: </label> <input type="password" id="contra" name="input_pass" autocomplete="off" required>

                <p id="avisoCaptcha">{$message}</p>
                <button type="submit" id="botonEnviar" >Log in</button>

            </form>
        </section>
        <div>
    </article>

</body>
</html>