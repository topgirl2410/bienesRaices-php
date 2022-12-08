<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Conoce Más Sobre Nosotros</h1>
    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>25 Años de Experiencia</blockquote>
            <p>Nunc interdum vehicula tortor quis dignissim. Vivamus a finibus turpis. Mauris vitae tempor dui, id
                consequat leo. Cras porttitor ligula quis felis pellentesque, sed sodales purus ornare. Integer
                condimentum metus semper libero tincidunt bibendum. Integer odio arcu, lacinia non velit sed,
                malesuada dignissim diam. </p>
            <p>
                Pellentesque a ante ut ligula sagittis euismod et in dui. Aliquam pharetra lobortis ligula viverra
                venenatis. Morbi bibendum ullamcorper risus et fringilla. Phasellus rutrum vitae nisi nec porta.
                Cras tristique bibendum commodo. Ut porta augue varius, rhoncus nisi sed, elementum ante. Curabitur
                sollicitudin elit non nisi maximus accumsan. Curabitur iaculis molestie lacus mattis euismod.
                Curabitur efficitur ullamcorper nulla non tincidunt.</p>
        </div>
    </div>
</main>

<section class="contenedor">
    <h1>Más Sobre Nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus reprehenderit suscipit, debitis
                tempora eveniet, unde eligendi nisi, nostrum neque aliquid iure molestiae perspiciatis provident
                ullam quam sapiente earum explicabo in.</p>
        </div>

        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus reprehenderit suscipit, debitis
                tempora eveniet, unde eligendi nisi, nostrum neque aliquid iure molestiae perspiciatis provident
                ullam quam sapiente earum explicabo in.</p>
        </div>

        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
            <h3>Tiempo</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus reprehenderit suscipit, debitis
                tempora eveniet, unde eligendi nisi, nostrum neque aliquid iure molestiae perspiciatis provident
                ullam quam sapiente earum explicabo in.</p>
        </div>
    </div>
</section>


<?php incluirTemplate('footer') ?>