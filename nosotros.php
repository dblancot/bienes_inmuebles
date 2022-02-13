<?php	
    require 'includes/funciones.php';    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" ttype="image/webp">
                    <source srcset="build/img/nosotros.jpg" ttype="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">  
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 Años de Experiencia
                </blockquote>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, accusantium quas. Iure inventore eius temporibus adipisci tenetur, rem natus, cupiditate repellendus assumenda placeat est voluptatum illo labore quis a officia. Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi aperiam architecto quo dignissimos nulla dolor, animi et iste cum deleniti hic possimus minus, voluptatem vel, magni debitis impedit nobis. Praesentium.
                </p>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum perspiciatis quia autem doloribus hic ea eum numquam expedita laudantium eligendi veritatis exercitationem incidunt dolorem ipsa temporibus, aperiam nesciunt illum veniam?
                </p>
            </div>
        </div>

        <section class="contenedor seccion">
            <h1>Más Sobre Nosotros</h1>

            <div class="iconos-nosotros">
                <div class="icono">
                    <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                    <h3>Seguridad</h3>
                    <p>Corporis voluptatum quasi nihil neque quos fugiat incidunt, nostrum, culpa vel perferendis laudantium quibusdam officia atque, possimus tempora expedita error est aliquid.</p>
                </div>
                <div class="icono">
                    <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                    <h3>Precio</h3>
                    <p>Corporis voluptatum quasi nihil neque quos fugiat incidunt, nostrum, culpa vel perferendis laudantium quibusdam officia atque, possimus tempora expedita error est aliquid.</p>
                </div>
                <div class="icono">
                    <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                    <h3>A Tiempo</h3>
                    <p>Corporis voluptatum quasi nihil neque quos fugiat incidunt, nostrum, culpa vel perferendis laudantium quibusdam officia atque, possimus tempora expedita error est aliquid.</p>
                </div>        
            </div>
        </section>

    </main>
    
<?php 
    incluirTemplate('footer');
?>