<?php

    use App\Propiedad;

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
    $consulta = "   SELECT *   
                    FROM vendedores
                ";
    $resultado = mysqli_query($db, $consulta); 
    
    // Array con mensajes de errores
    $errores = [];  

    // Ejecuta el código cuando el usuario pulsa "Crear Propiedad"
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // asigno el valor del formulario a las variables
        $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
        $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string( $db, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento'] );
        $vendedorID = mysqli_real_escape_string( $db, $_POST['vendedor'] );
        $creado = date('Y/m/d');

        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];
        
        // Añadiendo los errores al array
        if(!$titulo) {
            $errores[] = "Debes añadir un título";
        }

        if(!$precio) {
            $errores[] = "El precio es obligatorio";
        }

        if( strlen($descripcion) < 50) {
            $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$habitaciones) {
            $errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$wc) {
            $errores[] = "El número de baños es obligatorio";
        }

        if(!$estacionamiento) {
            $errores[] = "El número de plazas de garaje es obligatorio";
        }

        if(!$vendedorID) {
            $errores[] = "Elige un vendedor";
        }
        
        //Validar por tamaño (1Mb máximo)
        $medida = 1000 * 1000;
        if($imagen['size'] > $medida) {
            $errores[] = 'La imagen tiene que ser menor de 100Kb';
        }

        // Revisar que el array de errores está vacía, si  no hay errores subimos archivo e insertamos en la bbdd
        if(empty($errores)){

            // ** SUBIDA DE ARCHIVOS ** //

            // Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            // Si se sube una nueva imagen, borramos la existente y cargamos la nueva
            if($imagen['name']) {
                unlink($carpetaImagenes . $propiedad['imagen']);

                // Generar nombre único para las imagenes que se suben
                $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

                // Subir la imagen
                move_uploaded_file( $imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
            } else {
                $nombreImagen = $propiedad['imagen'];
            }           

            // Insertar en la base de datos
            $query = "  UPDATE propiedades 
                        SET titulo = '${titulo}'
                            ,precio = '${precio}'
                            ,imagen = '${nombreImagen}' 
                            ,descripcion = '${descripcion}'
                            ,habitaciones = ${habitaciones}    
                            ,wc = ${wc} 
                            ,estacionamiento = ${estacionamiento} 
                            ,vendedorID = ${vendedorID}
                        WHERE id = ${id}  
                        ";
                      
            // Ejecuta la consulta $query en la bbdd %db
            $resultado = mysqli_query($db, $query); 

            // Redireccionar enviando resultado = 1 por el GET
            if($resultado) {               
                header('Location: /admin?resultado=2');
            }
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