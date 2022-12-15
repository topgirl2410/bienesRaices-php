<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <form class="formulario">
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