<fieldset>
                <legend>Información General</legend>                

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad" value="<?php echo s($propiedad->titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">

                <?php if($propiedad->imagen) { ?>
                    <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
                <?php } ?>    

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>

            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej. 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej. 1" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

                <label for="estacionamiento">Plazas de garaje:</label>
                <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej. 1" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                
                <select name ="propiedad[vendedorID]">
                    <option value="">-- Seleccione --</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo s($propiedad->vendedorID) === $row['id'] ? 'selected' : ''; ?>  value="<?php echo $row['id'] ?>"> <?php echo $row['nombre'] . ' ' . $row['apellido'] ?> </option>
                    <?php endwhile; ?>                                
                </select>

            </fieldset>