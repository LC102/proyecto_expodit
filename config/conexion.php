<?php
$servername = "localhost";
$username = "root"; // tu usuario de base de datos
$password = "310302"; // tu contraseña de base de datos
$dbname = "Veterinaria";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
