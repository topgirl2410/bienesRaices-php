<?php
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /');
}

// Importar la conexión
require 'includes/config/database.php';
$db = conectarDB();

// Consultar la BD 
$query = "SELECT * FROM propiedades WHERE id = ${id}";

// Obtener los resultados
$resultado = mysqli_query($db, $query);

if (!$resultado->num_rows) {
    header('Location: /');
}

$propiedad = mysqli_fetch_assoc($resultado);


require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>

    <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad">

    <div class="resumen-propiedad">
        <p class="precio"><?php echo $propiedad['precio']; ?> €</p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad['parking']; ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad['descripcion']; ?></p>
        <p><?php echo $propiedad['descripcion']; ?></p>
    </div>
</main>

<?php

// Cerrar conexión
mysqli_close($db);

incluirTemplate('footer')
?>