<?php

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    // Si no está autenticado vuelve a inicio    
    require '../../includes/app.php';
    estaAutenticado();


    // Guardo la id de la propiedad a modificar en una variable (después de sanitizarla)
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    // Si la id no es un INT redirecciono a página principal
    if(!$id) {
        header('Location: /admin');
    } 

    // Consulta para obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    // Consulta para obtener los vendedores
    $vendedores = Vendedor::all();
  
    // Inicializa Array con mensajes de errores
    $errores = Propiedad::getErrores();  

    // Ejecuta el código cuando el usuario pulsa "Crear Propiedad"
    if($_SERVER['REQUEST_METHOD'] === 'POST') {        
       
        // Asignar los atributos
        $args = $_POST['propiedad'];
        
        $propiedad->sincronizar($args);

        // Validación
        $errores = $propiedad->validar();

        // ## SUBIDA DE ARCHIVOS ##
        // Generar nombre único para las imagenes que se suben
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";
        
        //  Si existe imagen, se le hace resize con intervention
        if($_FILES['propiedad']['tmp_name']['imagen']) {

            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);

            // Seteo el nombre de la imagen en la instacia de la clase
            $propiedad->setImagen($nombreImagen);
        }

        // Revisar que el array de errores está vacía, si no hay errores subimos archivo e insertamos en la bbdd
        if(empty($errores)){   
            
            if($_FILES['propiedad']['tmp_name']['imagen']) {           
                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            // Actualiza el registro
            $propiedad->guardar();              
            
        } 
    }
       
    incluirTemplate('header');

?>

    <main class="contenedor seccion">

        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <!-- Muestra los errores -->
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?> 
        </div>                   
        <?php endforeach; ?>     

        <form class="formulario" method="POST" enctype="multipart/form-data" >

        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

        </form>   

    </main>

<?php 
    incluirTemplate('footer');
?>