<?php

require 'funcionesDirector.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $f_nacimiento = $_POST['f_nacimiento'];
    $biografia = $_POST['biografia'];

    $response = insertDirector($nombre, $apellido, $f_nacimiento, $biografia);
    if ($response) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . mysqli_connect_error();
    }
}
