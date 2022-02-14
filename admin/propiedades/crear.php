<?php	
    //Base de datos
    require '../../includes/config/database.php'; 

    $db = conectarDB();


    require '../../includes/funciones.php';    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <form class="formulario">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" placeholder="Título Propiedad">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" placeholder="Precio Propiedad">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion"></textarea>

            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" placeholder="Ej. 3" min="1" max="9">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" placeholder="Ej. 1" min="1" max="9">

                <label for="estacionamiento">Plazas de garaje:</label>
                <input type="number" id="estacionamiento" placeholder="Ej. 1" min="1" max="9">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                
                <select>
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