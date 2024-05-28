<?php
session_start();
// Abrimos un CONDICIONAL "IF/ELSE" preguntando: Si hay un envío de PHP tipo POST 
if ($_POST) {
    if (($_POST['usuario'] == "maikel") && ($_POST['contrasenia'] == "potenza")) {

        $_SESSION['usuario'] = 'ok';
        $_SESSION['nombreUsuario'] = "maikel";
        header('Location:inicio.php'); // voy a REDIRECCIONAR a algún lugar con la funcion "header"
    } else {
        $mensaje = "Error: El usuario o contraseña son incorrectos";
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">

            <div class="col-md-4"></div>

            <div class="col-md-4">
                <br /><br /><br /><br />

                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">

                        <?php if (isset($mensaje)){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje; ?>
                        </div>
                        <?php } ?>
                        <form method="POST">

                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Escribe tu usuario">
                            </div>

                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" placeholder="Escribe tu contraseña">
                            </div>
                            <!-- Cuando el usuario pulse este botón aún no hemos validado, nosotros hicimos un envío a través del METODO POST 
                            y hace la redirección a la página. -->
                            <button type="submit" class="btn btn-primary">Entrar al Administrador</button>

                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>

</body>

</html>