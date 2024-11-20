<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recoger datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validar datos
    if (!empty($username) && !empty($password) && !empty($role)) {
        // Encriptar la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta para evitar inyecciones SQL
        $sql = "INSERT INTO usuarios (username, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sss", $username, $passwordHash, $role);
            if ($stmt->execute()) {
                echo "Registro exitoso. <a href='../pages/login.html'>Inicia sesión aquí</a>";
            } else {
                echo "Error al registrar el usuario.";
            }
            $stmt->close();
        } else {
            echo "Error en la consulta: " . $conn->error;
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

// Cerrar conexión
$conn->close();
?>




