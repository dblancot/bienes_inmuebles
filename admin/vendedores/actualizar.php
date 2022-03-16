<?php

require '../../includes/app.php';

use App\Vendedor;

// Si no está autenticado lo mando al index
estaAutenticado();

// Guardo la id del vendedor a modificar en una variable (después de sanitizarla)
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

// Si la id no es un INT redirecciono a página principal
if(!$id) {
    header('Location: /admin');
} 

// Consulta para obtener los datos de la vendedor
$vendedor = Vendedor::find($id);

// Inicialización de Array con mensajes de errores para que no sea undefined
$errores = Vendedor::getErrores();

// Ejecuta el código cuando el usuario pulsa "Crear vendedor"
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Asignar los atributos
    $args = $_POST['vendedor'];
        
    // Sincronizar el objeto en memoria con lo que el usuario escribió.
    $vendedor->sincronizar($args);

    // Validación
    $errores = $vendedor->validar();
   
    // Revisar que el array de errores está vacía, si no hay errores insertamos en la bbdd
    if(empty($errores)){           

        // Actualiza el registro
        $vendedor->guardar();
    }    

}


// ------------ HTML ------------ \\

incluirTemplate('header');

?>

<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <!-- Inserto los errores en pantalla -->
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?> 
        </div>                   
        <?php endforeach; ?>     

        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">

        </form>
        
    </main>

<?php 
    incluirTemplate('footer');
?>