<?php

require '../../includes/config/database.php';
$db = conectarDB();

// Arreglo con mensajes de errores
$errores = [];

// Ejecutar el código después de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $parking = $_POST['parking'];
    $vendedores_id = $_POST['vendedores_id'];


    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }

    if (!$precio) {
        $errores[] = "Debes añadir un precio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "Debes añadir el número de habitaciones";
    }

    if (!$wc) {
        $errores[] = "Debes añadir el número de baños";
    }

    if (!$parking) {
        $errores[] = "Debes añadir el número de plazas de aparcamiento";
    }

    if (!$vendedores_id) {
        $errores[] = "Elige un vendedor";
    }

    // Revisar que el array de errores este vacio
    if (empty($errores)) {
        // Insertar en la base de datos
        $query = " INSERT INTO propiedades ( titulo, precio, descripcion, habitaciones, wc, parking,
    vendedores_id) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$parking',
    '$vendedores_id')";

        echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo "Insertado Correctamente";
        }
    }
}






require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin/" class="boton boton-verde">Volver a Inicio</a>

    <?php foreach ($errores as $error) :  ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
        <fieldset>
            <legend>
                Información General
            </legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"></textarea>

        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9">

            <label for="parking">Parking:</label>
            <input type="number" id="parking" name="parking" placeholder="Ej: 3" min="1" max="9">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedores_id">
                <option disabled selected value="">-- Selecciona Vendedor --</option>
                <option value="1">María</option>
                <option value="2">Marco</option>
            </select>
        </fieldset>

        <input class="boton boton-verde" type="submit" value="Crear Propiedad">
    </form>
</main>

<?php incluirTemplate('footer') ?>