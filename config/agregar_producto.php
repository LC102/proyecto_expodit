<?php
$servername = "localhost";
$username = "root";
$password = "310302";
$dbname = "Veterinaria";
$port = 3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$imagen_url = $_POST['imagen_url'];

// Insertar datos en la base de datos
$sql = "INSERT INTO productos (nombre, descripcion, precio, imagen_url) VALUES ('$nombre', '$descripcion', '$precio', '$imagen_url')";

if ($conn->query($sql) === TRUE) {
    echo "Producto agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
