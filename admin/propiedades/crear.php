<?php	
    //Base de datos
    require '../../includes/config/database.php'; 
    $db = conectarDB();
    
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

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedorID = $_POST['vendedor'];

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
        
        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que el array de errores está vacía
        if(empty($errores)){

            // Insertar en la base de datos
            $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorID) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorID') ";
            
            // echo $query;

            $resultado = mysqli_query($db, $query); // Ejecuta la consulta $query en la bbdd %db

            if($resultado) {
                echo "Insertado Correctamente";
            }

        }

        

    }

    require '../../includes/funciones.php';    
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

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" >
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
                    <option value="1">Diego</option>
                    <option value="2">Irene</option>
                </select>

            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
        
    </main>

<?php 
    incluirTemplate('footer');
?>