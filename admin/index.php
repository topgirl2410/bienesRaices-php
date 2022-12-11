<?php

$resultado = $_GET['resultado'] ?? null;

require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado) === 1) :  ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>Casa en la playa</td>
                <td> <img src="/imagenes/b5b569cd99ab0eb164d497aee2fcacfb.jpg" class="imagen-tabla" </td>
                <td>1200000 €</td>
                <td>
                    <a href="#">Eliminar</a>
                    <a href="#">Actualizar</a>
                </td>
            </tr>
        </tbody>
    </table>
</main>




<?php incluirTemplate('footer') ?>