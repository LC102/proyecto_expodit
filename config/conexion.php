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
?>
