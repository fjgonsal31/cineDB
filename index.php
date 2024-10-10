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
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h2>Cartelera de Cine</h2>
    <!-- botón añadir película -->
    <div id="buttonDiv">
        <a href="addPelicula.php" id="add">Añadir película</a>
    </div>
    <!-- tabla -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Precio</th>
                <th>Director</th>
                <th>Opciones</th>
                <th class="hidden">ID Director</th>
            </tr>
        </thead>
        <tbody>

            <?php

            if (getPeliculas()->num_rows > 0) {
                foreach (getPeliculas() as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[id]</td>";
                    echo "<td class='edit'>$value[titulo]</td>";
                    echo "<td class='edit'>$value[precio]" . " €" . "</td>";
                    echo "<td class='edit'>$value[nombre] $value[apellidos]</td>";

                    echo "<td id='select$value[id]' class='hidden edit'><select id='directorSelect$value[id]'>";

                    foreach (getDirectores() as $k => $val) {
                        echo "<option value='$val[id]'>$val[nombre] $val[apellidos]</option>";
                    }

                    echo "</select></td>";

                    echo "<td><button id='u$value[id]' class='update primary'>✏️</button>";
                    echo "<button id='d$value[id]' class='delete danger'>🗑️</button>";
                    echo "<button id='a$value[id]' type='submit' class='aceptar success hidden'>✅</button>";
                    echo "<button id='c$value[id]' type='button' class='cancelar danger hidden'>❌</button></td>";
                    echo "<td id='i$value[id_director]'class='hidden'>$value[id_director]</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td>0 resultados</td>";
                echo "</tr>";
            }

            ?>

        </tbody>

    </table>
    <script src="js/index.js"></script>
</body>

</html>