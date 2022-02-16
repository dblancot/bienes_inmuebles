<?php	

    // guardo lo que me llega por la url
    $resultado = $_GET['resultado'] ?? null; // busca el valor y si no existe le asigna null

    require '../includes/funciones.php';    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <!-- Si se creó el anuncio lo muestro -->
        <?php if( intval( $resultado ) === 1): ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    </main>

<?php 
    incluirTemplate('footer');
?>