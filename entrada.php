<?php	
    require 'includes/app.php';    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoración de tu hogar</h1>
                        
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp"> 
            <source srcset="build/img/destacada.jpg" type="image/jpeg"> 
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
        </picture>         

        <p class="informacion-meta">Escrito el: <span>09/02/2022</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">           
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