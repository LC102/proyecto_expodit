<?php
// Iniciar sesión
session_start();

// Conexión a la base de datos
require_once '../vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$servername = $_ENV['SERVERNAME'];
$username = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];
$dbname = $_ENV['DB_NAME'];
$port = $_ENV['PORT'];

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener y validar los datos del formulario
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Comparar la contraseña directamente
        if ($password == $row['password']) {
            // Iniciar sesión
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            
            // Redirigir según el rol del usuario
            if ($row['role'] == "cliente") {
                header("Location: ../pages/citas.html");
                exit();
            } elseif ($row['role'] == "veterinario") {
                header("Location: ../pacientes.html");
                exit();
            }
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }

    $stmt->close();
} else {
    echo "Faltan datos en el formulario";
}

$conn->close();
?>



