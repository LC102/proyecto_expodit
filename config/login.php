<?php
include 'conexion.php';

// Iniciar sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Depuración
        var_dump($password);          // Contraseña ingresada
        var_dump($row['password']);  // Hash de la base de datos

        if (password_verify($password, $row['password'])) {
            echo "Inicio de sesión exitoso";
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

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





