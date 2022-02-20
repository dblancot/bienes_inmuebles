<?php

    // Si no está autenticado vuelve a inicio
    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    } 
    
    // Importar la conexión de la bbdd
    require '../../includes/config/database.php'; 
    $db = conectarDB();

    // Consulta para obtener los vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado = mysqli_query($db, $consulta); 

    
    // Array con mensajes de errores
    $errores = [];

    // Declaración de variables    
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorID = '';


    // Ejecuta el código cuando el usuario pulsa "Crear Propiedad"
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";


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

        if(!$imagen['name'] || $imagen['error']) {
            $errores[] = 'La Imagen es Obligatoria';
        }
        
        //Validar por tamaño (1Mb máximo)
        $medida = 1000 * 1000;
        if($imagen['size'] > $medida) {
            $errores[] = 'La imagen tiene que ser menor de 100Kb';
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que el array de errores está vacía
        if(empty($errores)){

            //** SUBIDA DE ARCHIVOS */

            // Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            // Generar nombre único para las imagenes que se suben
            $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

            // Subir la imagen
            move_uploaded_file( $imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
            
            // Insertar en la base de datos
            $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorID) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorID') ";
            
            // echo $query;

            $resultado = mysqli_query($db, $query); // Ejecuta la consulta $query en la bbdd %db

            if($resultado) {
                // Redireccionar
                header('Location: /admin?resultado=1');
            }

        }

        

    }
     
    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?> 
        </div>           
         
        <?php endforeach; ?>     

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data" >
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej. 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej. 1" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Plazas de garaje:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej. 1" min="1" max="9" value="<?php echo $estacionamiento; ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                
                <select name ="vendedor">
                    <option value="">-- Seleccione --</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorID === $row['id'] ? 'selected' : ''; ?>  value="<?php echo $row['id'] ?>"> <?php echo $row['nombre'] . ' ' . $row['apellido'] ?> </option>
                    <?php endwhile; ?>                     
                    
                </select>

            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
        
    </main>

<?php 
    incluirTemplate('footer');
?>