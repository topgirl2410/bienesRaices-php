<?php

// Base de datos
require '../../includes/config/database.php';
$db = conectarDB();

// Consultar para obteber los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Arreglo con mensajes de errores
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$parking = '';
$vendedores_id = '';



// Ejecutar el código después de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $parking = $_POST['parking'];
    $vendedores_id = $_POST['vendedores_id'];
    $creado = date('Y/m/d');


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
        $query = " INSERT INTO propiedades ( titulo, precio, descripcion, habitaciones, wc, parking, creado,
    vendedores_id) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$parking', '$creado',
    '$vendedores_id')";

        //echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /admin');
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
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="parking">Parking:</label>
            <input type="number" id="parking" name="parking" placeholder="Ej: 3" min="1" max="9" value="<?php echo $parking; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedores_id">
                <option value="">-- Selecciona Vendedor --</option>
                <?php while ($vendedores_id = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedores_id === $vendedores_id['id'] ? 'selected' : ''; ?> value="<?php echo $vendedores_id['id'];
                                                                                                            ?>"><?php echo $vendedores_id['nombre'] . ' ' . $vendedores_id['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>
        <input class="boton boton-verde" type="submit" value="Crear Propiedad">

    </form>
</main>

<?php incluirTemplate('footer') ?>