<?php

require '../../includes/app.php';

use App\Vendedor;

// Si no está autenticado lo mando al index
estaAutenticado();

// Nuevo objeto vacío
$vendedor = new Vendedor;

// Inicialización de Array con mensajes de errores para que no sea undefined
$errores = Vendedor::getErrores();

// Ejecuta el código cuando el usuario pulsa "Crear Propiedad"
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Instanciamos el vendedor
    $vendedor = new Vendedor($_POST['vendedor']);

    // Validación
    $errores = $vendedor->validar();

    // Si no hay errores en la validación guarda el vendedor en la bbdd
    if(empty($errores)){  

        $vendedor->guardar();

    } 


}


// ------------ HTML ------------ \\

incluirTemplate('header');

?>

<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <!-- Inserto los errores en pantalla -->
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?> 
        </div>                   
        <?php endforeach; ?>     

        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">

        </form>
        
    </main>

<?php 
    incluirTemplate('footer');
?>