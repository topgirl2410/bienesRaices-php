<?php

// Conectar base de datos
require 'includes/config/database.php';
$db = conectarDB();

// Autentificar un usuario
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es válido";
    }

    if (!$password) {
        $errores[] = "El password es obligatorio";
    }

    if (empty($errores)) {
        // Revisar si un usuario existe o no
        $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
        $resultado = mysqli_query($db, $query);



        if ($resultado -> num_rows) {
            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            // Verificar si el password es correcto
            $auth = password_verify($password, $usuario['password']);

            if($auth) {
                // El usuario esta autentificado

            }else {
                // El password es incorrecto
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El usuario no existe";
        }
    }
}


// Incluye el header
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>


    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>


            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email" placeholder="Tu E-Mail">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Tu Password">
        </fieldset>

        <input class="boton boton-verde" type="submit" value="Iniciar Sesión">
    </form>
</main>

<?php
incluirTemplate('footer');
?>