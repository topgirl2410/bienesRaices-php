<?php

// Validar la URL por un ID valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

// Base de datos
require '../../includes/config/database.php';
$db = conectarDB();

// Consultar para obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

echo "<pre>";
var_dump($propiedad);
echo "</pre>";


// Consultar para obteber los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Arreglo con mensajes de errores
$errores = [];

$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$parking = $propiedad['parking'];
$vendedores_id = $propiedad['vendedores_id'];
$imagenPropiedad = $propiedad['imagen'];



// Ejecutar el código después de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";


    echo "<pre>";
    var_dump($_FILES);
    echo "</pre>";


    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $parking = mysqli_real_escape_string($db, $_POST['parking']);
    $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedores_id']);
    $creado = date('Y/m/d');

    // Asignar files hacia una variable
    $imagen = $_FILES['imagen'];


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


    if (!$imagen['name']) {
        $errores[] = "La imagen es obligatoria";
    }

    /**  Subida de archivos **/
    $medida = 1000 * 300;
    if ($imagen['size'] > $medida) {
        $errores[] = 'La imagen es demasiado pesada';
    }

    // Revisar que el array de errores este vacio
    if (empty($errores)) {
        // Crear carpeta 
        $carpetaImg = '../../imagenes';

        if (!is_dir($carpetaImg)) {
            mkdir($carpetaImg);
        }
        // Generar nombre unico para las imagenes
        $nombreImagen = md5(uniqid(rand(), true) . $imagen['name']) . ".jpg";

        // Subir la imagen
        if ($imagen['type'] === "image/jpeg" || $imagen['type'] === "image/png") {
            move_uploaded_file($imagen['tmp_name'], $carpetaImg . "/" . $nombreImagen);
        } elseif ($imagen['type'] !== "image/jpeg" || $imagen['type'] !== "image/png") {
            $errores[] .= "Formato de imagen erroneo";
        }
    }

    // Insertar en la base de datos
    $query = " INSERT INTO propiedades ( titulo, precio, imagen, descripcion, habitaciones, wc, parking, creado,
    vendedores_id) VALUES ( '$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$parking', '$creado',
    '$vendedores_id')";

    //echo $query;

    $resultado = mysqli_query($db, $query);

    if ($resultado) {
        //Redireccionar al usuario
        header('Location: /admin?resultado=1');
    }
}


require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin/" class="boton boton-verde">Volver a Inicio</a>

    <?php foreach ($errores as $error) :  ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>
                Información General
            </legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small" alt="">

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
                    <option <?php echo $vendedores_id === $vendedores_id['id']
                                ? 'selected' : '';
                            ?> value="<?php echo $vendedores_id['id'];
                                        ?>">
                        <?php echo $vendedores_id['nombre'] . ' ' . $vendedores_id['apellido'];
                        ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>
        <input class="boton boton-verde" type="submit" value="Actualizar Propiedad">

    </form>

</main>

<?php incluirTemplate('footer') ?>