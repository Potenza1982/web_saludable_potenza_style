<?php include("../template/cabecera.php") ?>

<?php

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtPrecio = (isset($_POST['txtPrecio'])) ? $_POST['txtPrecio'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/bd.php");

//echo $txtID . "<br/>";
//echo $txtNombre . "<br/>";
//echo $txtImagen . "<br/>";
//echo $accion . "<br/>";

switch ($accion) {

    case "Agregar":

        //INSERT INTO `productos` (`id`, `nombre`, `precio`, `imagen`) VALUES (NULL, 'Productos naturales', '0.00', 'imagen.jpg');
        // Preparar la consulta SQL para insertar un nuevo producto
        $sentenciaSQL = $conexion->prepare("INSERT INTO productos (nombre, precio, imagen) VALUES (:nombre, :precio, :imagen)");

        // Vincular los valores de las variables a los marcadores de posición en la consulta SQL
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':precio', $txtPrecio);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";

        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

        if ($tmpImagen != "") {

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->execute();

        header("Location:productos.php");
        //echo "Presionando botón agregar";
        break;

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE productos SET nombre=:nombre, precio=:precio WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':precio', $txtPrecio);
        $sentenciaSQL->execute();

        //SI TIENE ALGO
        if ($txtImagen != "") {
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            //HACEMOS EL COPIADO DE ESE ARCHIVO
            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);

            // 1º BORRAMOS LA IMAGEN ANTIGUA
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM productos WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($producto["imagen"]) && ($producto["imagen"] != "imagen.jpg")) {

                if (file_exists("../../img/" . $producto["imagen"])) {
                    unlink("../../img/" . $producto["imagen"]);
                }
            }
            // 2º ACTUALIZAMOS LA IMAGEN NUEVA
            $sentenciaSQL = $conexion->prepare("UPDATE productos SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();

            header("Location:productos.php");
            //echo "Presionando botón Modificar";
            break;
        }

    case "Cancelar":
        header("Location:productos.php");
        //echo "Presionando botón Cancelar";
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM productos WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre = $producto['nombre'];
        $txtImagen = $producto['imagen'];
        //echo "Presionando botón Seleccionar";
        break;

    case "Borrar":
        //BORRADO DE ARCHIVOS (BORRADO DE LA FOTO DE LA CARPETA "img")
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM productos WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($producto["imagen"]) && ($producto["imagen"] != "imagen.jpg")) {

            if (file_exists("../../img/" . $producto["imagen"])) {
                unlink("../../img/" . $producto["imagen"]);
            }
        }

        //BORRADO DEL REGISTRO
        $sentenciaSQL = $conexion->prepare("DELETE FROM productos WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        header("Location:productos.php");
        //echo "Presionando botón Borrar";
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Para declarr la INTERFAZ vamos a crear un DIV -->
<div class="col-md-5">

    <div class="card">

        <div class="card-header">
            Datos de Producto
        </div>

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                </div>

                <div class="form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del producto">
                </div>

                <div class="form-group">
                    <label for="txtPrecio">Precio:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Precio del producto">
                </div>

                <div class="form-group">
                    <label for="txtNombre">Imagen:</label>
                    <br />

                    <?php
                    if ($txtImagen != "") { ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="50" alt="" srcset="">
                    <?php } ?>

                    <br /><br />
                    <input type="file" required class="form-control" name="txtImagen" id="txtImagen" placeholder="No se eligió ningún archivo">
                </div>

                <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>

            </form>

        </div>

    </div>

</div>

<div class="col-md-7">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaProductos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['id']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['precio']; ?></td>
                    <td>

                        <img class="img-thumbnail rounded" src="../../img/<?php echo $producto['imagen']; ?>" width="50" alt="" srcset="">

                    </td>

                    <td>

                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['id']; ?>" />

                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />

                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                        </form>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


</div>

<?php include("../template/pie.php") ?>