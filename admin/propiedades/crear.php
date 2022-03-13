<?php

    // Si no está autenticado vuelve a inicio
    require '../../includes/app.php';

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    // Si no está autenticado lo mando al index
    estaAutenticado();

    $propiedad = new Propiedad;

    // Consulta para obtener los vendedores
    $vendedores = Vendedor::all();
    
    // Inicialización de Array con mensajes de errores para que no sea undefined
    $errores = Propiedad::getErrores();

    // Ejecuta el código cuando el usuario pulsa "Crear Propiedad"
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Instancio la propiedad
        $propiedad = new Propiedad($_POST['propiedad']);        

        // Generar nombre único para las imagenes que se suben
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

        //  Si existe imagen, se le hace resize con intervention
        if($_FILES['propiedad']['tmp_name']['imagen']) {

            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);

            // Seteo el nombre de la imagen en la instacia de la clase
            $propiedad->setImagen($nombreImagen);
        }
                
        // Verifico que el formulario está bien cubierto
        $errores = $propiedad->validar();
       
        // Si no hay errores en la validación guarda todo
        if(empty($errores)){         
                        
            // Crear carpeta imagenes si no existe
            if(!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);        }
                       
            // Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            
            // Guarda la propiedad en la bbdd
            $propiedad->guardar();                
        }  
    }
     
    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <!-- Inserto los errores en pantalla -->
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?> 
        </div>                   
        <?php endforeach; ?>     

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data" >
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
        
    </main>

<?php 
    incluirTemplate('footer');
?>