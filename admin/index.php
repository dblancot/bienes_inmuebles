<?php	

    // Si no está autenticado vuelve a inicio
    require '../includes/app.php'; 
    estaAutenticado();

    use App\Propiedad;
    use App\Vendedor;

    // Obtener todos los registros (Array de objetos)
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    // guardo lo que me llega por la url
    $resultado = $_GET['resultado'] ?? null; // busca el valor y si no existe le asigna null

    // Si se pulsa el boton ELIMINAR
    if($_SERVER['REQUEST_METHOD'] === 'POST' ) {

        debug($_POST);

        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

        if($id) {
            $propiedad = Propiedad::find($id);
            $propiedad->eliminar();
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
         
        <h2>Propiedades</h2>
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
                    <?php foreach( $propiedades as $propiedad ) : ?>
                    <tr>
                        <td> <span class="id"><?php echo $propiedad->id; ?> </span></td>
                        <td> <?php echo $propiedad->titulo; ?> </td>
                        <td> <img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" ></td>
                        <td> <?php echo $propiedad->precio; ?> € </td>
                        <td>                            
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody> <!-- Mostrar los Resultados -->
                    <?php foreach( $vendedores as $vendedor ) : ?>
                    <tr>
                        <td> <span class="id"><?php echo $vendedor->id; ?> </span></td>
                        <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido ; ?> </td>                        
                        <td> <?php echo $vendedor->telefono; ?> </td>
                        <td>                            
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>

    </main>

<?php 

    incluirTemplate('footer');
?>