<?php	

    // Si no está autenticado vuelve a inicio
    require '../includes/funciones.php'; 
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    } 

    // Importar la conexión de la bbdd
    require '../includes/config/database.php'; 
    $db = conectarDB();

    // Escribir la Query
    $query = "SELECT * FROM propiedades";    

    // Consultar la BBDD
    $resultadoQuery = mysqli_query($db, $query); 

    // guardo lo que me llega por la url
    $resultado = $_GET['resultado'] ?? null; // busca el valor y si no existe le asigna null

    // Si se pulsa el boton ELIMINAR
    if($_SERVER['REQUEST_METHOD'] === 'POST' ) {
        $id = filter_Var($_POST['id'], FILTER_VALIDATE_INT);

        if($id) {

            // Elimina el archivo de la imagen
            $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink('../imagenes/' . $propiedad['imagen']);

            // Elimina la propiedad
            $query = "DELETE FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query); 

            if($resultado) {               
                header('Location: /admin?resultado=3');
            }

        }
    }

    // incluye el template de header       
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <!-- Si se creó el anuncio lo muestro -->
        <?php if( intval( $resultado ) === 1): ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php elseif( intval( $resultado ) === 2): ?>
            <p class="alerta exito">Anuncio Modificado Correctamente</p>
        <?php elseif( intval( $resultado ) === 3): ?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>     
        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Imágen</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody> <!-- Mostrar los Resultados -->
                    <?php while( $propiedad = mysqli_fetch_assoc($resultadoQuery) ) : ?>
                    <tr>
                        <td> <span class="id"><?php echo $propiedad['id']; ?> </span></td>
                        <td> <?php echo $propiedad['titulo']; ?> </td>
                        <td> <img class="imagen-tabla" src="/imagenes/<?php echo $propiedad['imagen']; ?>" ></td>
                        <td> <?php echo $propiedad['precio']; ?> € </td>
                        <td>                            
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
        </table>

    </main>

<?php 

    //Cerrar la conexión
    mysqli_close($db);

    incluirTemplate('footer');
?>