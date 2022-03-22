<?php

    use App\Propiedad;

    require 'includes/app.php';   

    // Guardo la id de la propiedad a modificar en una variable (después de sanitizarla)
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    // Si la id no es un INT redirecciono a página principal
    if(!$id) {
        header('Location: /');
    }

    $propiedad = Propiedad::find($id);

    // debug($propiedad);
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad->titulo; ?></h1>
                
        <picture>            
            <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de la propiedad">
        </picture>         

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad->precio; ?> €</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <p>
                <?php echo $propiedad->descripcion; ?>  
           </p>

        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>
