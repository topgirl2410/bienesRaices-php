<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Contacto</h1>
    <picture>
        <img src="build/img/destacada3.jpg" alt="imagen de contacto">
    </picture>

    <h2>Rellene el Formulario de Contacto</h2>
    <form class="formulario">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre">

            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email" placeholder="Tu E-Mail">

            <label for="telefono">Teléfono:</label>
            <input type="tel" name="telefono" id="telefono" placeholder="Tu Teléfono">

            <label for="mensaje">Mensaje:</label>
            <textarea name="mensaje" id="mensaje"></textarea>
        </fieldset>


        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <select name="" id="opciones">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="compra">Compra</option>
                <option value="vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto:</label>
            <input type="number" id="presupuesto" placeholder="Tu Precio o Presupuesto">
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea que nos pongamos en contacto</p>
            <div class="forma-contacto">

                <label for="contactar-telefono">Teléfono</label>
                <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                <label for="contactar-email">E-Mail</label>
                <input name="contacto" type="radio" value="email" id="contactar-email">
            </div>

            <p>Si eligió teléfono, elija la fecha y la hora</p>

            <label for="fecha">Fecha:</label>
            <input name="fecha" type="date" value="fecha" id="fecha">

            <label for="hora">Hora:</label>
            <input name="hora" type="time" value="hora" id="hora" min="09:00" max="20:00">
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>


<?php include './includes/templates/footer.php'; ?>