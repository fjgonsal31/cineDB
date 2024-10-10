 <?php

    require 'includes/connectionDB.php';
    require 'includes/funcionesPelicula.php';
    require 'includes/funcionesDirector.php';

    session_start();

    ?>
 <!DOCTYPE html>
 <html lang="es">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Cartelera de Cine</title>
     <link rel="stylesheet" href="css/addPelicula.css">
 </head>

 <body>
     <!-- div añadir película -->
     <h2>Añadir Película</h2>
     <div id="formDiv">
         <form action="includes/controllerPelicula.php" method="POST" id="form">
             <label for="titulo">Título:</label>
             <input type="text" name="titulo" id="titulo">
             <label for="precio">Precio:</label>
             <input type="number" name="precio" id="precio" min="0" step="1">
             <label for="idDirector">Director:</label>
             <select name="idDirector" id="idDirector">
                 <option value="0">Seleccione un director</option>
                 <?php

                    foreach (getDirectores() as $key => $value) {
                        echo "<option value='$value[id]'>$value[nombre] $value[apellidos]</option>";
                    }

                    ?>
             </select><br>
             <button type="submit" id="enviar" class="success">Enviar</button>
             <button type="button" id="volver" class="danger">Volver</button>
         </form>

         <?php

            if (isset($_SESSION['mensaje'])) {
                echo "<p>$_SESSION[mensaje]</p>";
                unset($_SESSION['mensaje']);
            }

            if (isset($_SESSION['datosInsertados'])) {
                echo "<h2>Última película guardada</h2>";
                echo '<ul>';
                foreach ($_SESSION['datosInsertados'] as $key => $value) {
                    echo "<li>" . ucfirst($key) . ": " . htmlspecialchars($value) . "</li>";
                }
                echo '</ul>';

                unset($_SESSION['datosInsertados']);
            }

            ?>

     </div>
     <script src="js/addPelicula.js"></script>
 </body>

 </html>