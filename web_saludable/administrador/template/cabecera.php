<?php 
session_start();
    if (!isset($_SESSION['usuario'])){
        header("Location:../index.php");
    }else{
        if($_SESSION['usuario']=="ok"){
            $nombreUsuario=$_SESSION['nombreUsuario'];
        }
    }

?>

<!doctype html>
<html lang="es">

<head>
    <title>Potenza Style</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Miguel Angel Barragán Campos">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <!-- primero vamos a poner la redirección, vamos a crear una VARIABLE en PHP, le vamos a llamar $url -> y le voy a indicar que la vamos a redireccionar a-->
    <?php $url="http://".$_SERVER['HTTP_HOST']."/web_saludable"  ?>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador del sitio web<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/inicio.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/productos.php">Productos</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/cerrar.php">Cerrar</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio web</a>
        </div>
    </nav>

    <div class="container">
        <br/>
        <div class="row">