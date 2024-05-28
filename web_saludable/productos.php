<?php include("template/cabecera.php"); ?>

<?php
include("administrador/config/bd.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- SECCION PRINCIPAL / MAIN SECTION -->

<section class="bg-cover bg-100" id="main" style="background-image: url('https://img.freepik.com/foto-gratis/bandeja-tratamiento-medico_1137-235.jpg?w=740&t=st=1706522227~exp=1706522827~hmac=29966d0e41707f4684719ab55f0489b8e282ef9941159a464855bac92167c019'); background-size: cover;">
    <div class="container-fluid vh-100 mt-5">
        <!-- espaciado en la dirección vertical (eje Y) -->
        <div class="row py-5">
            <div class="col-lg-7 pt-3 text-center">
                <!-- "p" en "pt" significa "padding" (relleno)."t" significa "top" (parte superior). -->
                <h1 class="pt-5">Bienvenidos A Nuestra Tienda</h1>
                <a href="recomendaciones.php" class="btn btn-primary mt-5">Otras
                    Alternativas</a>
            </div>
        </div>
    </div>
</section>

<!-- SECCION COMPRAS-->
<section class="shop py-5">
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1>Explora Nuestra Tienda</h1>
                <h6 class="text-primary">Estos Son Nuestros Productos</h6>
            </div>

            <div class="container mt-5 mb-5">
                <div class="row mx-auto justify-content-center mt-2">
                    <?php foreach ($listaProductos as $producto) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> <!-- Agregada clase mb-4 para más espacio debajo -->
                            <div class="card h-100 m-1">
                                <img class="card-img-top" src="./img/<?php echo $producto['imagen']; ?>" alt="">
                                <div class="card-body text-center">
                                    <hr />
                                    <h6 class="card-title"><?php echo $producto['nombre']; ?></h6>
                                    <p class="card-text"><?php echo $producto['precio']; ?> €</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-6 d-flex justify-content-center align-items-center"> <!-- Utiliza col-sm-6 para que el botón ocupe 6 columnas en dispositivos pequeños y mayores -->
                        <a href="catalogo.php" style="width: 40%;" class="btn btn-primary btn-block">Información Detallada</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php include("template/pie.php"); ?>