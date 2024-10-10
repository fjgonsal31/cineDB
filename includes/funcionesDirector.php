<?php

function getDirectores()
{
    require 'connectionDB.php';

    $sql = "SELECT * FROM director;";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function insertDirector($nombre, $apellido, $f_nacimiento, $biografia)
{
    require 'connectionDB.php';

    $sql = "INSERT INTO director(nombre, apellido, f_nacimiento, biografia) VALUES ('$nombre', '$apellido', '$f_nacimiento', '$biografia');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function deleteDirector($id)
{
    require 'connectionDB.php';

    $sql = "DELETE FROM director WHERE id = $id;";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function updateDirector($nombre, $apellido, $f_nacimiento, $biografia)
{
    require 'connectionDB.php';

    $sql = "UPDATE director SET nombre = $nombre, apellido = $apellido, f_nacimiento = $f_nacimiento, biografia = $biografia  WHERE id = $id;";
    $result = mysqli_query($conn, $sql);

    return $result;
}
