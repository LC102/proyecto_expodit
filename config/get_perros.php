<?php
$servername = "localhost"; // Cambia si tu servidor es diferente
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

// Obtener los datos de los perritos
$sql = "SELECT nombre, raza, edad, imagen FROM perros";
$result = $conn->query($sql);

$perros = array();

if ($result->num_rows > 0) {
    // Guardar cada fila como un elemento en el array
    while($row = $result->fetch_assoc()) {
        $perros[] = $row;
    }
}

// Convertir a JSON para facilitar la lectura en JavaScript
echo json_encode($perros);

$conn->close();
?>
