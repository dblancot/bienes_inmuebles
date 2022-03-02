<?php

    // Importar la conexión
    require 'includes/app.php'; 
    $db = conectarDB();

    // Array de errores
    $errores = [];

    // Autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) );
        $password = mysqli_real_escape_string($db, $_POST['password'] );

        if(!$email) {
            $errores[] = "Inserta un email válido";
        }
        if(!$password) {
            $errores[] = "Inserta una password";
        }

        if(empty($errores)) {
            
            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
            $resultado = mysqli_query($db, $query);

            if( $resultado-> num_rows ) {
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                $auth = password_verify($password, $usuario['password']);

                if($auth) {
                    // El usuario está auntenticado
                    session_start();

                    // Datos para el array de sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;
                    header('Location: /admin');

                } else {
                    $errores[] = "El password es incorrecto";
                }

            } else {
                $errores[] = "El usuario no existe";
            }
        }

    }


    //Incluye el header   
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">

        <h1>Iniciar Sesión</h1>

        <!-- Mostrar errores -->
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?> 
        </div> 
        <?php endforeach; ?>  

        <form class="formulario" method="POST">

            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Nombre" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>  

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">

        </form>

    </main>

<?php
    //Incluye el footer
    incluirTemplate('footer');
?>