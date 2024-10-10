<?php

function getPeliculas()
{
    require 'connectionDB.php';

    $sql = "SELECT p.id, p.titulo, p.precio, d.nombre, d.apellido, p.id_director FROM pelicula p JOIN director d ON p.id_director = d.id;";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function insertPelicula($titulo, $precio, $idDirector)
{
    require 'connectionDB.php';

    $sql = "INSERT INTO pelicula(titulo, precio, id_director) VALUES ('$titulo', $precio, $idDirector);";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function deletePelicula($id)
{
    require 'connectionDB.php';

    $sql = "DELETE FROM pelicula WHERE id = $id;";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function updatePelicula($id, $titulo, $precio, $id_director)
{
    require 'connectionDB.php';

    $sql = "UPDATE pelicula SET titulo = '$titulo', precio = $precio, id_director = $id_director WHERE id = $id;";
    $result = mysqli_query($conn, $sql);

    return $result;
}
