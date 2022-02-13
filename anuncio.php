<?php	
    require 'includes/funciones.php';    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>
                
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp"> 
            <source srcset="build/img/destacada.jpg" type="image/jpeg"> 
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
        </picture>         

        <div class="resumen-propiedad">
            <p class="precio">3.000.000€</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p>4</p>
                </li>
            </ul>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, accusantium quas. Iure inventore eius temporibus adipisci tenetur, rem natus, cupiditate repellendus assumenda placeat est voluptatum illo labore quis a officia. Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi aperiam architecto quo dignissimos nulla dolor, animi et iste cum deleniti hic possimus minus, voluptatem vel, magni debitis impedit nobis. Praesentium.
            </p>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum perspiciatis quia autem doloribus hic ea eum numquam expedita laudantium eligendi veritatis exercitationem incidunt dolorem ipsa temporibus, aperiam nesciunt illum veniam?
            </p>

        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>