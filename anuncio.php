<?php

    // Guardo la id de la propiedad a modificar en una variable (después de sanitizarla)
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    // Si la id no es un INT redirecciono a página principal
    if(!$id) {
        header('Location: /');
    }
    
    // Importar la conexión de la bbdd
    require 'includes/config/database.php'; 
    $db = conectarDB();

    // Consulta para obtener los datos de la propiedad
    $consulta = "   SELECT * 
                    FROM propiedades 
                    WHERE id = ${id}
                ";
    $resultado = mysqli_query($db, $consulta);
    
    // Si la id no es válida redirecciono a página principal
    if(!$resultado->num_rows) {
        header('Location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultado);

    // Declaración de variables inicializándolas con los valores de propiedad correspondientes 
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorID = $propiedad['vendedorID'];
    $imagenPropiedad = $propiedad['imagen'];

    require 'includes/funciones.php';    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $titulo; ?></h1>
                
        <picture>            
            <img loading="lazy" src="imagenes/<?php echo $imagenPropiedad; ?>" alt="Imagen de la propiedad">
        </picture>         

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $precio; ?> €</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $wc; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $habitaciones; ?></p>
                </li>
            </ul>
            <p>
                <?php echo $descripcion; ?>  
           </p>

        </div>
    </main>

<?php 
    incluirTemplate('footer');

    //Cerrar la conexión
    mysqli_close($db);
?>