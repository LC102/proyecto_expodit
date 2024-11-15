<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "veterinaria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $especialidad = $_POST['especialidad'];
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO veterinarios (nombre, apellido, telefono, email, especialidad) 
            VALUES ('$nombre', '$apellido', '$telefono', '$email', '$especialidad')";
    if ($conn->query($sql) === TRUE) {
        echo "Veterinario registrado correctamente";
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}

$conn->close();
?>
