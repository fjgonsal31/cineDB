<?php

session_start(); // Asegúrate de iniciar la sesión

require 'funcionesPelicula.php';

// DELETE
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
    $id = $_POST['id'];
    // Procesar la eliminación
    echo "El ID es: " . htmlspecialchars($id);
    deletePelicula($id);
    exit(); // Salir después de procesar la solicitud DELETE
}

// UPDATE
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['_method']) && $_POST['_method'] === 'UPDATE') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $id_director = $_POST['idDirector'];

    updatePelicula($id, $titulo, $precio, $id_director);
    exit(); // Salir después de procesar la solicitud DELETE
}

// Insertar datos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['_method']) || $_POST['_method'] !== 'DELETE') {
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $idDirector = $_POST['idDirector'];
        $response = insertPelicula($titulo, $precio, $idDirector);

        if ($response) {
            $_SESSION['datosInsertados'] = [
                'titulo' => $titulo,
                'precio' => $precio,
                'idDirector' => $idDirector
            ];
        } else {
            $_SESSION['mensaje'] = "Error: " . mysqli_connect_error();
        }

        header("Location: ../addPelicula.php");
        exit();
    } else {
        echo "Método DELETE simulado no soportado.";
    }
}
