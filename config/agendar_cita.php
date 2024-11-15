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
$nombre_cliente = $_POST['nombre_cliente'];
$telefono_cliente = $_POST['telefono_cliente'];
$correo_cliente = $_POST['correo_cliente'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$motivo = $_POST['motivo'];

// Insertar datos en la base de datos
$sql = "INSERT INTO citas (nombre_cliente, telefono_cliente, correo_cliente, fecha, hora, motivo) VALUES ('$nombre_cliente', '$telefono_cliente', '$correo_cliente', '$fecha', '$hora', '$motivo')";

if ($conn->query($sql) === TRUE) {
    echo "Cita agendada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
