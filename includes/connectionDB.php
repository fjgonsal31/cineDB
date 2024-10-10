<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinedb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
